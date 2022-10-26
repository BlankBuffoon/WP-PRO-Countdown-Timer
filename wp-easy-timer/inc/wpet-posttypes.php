<?php

if(!class_exists('WPETCustomPostType')) {

    class WPETCustomPostType {

        public function register() {
            add_action( 'init', [$this,'custom_post_type'] );
    
            add_action( 'add_meta_boxes', [$this, 'add_meta_box_timer'] );
    
            add_action( 'admin_enqueue_scripts', [$this,'enqueue_admin'] );
            add_action( 'admin_enqueue_scripts', [$this,'enqueue_jqueryUI'] );
        }
    
        public function enqueue_admin() {
            wp_enqueue_script( 'wpeasytimer_script', plugins_url('/../assets/js/admin/script.js', __FILE__), array('jquery'), '1.0', true );
        }

        public function enqueue_jqueryUI() {
            wp_enqueue_script( 'jquery-ui-datepicker' );
            wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

            wp_enqueue_script('jquery-ui-timepicker-addon', plugins_url('/../assets/js/admin/jquery-ui-timepicker-addon.js', __FILE__), array('jquery'), '1.0', true );
            wp_enqueue_style('jquery-ui-timepicker-addon', plugins_url('/../assets/css/admin/jquery-ui-timepicker-addon.css', __FILE__) );
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
                            <input type="text" class="datepicker" name="datepicker" value=""/>
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
    }

}

if ( class_exists('WPETCustomPostType') ) {
    $wpeasytimer = new WPETCustomPostType();
    $wpeasytimer->register();
}