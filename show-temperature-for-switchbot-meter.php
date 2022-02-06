<?php
/*
 Plugin Name: Show Temperature for SwitchBot Meter
 Plugin URI: https://wordpress.org/plugins/show-temperature-for-switchbot-meter
 Description: Show temperature and humidity which detected by SwitchBot Meter
 Author: Kazushi Yoshida
 Version: 1.1
 Author URI: https://profiles.wordpress.org/shizukanakazushi/
 License: GPLv2 or later
 Text Domain: show-switchbot-meter
 Domain path: /languages
*/

namespace ShowSwitchBotMeter;

$ssbm_api_path = dirname(__FILE__) . '/switchbot-api.php';
// $ssbm_api_path = dirname(__FILE__) . '/switchbot-api-stub.php'; // for debug

include_once dirname(__FILE__) . '/settings.php';
include_once dirname(__FILE__) . '/rest/rest.php';

$ssbm_settings = new SsbmSettings();
$ssbm_rest = new SsbmRest($ssbm_settings);


include_once dirname(__FILE__) . '/shortcodes/shortcodes.php';
$sbm_shortcode = new SsbmShortcode($ssbm_settings);
