<?php
/**
 * Plugin Name: WP PRO Countdown Timer
 * Description: Plugin for quick and easy creation of timers for your wordpress site
 * Plugin URI: https://github.com/BlankBuffoon/WP-Easy-Timer
 * Version: 1.0.0
 * Author: Про-Технологии
 * Author URI: https://pro-technologii.ru
 * Licence: GPLv2 or later
 * Text Domain: wpp-countdown-timer
 * License URI: https://www.gnu.org/licenses/gpl-3.0-standalone.html
*/

if ( !defined('ABSPATH') ) {
    die;
}

// Plugin Dir Path
if (!defined('WPPCT_PATH')) {
    define('WPPCT_PATH', plugin_dir_path(__FILE__));
}

// Plugin Prefix
if (!defined('WPPCT_PREFIX')) {
    define('WPPCT_PREFIX', 'wppct_');
}


if(!class_exists('WPPCT_CustomPostType')) {
    require WPPCT_PATH . 'inc/wppct-posttypes.php';
}

if(!class_exists('WPPCT_Shortcodes')) {
    require WPPCT_PATH . 'inc/wppct-shortcodes.php';
}

class WPP_Countdown_Timer {

    static function activation() {

        flush_rewrite_rules();
    }

    static function deactivation() {

        flush_rewrite_rules();
    }
}

if ( class_exists('WPP_Countdown_Timer') ) {
    $wppct = new WPP_Countdown_Timer();
}

register_activation_hook(__FILE__, array($wppct,'activation') );
register_deactivation_hook(__FILE__, array($wppct,'deactivation') );