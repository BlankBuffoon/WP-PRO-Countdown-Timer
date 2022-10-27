<?php

if ( !defined('ABSPATH') ) {
    die;
}

include_once(WPEASYTIMER_PATH . '/inc/wpet-enqueue.php');

if(!class_exists('WPETCustomPostType')) {

    class WPETCustomPostType {

        public function register() {
            add_action( 'init', [$this,'wpet_custom_post_type'] );
    
            add_action( 'add_meta_boxes', [$this, 'wpet_add_meta_box_timer'] );
            add_action( 'save_post', [$this, 'wpet_save_metabox'], 10, 2);
    
            add_action( 'admin_enqueue_scripts', 'wpet_enqueue_admin' );
            add_action( 'admin_enqueue_scripts', 'wpet_enqueue_jqueryUI' );
        }
    
        public function wpet_add_meta_box_timer() {
            add_meta_box(
                'wpeasytimer_settings',
                'Настройки таймера',
                [$this, 'wpet_metabox_property_html'],
                'timer',
                'normal',
                'default'
            );
        }
    
        public function wpet_metabox_property_html($post) {
            $blockwidth = get_post_meta( $post->ID, 'wpet_gl_settings_blockwidth', true );
            $options = get_post_meta( $post->ID, '_wpet_gl_settings_options', true );

            include("wpet-metaboxes-layout.php");
        }

        public function wpet_save_metabox($post_id, $post) {

            if(is_null($_POST['wpet_gl_settings_blockwidth'])) {
                delete_post_meta($post_id, 'wpet_gl_settings_blockwidth');
            } else {
                update_post_meta($post_id, 'wpet_gl_settings_blockwidth', sanitize_text_field( $_POST['wpet_gl_settings_blockwidth'] ));
            }

            if(is_null( $_POST['wpet_gl_settings_options'] ) ) {
                delete_post_meta( $post->ID, '_wpet_gl_settings_options' );
            } else {
                $old_meta_data = get_post_meta( $post->ID, '_wpet_gl_settings_options', true );
                $new_meta_data = $_POST['wpet_gl_settings_options'];
                if(!empty($old_meta_data)) {
                    update_post_meta($post_id, '_wpet_gl_settings_options', $new_meta_data );
                } else {
                    add_post_meta($post_id, '_wpet_gl_settings_options', $new_meta_data , true );
                }
            }
        }
    
        public function wpet_custom_post_type() {
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