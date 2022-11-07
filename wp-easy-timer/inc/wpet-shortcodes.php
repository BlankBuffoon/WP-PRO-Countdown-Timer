<?php

if ( !defined('ABSPATH') ) {
    die;
}

class WPETShortcodes{

    public function register() {
        add_action( 'init', [$this, 'register_shortcode'] );
    }

    public function register_shortcode() {
        add_shortcode( 'wpet-timer', [$this, 'timer_shortcode'] );
    }

    public function timer_shortcode($atts = array()) {

        extract(shortcode_atts(array(
            'id' => '',
        ), $atts, 'wpet-timer'));

        $options = array();
        $prefix = WPEASYTIMER_PREFIX;

        $options['timer_id'] = $id;

        $options['gl_options'] = empty( get_post_meta($id, $prefix.'gl_settings_options', true) ) ? array(
            'heading',
            'timer',
            'paragraph',
            'progress_bar',
            'button'
        ) : get_post_meta($id, $prefix.'gl_settings_options', true);

        if ( empty( get_post_meta($id, $prefix.'gl_settings_datetime', true) ) ) {
            ob_start();
            echo '<div>';
            echo '<p style="text-align: center;"><b>WP Easy Timer ERROR</b><br>Ошибка конечной даты!</p>';
            echo '</div>';
            $error = ob_get_clean();
            return $error;
        } else {
            $options['gl_datetime'] = get_post_meta($id, $prefix.'gl_settings_datetime', true);
        }

        $options['heading_text'] = empty( get_post_meta($id, $prefix.'heading_settings_text', true) ) ? 'Heading' : get_post_meta($id, $prefix.'heading_settings_text', true);
        $options['heading_fontsize'] = empty( get_post_meta($id, $prefix.'heading_settings_fontsize', true) ) ? '24' : get_post_meta($id, $prefix.'heading_settings_fontsize', true);
        $options['tm_fontsize'] = empty( get_post_meta($id, $prefix.'tm_settings_fontsize', true) ) ? '48' : get_post_meta($id, $prefix.'tm_settings_fontsize', true);
        $options['pgh_text'] = empty( get_post_meta($id, $prefix.'pgh_settings_text', true) ) ? 'Paragraph' :  get_post_meta($id, $prefix.'pgh_settings_text', true);
        $options['pgh_fontsize'] = empty( get_post_meta($id, $prefix.'pgh_settings_fontsize', true) ) ? '16' : get_post_meta($id, $prefix.'pgh_settings_fontsize', true);
        $options['btn_text'] = empty( get_post_meta($id, $prefix.'btn_settings_text', true) ) ? 'Click me!' : get_post_meta($id, $prefix.'btn_settings_text', true);
        $options['btn_fontsize'] = empty( get_post_meta($id, $prefix.'btn_settings_fontsize', true) ) ? '14' : get_post_meta($id, $prefix.'btn_settings_fontsize', true);
        $options['btn_link'] = empty( get_post_meta($id, $prefix.'btn_settings_link', true) ) ? '#' : get_post_meta($id, $prefix.'btn_settings_link', true);

        // JS Timer Script
        wp_enqueue_script( 'wpet_timer_script' );
        
        // Timer Layout
        ob_start();

        echo '<div class="wpet-timer-wrapper">';

        foreach ($options['gl_options'] as $section) {
            include WPEASYTIMER_PATH . '/inc/templates/'. $section . '.php';
        }

        echo '</div>';

        $layout = ob_get_clean();
        return $layout;
    }

}

$wpet_shortcodes = new WPETShortcodes();
$wpet_shortcodes->register();