<?php
/*
Plugin Name: WP Easy Timer
Description: Plugin for quick and easy creation of timers for your wordpress site
Plugin URI: https://github.com/BlankBuffoon/WP-Easy-Timer
Version: 0.0.1
Author: Aleksandr Terepin
Author URI: https://terepin.ru
Licence: GPLv2 or later
Text Domain: wp-easy-timer
*/

if ( !defined('ABSPATH') ) {
    die;
}

// Plugin Dir Path
if (!defined('WPEASYTIMER_PATH')) {
    define('WPEASYTIMER_PATH', plugin_dir_path(__FILE__));
}

// Plugin Prefix
if (!defined('WPEASYTIMER_PREFIX')) {
    define('WPEASYTIMER_PREFIX', 'wpet_');
}


if(!class_exists('WPETCustomPostType')) {
    require WPEASYTIMER_PATH . 'inc/wpet-posttypes.php';
}

if(!class_exists('WPETShortcodes')) {
    require WPEASYTIMER_PATH . 'inc/wpet-shortcodes.php';
}

class wpeasytimer {

    static function activation() {

        flush_rewrite_rules();
    }

    static function deactivation() {

        flush_rewrite_rules();
    }
}

if ( class_exists('wpeasytimer') ) {
    $wpeasytimer = new wpeasytimer();
}

register_activation_hook(__FILE__, array($wpeasytimer,'activation') );
register_deactivation_hook(__FILE__, array($wpeasytimer,'deactivation') );