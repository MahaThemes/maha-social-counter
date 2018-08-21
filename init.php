<?php
/* --------------------------------------------------------------------------

    Plugin Name: Maha - Social Counter
    Plugin URI: https://mahathemes.com
    Description: MahaThemes - Widget Social Counter .
    Version: 1.0
    Author: MahaThemes
    Author URI: https://mahathemes.com

    A MahaThemes Framework - Copyright (c) 2018

 ---------------------------------------------------------------------------*/

require_once 'smc-api.php';
require_once 'smc-remote-http.php';


class Maha_SocialCounter
{
    public function __construct()
    {
        define('MAHA_MSC_URI', plugin_dir_url(__FILE__));
        define('MAHA_MSC_DIR', plugin_dir_path(__FILE__));

        require_once MAHA_MSC_DIR . 'smc-widget.php';
    }

}

new Maha_SocialCounter;
