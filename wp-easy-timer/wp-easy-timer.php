<?php
/*
Plugin Name: WP Easy Timer
Description: Plugin for quick and easy creation of timers for your wordpress site
Plugin URI: https://github.com/BlankBuffoon/WP-Easy-Timer
Version: 1.0.0
Author: Aleksandr Terepin
Author URI: https://terepin.ru
Licence: GPLv2 or later
Text Domain: wp-easy-timer
*/

if ( !defined('ABSPATH') ) {
    die;
}

class wpeasytimer {

    public function register() {
        add_action( 'init', [$this,'custom_post_type'] );
    }

    public function custom_post_type() {
        register_post_type( 'timer',
        array(
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'timer' ),
            'label' => 'Таймеры',
            'supports' => array('title', 'editor', 'thumbnail'),
        ));
    }

    static function activation() {

        flush_rewrite_rules();
    }

    static function deactivation() {

        flush_rewrite_rules();
    }
}

if ( class_exists('wpeasytimer') ) {
    $wpeasytimer = new wpeasytimer();
    $wpeasytimer->register();
}

register_activation_hook(__FILE__, array($wpeasytimer,'activation') );
register_deactivation_hook(__FILE__, array($wpeasytimer,'deactivation') );