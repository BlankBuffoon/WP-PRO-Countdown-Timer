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

// function wpse_enqueue_datepicker() {

//     wp_register_script('tek_tour_timepicker', plugins_url('/js/jquery-ui-timepicker-addon.js', __FILE__));
// wp_enqueue_script('tek_tour_timepicker', plugins_url('/js/jquery-ui-timepicker-addon.js', dirname(__FILE__)));

// wp_register_script('tek_tour_sliderAccess', plugins_url('/js/jquery-ui-sliderAccess.js', __FILE__));
// wp_enqueue_script('tek_tour_sliderAccess', plugins_url('/js/jquery-ui-sliderAccess.js', dirname(__FILE__)));


//     // Load the datepicker script (pre-registered in WordPress).
//     wp_enqueue_script( 'jquery-ui-datepicker' );

//     // You need styling for the datepicker. For simplicity I've linked to the jQuery UI CSS on a CDN.
//     wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
//     wp_enqueue_style( 'jquery-ui' );
// }

// add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker' );

class wpeasytimer {

    public function register() {
        add_action( 'init', [$this,'custom_post_type'] );

        add_action( 'add_meta_boxes', [$this, 'add_meta_box_timer'] );

        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
    
        wp_enqueue_script('jquery-ui-timepicker-addon', plugins_url( '/assets/js/admin/jquery-ui-timepicker-addon.js', __FILE__), array('jquery'), '1.0', true );
        wp_enqueue_style('jquery-ui-timepicker-addon', plugins_url( '/assets/css/admin/jquery-ui-timepicker-addon.css', __FILE__) );

        add_action( 'admin_enqueue_scripts', [$this,'enqueue_admin'] );
    }

    public function enqueue_admin() {
        wp_enqueue_script( 'wpeasytimer_script', plugins_url( '/assets/js/admin/script.js', __FILE__ ), array('jquery'), '1.0', true );
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

    public function metabox_property_html() {
        $blockwidth = get_post_meta( $post->ID, 'wpet_gl_settings_blockwidth', true );

        echo '
            <div class="wpet_metabox_wrapper">
                <div>
                    <label for="wpet_gl_settings_blockwidth">Ширина блока</label>
                    <input type="number" id="wpet_gl_settings_blockwidth" name="wpet_gl_settings_blockwidth" value="'. esc_html($blockwidth) .'">
                </div>

                <div style="display: flex">
                    <p>Опции</p>
                    <div>
                        <div>
                            <input type="checkbox" id="wpet_gl_settings_options_heading" name="wpet_gl_settings_options" value="heading" checked>
                            <label for="wpet_gl_settings_options_heading">Заголовок</label>
                        </div>
                        <div>
                            <input type="checkbox" id="wpet_gl_settings_options_timer" name="wpet_gl_settings_options" value="timer" checked>
                            <label for="wpet_gl_settings_options_timer">Таймер</label>
                        </div>
                        <div>
                            <input type="checkbox" id="wpet_gl_settings_options_paragraph" name="wpet_gl_settings_options" value="paragraph">
                            <label for="wpet_gl_settings_options_paragraph">Подзаголовок</label><br>
                        </div>
                        <div>
                            <input type="checkbox" id="wpet_gl_settings_options_progress_bar" name="wpet_gl_settings_options" value="progress_bar">
                            <label for="wpet_gl_settings_options_progress_bar">Полоса прогресса</label>
                        </div>
                        <div>
                            <input type="checkbox" id="wpet_gl_settings_options_button" name="wpet_gl_settings_options" value="button" checked>
                            <label for="wpet_gl_settings_options_button">Кнопка</label><br>
                        </div>
                    </div>
                </div>

                <div style="display: flex">
                    <p>Порядок</p>
                    <p>Currently unavalible!</p>
                </div>

                <div style="display: flex">
                    <p>Тип таймера</p>
                    <div>
                        <select name="wpet_gl_settings_timer_type">
                            <option value="until_date">До даты</option>
                            <option value="by_time">По времени</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex">
                    <p>Срок</p>
                    <div>
                        <input type="text" class="datepicker" name="datepicker" value="" placeholder="Введите дату и время"/>
                    </div>
                </div>
            </div>
        ';
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