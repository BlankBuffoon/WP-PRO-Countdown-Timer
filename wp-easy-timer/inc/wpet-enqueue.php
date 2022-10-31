<?php

if ( !defined('ABSPATH') ) {
    die;
}

function wpet_enqueue_admin() {
    wp_enqueue_script( 'wpeasytimer_script', plugins_url('/../assets/js/admin/wpet-admin-scripts.js', __FILE__), array('jquery'), '1.0', true );
    wp_enqueue_style( 'wpeasytimer_styles', plugins_url('/../assets/css/admin/wpet-admin-styles.css', __FILE__) );
}

function wpet_enqueue_jqueryUI() {
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-slider' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-ui-tabs' );

    wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.13.1/themes/base/jquery-ui.css', true );
    wp_enqueue_style('jquery-ui-timepicker-addon', plugins_url('/../assets/css/admin/jquery-ui-timepicker-addon.css', __FILE__) );

    wp_enqueue_script('jquery-ui-timepicker-addon', plugins_url('/../assets/js/admin/jquery-ui-timepicker-addon.min.js', __FILE__), array('jquery'), '1.0', true );
}