<?php
class Maha_SocialApi
{

    private function get_json($url)
    {
        $smc_json = json_decode(smc_remote_http::get_page($url, __CLASS__), true);
        if ($smc_json === null and json_last_error() !== JSON_ERROR_NONE) {
            return 'Error decoding the json';
        }
        return $smc_json;
    }


    private function extract_numbers_from_string($smc_string)
    {
        $buffy = '';
        foreach (str_split($smc_string) as $smc_char) {
            if (is_numeric($smc_char)) {
                $buffy .= $smc_char;
            }
        }
        return $buffy;
    }


    public function get_social_counter($service_id, $user_id, $widget_id, $access_token = '')
    {

        $service_transient = get_transient('maha_smc_'.$service_id.'_'.$widget_id);
        if ( is_array($service_transient) && $service_transient['id'] == $user_id ) {
            return $service_transient;
        } else {
            delete_transient( 'maha_smc_'.$service_id.'_'.$widget_id );
        }

        $service_data = $this->get_service_data($service_id, $user_id, $access_token);
        $service_counter = $this->simply_number( $service_data );

        $service_detail = array(
            'id' => $user_id,
            'count' => $service_counter
        );

        set_transient( 'maha_smc_'.$service_id.'_'.$widget_id, $service_detail, 60*60*48 );

        return $service_detail;
    }


    private function get_service_data($service_id, $user_id, $access_token)
    {
        $buffy_array = 0;

        switch ($service_id) {
            case 'facebook':

                $smc_data = smc_remote_http::get_page("https://facebook.com/$user_id", __CLASS__);

                if ($smc_data === false) {
                    $buffy_array = 1;
                } else {
                    $pattern = '/PagesLikesCountDOMID[^>]+>(.*?)<\/a/s';
                    preg_match($pattern, $smc_data, $matches);

                    if (!empty($matches[1])) {
                        $page_likes_number = $this->extract_numbers_from_string(strip_tags($matches[1]));
                        $buffy_array = (int) $page_likes_number;

                    } else {
                        $buffy_array = 1;
                    }
                }

                break;

            case 'twitter':

                $twitter_worked = false;

                $smc_data = smc_remote_http::get_page("https://twitter.com/$user_id", __CLASS__);

                if ($smc_data === false) {
                    $buffy_array = 1;
                } else {
                    $pattern = "/\/followers(.*)statnum\">([^<]+)/is";
                    preg_match_all($pattern, $smc_data, $matches);

                    if (!empty($matches[2][0])) {
                        $smc_buffer_counter_fix = $this->extract_numbers_from_string($matches[2][0]);

                        $buffy_array = (int) $smc_buffer_counter_fix;

                        if (!empty($buffy_array) and is_numeric($buffy_array)) {
                            $twitter_worked = true; //skip twitter second check it worked!
                        }
                    } else {
                        $buffy_array = 1;
                    }
                }

                break;

            case 'youtube':

                $smc_data = smc_remote_http::get_page("https://www.youtube.com/$user_id", __CLASS__);

                if ($smc_data === false) {
                    $buffy_array = 1;
                } else {
                    $pattern = '/yt-uix-tooltip" title="(.*)" tabindex/';
                    preg_match($pattern, $smc_data, $matches, PREG_OFFSET_CAPTURE);

                    if (!empty($matches[1])) {
                        $page_likes_number = $this->extract_numbers_from_string(strip_tags($matches[1][0]));
                        $buffy_array = (int) $page_likes_number;

                    } else {
                        $buffy_array = 1;
                    }
                }

                break;

            case 'googleplus':

                $smc_data = smc_remote_http::get_page("https://plus.google.com/$user_id", __CLASS__);

                if ($smc_data === false) {
                    $buffy_array = 1;
                } else {

                    $pattern = "/[0-9.,]+.(?:followers)/";
                    preg_match($pattern, $smc_data, $matches);

                    if (!empty($matches[0])) {
                        $page_likes_number = $this->extract_numbers_from_string(strip_tags($matches[0]));
                        $buffy_array = (int) $page_likes_number;

                    } else {
                        $buffy_array = 1;
                    }
                }

                break;

            case 'pinterest':

                    $smc_data = smc_remote_http::get_page("https://api.pinterest.com/v3/pidgets/users/$user_id/pins/", __CLASS__);

                    if ($smc_data === false) {
                        $buffy_array = 1;
                    } else {

                        $pin_json = json_decode($smc_data, true);

                        if (!empty($pin_json['data']['user']['follower_count'])) {
                            $buffy_array = (int) $pin_json['data']['user']['follower_count'];
                        } else {
                            $buffy_array = 1;
                        }

                    }

                    break;

            case 'instagram':
                $smc_data = smc_remote_http::get_page("http://instagram.com/$user_id#", __CLASS__);

                $pattern = '/window\._sharedData = (.*);<\/script>/';
                preg_match($pattern, $smc_data, $matches);
                if (!empty($matches[1])) {
                    $instagram_json = json_decode($matches[1], true);
                    if (!empty($instagram_json['entry_data']['ProfilePage'][0]["graphql"]['user']["edge_followed_by"]['count'])) {
                        $buffy_array = (int) $instagram_json['entry_data']['ProfilePage'][0]["graphql"]['user']["edge_followed_by"]['count'];
                    }
                } else {
                    $buffy_array = 1;
                }
                break;

            case 'soundcloud':
                $smc_data = @$this->get_json("http://api.soundcloud.com/users/$user_id.json?client_id=97220fb34ad034b5d4b59b967fd1717e");
                if (is_array($smc_data) && !empty($smc_data['followers_count'])) {
                    $buffy_array = (int) $smc_data['followers_count'];
                } else {
                    $buffy_array = 1;
                }
                break;
        }

        return $buffy_array;
    }


    private function simply_number($number, $i = 2){
    	$number = intval($number);
    	if ($number >= 1000000){
    		$simply = round(($number/1000000), $i);
    		$output = $simply.'M';
    	}else if($number >= 1000){
    		$simply = round(($number/1000), $i);
    		$output = $simply.'K';
    	}else{
    		$output = $number;
    	}

    	return $output;
    }
}
