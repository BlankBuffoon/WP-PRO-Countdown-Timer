<?php

if ( !defined('ABSPATH') ) {
    die;
}

include_once(WPEASYTIMER_PATH . '/inc/wpet-enqueue.php');

if(!class_exists('WPETCustomPostType')) {

    class WPETCustomPostType {

        public function register() {
            add_action( 'init', [$this,'custom_post_type'] );
    
            add_action( 'add_meta_boxes', [$this, 'add_meta_box_timer'] );
    
            add_action( 'admin_enqueue_scripts', 'enqueue_admin' );
            add_action( 'admin_enqueue_scripts', 'enqueue_jqueryUI' );
        }
    
        public function add_meta_box_timer() {
            add_meta_box(
                'wpeasytimer_settings',
                'Настройки таймера',
                [$this, 'metabox_property_html'],
                'timer',
                'normal',
                'default'
            );
        }
    
        public function metabox_property_html($post) {
            $blockwidth = get_post_meta( $post->ID, 'wpet_gl_settings_blockwidth', true );
    
            include("wpet-metaboxes-layout.php");
        }
    
        public function custom_post_type() {
            register_post_type( 'timer',
            array(
                'public' => true,
                'has_archive' => true,
                'rewrite' => array( 'slug' => 'timer' ),
                'label' => 'Таймеры',
                'supports' => array('title'),
            ));
        }
    }

}

if ( class_exists('WPETCustomPostType') ) {
    $wpeasytimer = new WPETCustomPostType();
    $wpeasytimer->register();
}