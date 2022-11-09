<?php

if ( !defined('ABSPATH') ) {
    die;
}

include_once(WPPCT_PATH . '/inc/wppct-enqueue.php');

if(!class_exists('WPPCT_CustomPostType')) {

    class WPPCT_CustomPostType {

        public function register() {
            add_action( 'init', [$this,'wppct_custom_post_type'] );
    
            add_action( 'add_meta_boxes', [$this, 'wppct_add_meta_box_timer'] );
            add_action( 'save_post', [$this, 'wppct_save_metabox'], 10, 2);
            
            add_action( 'admin_enqueue_scripts', 'wppct_enqueue_jqueryUI' );
            add_action( 'admin_enqueue_scripts', 'wppct_enqueue_admin' );

            add_action( 'wp_enqueue_scripts', 'wppct_enqueue_front' );

            add_action( 'manage_wppct_timer_posts_columns', [$this, 'wppct_posttype_columns'] );
            add_action( 'manage_wppct_timer_posts_custom_column', [$this, 'wppct_custom_posttype_columns'], 10, 2 );
        }

        public function wppct_posttype_columns( $columns ) {

            $custom_column_order = array(
                'title' => $columns['title'],
                'wppct_shortcode' => esc_html__('Shortcode', 'wpprocountdowntimer'),
                'date' => $columns['date'],
            );

            return $custom_column_order;
        }

        public function wppct_custom_posttype_columns( $column, $post_id ) {

            switch( $column ) {
                case 'wppct_shortcode':
                    echo '<div>[wppct-timer id="'.$post_id.'"]</div> <br/>';
                    break;
            }

        }
    
        public function wppct_add_meta_box_timer() {
            add_meta_box(
                'wppct_settings',
                'Настройки таймера',
                [$this, 'wppct_metabox_property_html'],
                'wppct_timer',
                'normal',
                'default'
            );
        }
    
        public function wppct_metabox_property_html( $post ) {
            include("wppct-metaboxes-layout.php");
        }

        public function wppct_save_metabox( $post_id, $post ) {

            if ( !isset($_POST['_wppct']) || !wp_verify_nonce($_POST['_wppct'], 'wppctmetaboxfields') ) {
                return $post_id;
            }

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }

            if ( $post->post_type != 'wppct_timer' ) {
                return $post_id;
            }

            $post_type = get_post_type_object( $post->post_type );
            if ( !current_user_can($post_type->cap->edit_post, $post_id)) {
                return $post_id;
            }

            // Global Settings Options

            if( isset( $_POST['wppct_gl_settings_options'] ) ) {
                $old_meta_data = get_post_meta( $post->ID, 'wppct_gl_settings_options', true );
                $new_meta_data = $_POST['wppct_gl_settings_options'];

                if(!empty($old_meta_data)) {
                    update_post_meta($post_id, 'wppct_gl_settings_options', $new_meta_data );
                } else {
                    add_post_meta($post_id, 'wppct_gl_settings_options', $new_meta_data , true );
                }
            } else {
                delete_post_meta( $post->ID, 'wppct_gl_settings_options' );
            }

            // Global Settings DateTime

            if( isset( $_POST['wppct_gl_settings_datetime'] ) ) {
                if ( empty( $_POST['wppct_gl_settings_datetime'] ) ) {
                    $current_time = wp_date( 'd.m.Y H:i' );
                    $current_time = strtotime( "+1 MONTH", strtotime($current_time) );
                    $current_time = date( 'd.m.Y H:i', $current_time );
                    update_post_meta( $post_id, 'wppct_gl_settings_datetime', $current_time );
                } else {
                    update_post_meta( $post_id, 'wppct_gl_settings_datetime', $_POST['wppct_gl_settings_datetime'] );
                }
            } else {
                delete_post_meta( $post_id, 'wppct_gl_settings_datetime' );
            }

            // Heading Settings Text

            if( !empty( $_POST['wppct_heading_settings_text'] ) ) {
                update_post_meta( $post_id, 'wppct_heading_settings_text', $_POST['wppct_heading_settings_text'] );
            } else {
                delete_post_meta( $post_id, 'wppct_heading_settings_text' );
            }

            // Heading Settings Font Size

            if( !empty( $_POST['wppct_heading_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wppct_heading_settings_fontsize', $_POST['wppct_heading_settings_fontsize'] );
            } else {
                delete_post_meta( $post_id, 'wppct_heading_settings_fontsize' );
            }

            // Timer Settings Font Size

            if( !empty( $_POST['wppct_tm_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wppct_tm_settings_fontsize', $_POST['wppct_tm_settings_fontsize'] );
            } else {
                delete_post_meta( $post_id, 'wppct_tm_settings_fontsize' );
            }

            // Paragraph Settings Text

            if( !empty( $_POST['wppct_pgh_settings_text'] ) ) {
                update_post_meta( $post_id, 'wppct_pgh_settings_text', $_POST['wppct_pgh_settings_text'] );
            } else {
                delete_post_meta( $post_id, 'wppct_pgh_settings_text' );
            }

            // Paragraph Settings Font Size

            if( !empty( $_POST['wppct_pgh_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wppct_pgh_settings_fontsize', $_POST['wppct_pgh_settings_fontsize'] );
            } else {
                delete_post_meta( $post_id, 'wppct_pgh_settings_fontsize' );
            }

            // Button Settings Text

            if( !empty( $_POST['wppct_btn_settings_text'] ) ) {
                update_post_meta( $post_id, 'wppct_btn_settings_text', $_POST['wppct_btn_settings_text'] );
            } else {
                delete_post_meta( $post_id, 'wppct_btn_settings_text' );
            }

            // Button Settings Font Size

            if( !empty( $_POST['wppct_btn_settings_fontsize'] ) ) {
                update_post_meta( $post_id, 'wppct_btn_settings_fontsize', $_POST['wppct_btn_settings_fontsize'] );
            } else {
                delete_post_meta( $post_id, 'wppct_btn_settings_fontsize' );
            }

            // Button Settings Link

            if( !empty( $_POST['wppct_btn_settings_link'] ) ) {
                update_post_meta( $post_id, 'wppct_btn_settings_link', $_POST['wppct_btn_settings_link'] );
            } else {
                delete_post_meta( $post_id, 'wppct_btn_settings_link' );
            }

            return $post_id;
        }
    
        public function wppct_custom_post_type() {
            register_post_type( 'wppct_timer',
            array(
                'public' => true,
                'has_archive' => true,
                'rewrite' => array( 'slug' => 'wppct_timer' ),
                'label' => 'Таймеры',
                'supports' => array('title'),
                'menu_icon'=> 'dashicons-clock',
            ));
        }
    }

}

if ( class_exists('WPPCT_CustomPostType') ) {
    $wppct_posttype = new WPPCT_CustomPostType();
    $wppct_posttype->register();
}