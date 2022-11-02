<?php

if ( !defined('ABSPATH') ) {
    die;
}

class WPETShortcodes{

    public function register() {
        add_action( 'init', [$this, 'register_shortcode'] );
    }

    public function register_shortcode() {
        add_shortcode( 'wpet_timer', [$this, 'timer_shortcode'] );
    }

    public function timer_shortcode() {
        return "Timer";
    }

}

$wpet_shortcodes = new WPETShortcodes();
$wpet_shortcodes->register();