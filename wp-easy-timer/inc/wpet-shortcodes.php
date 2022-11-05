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

        // $options['gl_options'] = get_post_meta($id, $prefix.'gl_settings_options', true);
        $options['gl_options'] = empty( get_post_meta($id, $prefix.'gl_settings_options', true) ) ? array(
            'heading',
            'timer',
            'paragraph',
            'progress_bar',
            'button'
        ) : get_post_meta($id, $prefix.'gl_settings_options', true);

        // $options['gl_datetime'] = get_post_meta($id, $prefix.'gl_settings_datetime', true);
        $options['gl_datetime'] = empty( get_post_meta($id, $prefix.'gl_settings_datetime', true) ) ? die : get_post_meta($id, $prefix.'gl_settings_datetime', true);

        // $options['heading_text'] = get_post_meta($id, $prefix.'heading_settings_text', true);
        $options['heading_text'] = empty( get_post_meta($id, $prefix.'heading_settings_text', true) ) ? 'Heading' : get_post_meta($id, $prefix.'heading_settings_text', true);

        // $options['heading_fontsize'] = get_post_meta($id, $prefix.'heading_settings_fontsize', true);
        $options['heading_fontsize'] = empty( get_post_meta($id, $prefix.'heading_settings_fontsize', true) ) ? '24' : get_post_meta($id, $prefix.'heading_settings_fontsize', true);

        // $options['tm_fontsize'] = get_post_meta($id, $prefix.'tm_settings_fontsize', true);
        $options['tm_fontsize'] = empty( get_post_meta($id, $prefix.'tm_settings_fontsize', true) ) ? '18' : get_post_meta($id, $prefix.'tm_settings_fontsize', true);

        // $options['pgh_text'] = get_post_meta($id, $prefix.'pgh_settings_text', true);
        $options['pgh_text'] = empty( get_post_meta($id, $prefix.'pgh_settings_text', true) ) ? 'Paragraph' :  get_post_meta($id, $prefix.'pgh_settings_text', true);

        // $options['pgh_fontsize'] = get_post_meta($id, $prefix.'pgh_settings_fontsize', true);
        $options['pgh_fontsize'] = empty( get_post_meta($id, $prefix.'pgh_settings_fontsize', true) ) ? '16' : get_post_meta($id, $prefix.'pgh_settings_fontsize', true);

        // $options['btn_text'] = get_post_meta($id, $prefix.'btn_settings_text', true);
        $options['btn_text'] = empty( get_post_meta($id, $prefix.'btn_settings_text', true) ) ? 'Click me!' : get_post_meta($id, $prefix.'btn_settings_text', true);

        // $options['btn_fontsize'] = get_post_meta($id, $prefix.'btn_settings_fontsize', true);
        $options['btn_fontsize'] = empty( get_post_meta($id, $prefix.'btn_settings_fontsize', true) ) ? '14' : get_post_meta($id, $prefix.'btn_settings_fontsize', true);

        // $options['btn_link'] = get_post_meta($id, $prefix.'btn_settings_link', true);
        $options['btn_link'] = empty( get_post_meta($id, $prefix.'btn_settings_link', true) ) ? '#' : get_post_meta($id, $prefix.'btn_settings_link', true);

        ob_start();

        echo '<div class="wpet-timer-wrapper">';

        if (in_array('heading', $options['gl_options'])) {
            include WPEASYTIMER_PATH . '/inc/shortcodes/heading.php';
        }

        if (in_array('timer', $options['gl_options'])) {
            include WPEASYTIMER_PATH . '/inc/shortcodes/timer.php';
        }

        if (in_array('paragraph', $options['gl_options'])) {
            include WPEASYTIMER_PATH . '/inc/shortcodes/paragraph.php';
        }

        // if (in_array('progress_bar', $options['gl_options'])) {
        //     include WPEASYTIMER_PATH . '/inc/shortcodes/progress_bar.php';
        // }

        if (in_array('button', $options['gl_options'])) {
            include WPEASYTIMER_PATH . '/inc/shortcodes/button.php';
        }

        echo '</div>';

        $layout = ob_get_clean();
        return $layout;

        // Debug info

        // return '<p><- BEGIN SHORTCODE -></p><br>' . 
        // '<pre>' .
        // 'Options array: ' . $options['gl_options'] . '<br>' .
        // 'Datetime: ' . $options['gl_datetime'] . '<br>' .
        // 'Heading text: ' . $options['heading_text'] . '<br>' .
        // 'Heading fontsize: ' . $options['heading_fontsize'] . '<br>' .
        // 'Timer fontsize: ' . $options['tm_fontsize'] . '<br>' .
        // 'Paragraph text: ' . $options['pgh_text'] . '<br>' .
        // 'Paragraph fontsize: ' . $options['pgh_fontsize'] . '<br>' .
        // 'Button text: ' . $options['btn_text'] . '<br>' .
        // 'Button fontsize: ' . $options['btn_fontsize'] . '<br>' .
        // 'Button link: ' . $options['btn_link'] . '<br>' .
        // '</pre>' .
        // '<br><p><- END SHORTCODE -></p>'
        // ;
    }

}

$wpet_shortcodes = new WPETShortcodes();
$wpet_shortcodes->register();