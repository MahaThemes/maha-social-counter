<?php

class smc_remote_http
{

    const http_request_timeout = 10;
	const run_test_on_fail_after = 10; // if all channels failed, run the test again after 2 hours


    public static function get_page($url, $caller_id = '')
    {
        return self::get_url_wordpress($url, $caller_id);
    }

    private static function get_url_wordpress($url, $caller_id = '') {

		$response = wp_remote_get($url, array(
			'timeout' => self::http_request_timeout,
			'sslverify' => false,
			'user-agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0'
		));

		if (is_wp_error($response)) {
			return false;
		}

		$request_result = wp_remote_retrieve_body($response);
		if ($request_result == '') {
			return false;
		}
		return $request_result;
	}

    private static function get_page_via_channel($url, $caller_id = '', $channel)
    {
        switch ($channel) {
        case 'wordpress':
            return self::get_url_wordpress($url, $caller_id);
        break;

        case 'file_get_contents':
            return self::get_url_file_get_contents($url, $caller_id);
        break;

        case 'curl':
            return self::get_url_curl($url, $caller_id);
        break;
    }

        return false;
    }
}
