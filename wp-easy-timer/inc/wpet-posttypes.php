<?php

if ( !defined('ABSPATH') ) {
    die;
}

include_once(WPEASYTIMER_PATH . '/inc/wpet-enqueue.php');

if(!class_exists('WPETCustomPostType')) {

    class WPETCustomPostType {

        public $post;
        public $post_id;

        public function register() {
            add_action( 'init', [$this,'wpet_custom_post_type'] );
    
            add_action( 'add_meta_boxes', [$this, 'wpet_add_meta_box_timer'] );
            add_action( 'save_post', [$this, 'wpet_save_metabox'], 10, 2);
            
            add_action( 'admin_enqueue_scripts', 'wpet_enqueue_jqueryUI' );
            add_action( 'admin_enqueue_scripts', 'wpet_enqueue_admin' );
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
            include("wpet-metaboxes-layout.php");
        }

        public function wpet_save_metabox($post_id, $post) {

            // Global Settings BlockWidth
            /*
            if(is_null($_POST['wpet_gl_settings_blockwidth'])) {
                delete_post_meta($post_id, 'wpet_gl_settings_blockwidth');
            } else {
                update_post_meta($post_id, 'wpet_gl_settings_blockwidth', sanitize_text_field( $_POST['wpet_gl_settings_blockwidth'] ));
            }
            */

            // Global Settings Options

            if(isset( $_POST['wpet_gl_settings_options'] ) ) {
                $old_meta_data = get_post_meta( $post->ID, '_wpet_gl_settings_options', true );
                $new_meta_data = $_POST['wpet_gl_settings_options'];

                if(!empty($old_meta_data)) {
                    update_post_meta($post_id, '_wpet_gl_settings_options', $new_meta_data );
                } else {
                    add_post_meta($post_id, '_wpet_gl_settings_options', $new_meta_data , true );
                }
            } else {
                delete_post_meta( $post->ID, '_wpet_gl_settings_options' );
            }

            // Global Settings Order
            /*
            if ( isset( $_POST['wpet_sortable_list_order'] ) ) {
                $list_order = json_decode( stripcslashes($_POST['wpet_sortable_list_order']), true );
                $old_meta_data = get_post_meta( $post->ID, '_wpet_gl_settings_list_order', true );

                update_post_meta($post_id, '_wpet_gl_settings_list_order', $list_order);

                // if ( !empty($old_meta_data) ) {
                //     update_post_meta($post_id, '_wpet_gl_settings_list_order', $list_order);
                // } else {
                //     add_post_meta( $post_id, '_wpet_gl_settings_list_order', $list_order, true );
                // }
            } else {
                $list_order = json_decode( stripcslashes($_POST['wpet_sortable_list_order']), true );
                add_post_meta( $post_id, '_wpet_gl_settings_list_order', $list_order, true );
            }
            */

            // Global Settings DateTime

            if( isset( $_POST['wpet_gl_settings_datetime'] ) ) {
                update_post_meta( $post_id, 'wpet_gl_settings_datetime', $_POST['wpet_gl_settings_datetime'] );
            } else {
                add_post_meta( $post_id, 'wpet_gl_settings_datetime', $_POST['wpet_gl_settings_datetime'], true );
            }

            // Heading Settings Text

            if( isset( $_POST['wpet_heading_settings_text'] ) ) {
                update_post_meta( $post_id, 'wpet_heading_settings_text', $_POST['wpet_heading_settings_text'] );
            } else {
                add_post_meta( $post_id, 'wpet_heading_settings_text', $_POST['wpet_heading_settings_text'], true );
            }

            // Heading Settings Font Size

            if( isset( $_POST['wpet_heading_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wpet_heading_settings_fontsize', $_POST['wpet_heading_settings_fontsize'] );
            } else {
                add_post_meta( $post_id, 'wpet_heading_settings_fontsize', $_POST['wpet_heading_settings_fontsize'], true );
            }

            // Timer Settings Font Size

            if( isset( $_POST['wpet_tm_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wpet_tm_settings_fontsize', $_POST['wpet_tm_settings_fontsize'] );
            } else {
                add_post_meta( $post_id, 'wpet_tm_settings_fontsize', $_POST['wpet_tm_settings_fontsize'], true );
            }

            // Paragraph Settings Text

            if( isset( $_POST['wpet_pgh_settings_text'] ) ) {
                update_post_meta( $post_id, 'wpet_pgh_settings_text', $_POST['wpet_pgh_settings_text'] );
            } else {
                add_post_meta( $post_id, 'wpet_pgh_settings_text', $_POST['wpet_pgh_settings_text'], true );
            }

            // Paragraph Settings Font Size

            if( isset( $_POST['wpet_pgh_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wpet_pgh_settings_fontsize', $_POST['wpet_pgh_settings_fontsize'] );
            } else {
                add_post_meta( $post_id, 'wpet_pgh_settings_fontsize', $_POST['wpet_pgh_settings_fontsize'], true );
            }

            // Button Settings Text

            if( isset( $_POST['wpet_btn_settings_text'] ) ) {
                update_post_meta( $post_id, 'wpet_btn_settings_text', $_POST['wpet_btn_settings_text'] );
            } else {
                add_post_meta( $post_id, 'wpet_btn_settings_text', $_POST['wpet_btn_settings_text'], true );
            }

            // Button Settings Font Size

            if( isset( $_POST['wpet_btn_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wpet_btn_settings_fontsize', $_POST['wpet_btn_settings_fontsize'] );
            } else {
                add_post_meta( $post_id, 'wpet_btn_settings_fontsize', $_POST['wpet_btn_settings_fontsize'], true );
            }

            // Button Settings Link

            if( isset( $_POST['wpet_btn_settings_link'] ) ) {
                update_post_meta( $post_id, 'wpet_btn_settings_link', $_POST['wpet_btn_settings_link'] );
            } else {
                add_post_meta( $post_id, 'wpet_btn_settings_link', $_POST['wpet_btn_settings_link'], true );
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