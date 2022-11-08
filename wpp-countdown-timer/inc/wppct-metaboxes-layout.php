<?php
    if ( !defined('ABSPATH') ) {
        die;
    }

    wp_nonce_field('wppctmetaboxfields', '_wppct');

    $gl_options = get_post_meta( $post->ID, 'wppct_gl_settings_options', true );
    if ( empty( $gl_options ) ) { settype( $gl_options, "array" ); }

    $gl_gatetime = get_post_meta( $post->ID, 'wppct_gl_settings_datetime', true );
  
    $heading_text = get_post_meta( $post->ID, 'wppct_heading_settings_text', true );
    $heading_fontsize = get_post_meta( $post->ID, 'wppct_heading_settings_fontsize', true );
    
    $timer_fontsize = get_post_meta( $post->ID, 'wppct_tm_settings_fontsize', true );

    $paragraph_text = get_post_meta( $post->ID, 'wppct_pgh_settings_text', true );
    $paragraph_fontsize = get_post_meta( $post->ID, 'wppct_pgh_settings_fontsize', true );

    $button_text = get_post_meta( $post->ID, 'wppct_btn_settings_text', true );
    $button_fontsize = get_post_meta( $post->ID, 'wppct_btn_settings_fontsize', true );
    $button_link = get_post_meta( $post->ID, 'wppct_btn_settings_link', true );
?>
<div class="wppct_metabox" id="wppct_metabox_tabs">
    <ul>
        <li><a class="wppct-vertical-menu-link" href="#general">Основное</a></li>
        <li><a class="wppct-vertical-menu-link" href="#heading">Заголовок</a></li>
        <li><a class="wppct-vertical-menu-link" href="#timer">Таймер</a></li>
        <li><a class="wppct-vertical-menu-link" href="#paragraph">Параграф</a></li>
        <li><a class="wppct-vertical-menu-link" href="#progress_bar">Полоса прогресса</a></li>
        <li><a class="wppct-vertical-menu-link" href="#button">Кнопка</a></li>
    </ul>
    <section class="wppct_metabox_wrapper" id="general">

        <h2>Основные настройки</h2>

        <div class="wppct-grig-section options">
            <p>Опции</p>
            <div>
                <div>
                    <input type="checkbox" id="wppct_gl_settings_options_heading" name="wppct_gl_settings_options[]" value="heading" <?= in_array('heading', $gl_options) ? 'checked="checked"' : '' ?>>
                    <label for="wppct_gl_settings_options_heading">Заголовок</label>
                </div>
                <div>
                    <input type="checkbox" id="wppct_gl_settings_options_timer" name="wppct_gl_settings_options[]" value="timer" <?= in_array('timer', $gl_options) ? 'checked="checked"' : '' ?>>
                    <label for="wppct_gl_settings_options_timer">Таймер</label>
                </div>
                <div>
                    <input type="checkbox" id="wppct_gl_settings_options_paragraph" name="wppct_gl_settings_options[]" value="paragraph" <?= in_array('paragraph', $gl_options) ? 'checked="checked"' : '' ?>>
                    <label for="wppct_gl_settings_options_paragraph">Подзаголовок</label><br>
                </div>
                <div>
                    <input disabled type="checkbox" id="wppct_gl_settings_options_progress_bar" name="wppct_gl_settings_options[]" value="progress_bar" <?= in_array('progress_bar', $gl_options) ? 'checked="checked"' : '' ?>>
                    <label for="wppct_gl_settings_options_progress_bar">Полоса прогресса</label>
                </div>
                <div>
                    <input type="checkbox" id="wppct_gl_settings_options_button" name="wppct_gl_settings_options[]" value="button" <?= in_array('button', $gl_options) ? 'checked="checked"' : '' ?>>
                    <label for="wppct_gl_settings_options_button">Кнопка</label><br>
                </div>
            </div>
        </div>

        <div class="wppct-grig-section date_picker">
            <p>Срок</p>
            <div>
                <input class="datepicker" name="datepicker" placeholder=" <?php
                    if (empty($gl_gatetime)) {
                        echo 'Введите дату и время';
                    } else {
                        echo $gl_gatetime;
                    } ?>">
                <input type="hidden" name="wppct_gl_settings_datetime" id="wppct_gl_settings_datetime" value="<?= $gl_gatetime ?>">
            </div>
        </div>
    </section>

    <section class="wppct_metabox_wrapper" id="heading">

        <h2>Настройки заголовка</h2>

        <div class="wppct-grig-section text">
            <p>Текст заголовка</p>
            <input type="text" name="wppct_heading_settings_text" id="wppct_heading_settings_text" value="<?= $heading_text ?>">
        </div>

        <div class="wppct-grig-section fontsize">
            <p>Размер текста</p>
            <input type="number" name="wppct_heading_settings_fontsize" id="wppct_heading_settings_fontsize" value="<?= $heading_fontsize ?>">
            <label for="wppct_heading_settings_fontsize">px</label>
        </div>

    </section>

    <section class="wppct_metabox_wrapper" id="timer">

        <h2>Настройки таймера</h2>

        <div class="wppct-grig-section fontsize">
            <p>Размер цифр</p>
            <input type="number" name="wppct_tm_settings_fontsize" id="wppct_tm_settings_fontsize" value="<?= $timer_fontsize ?>">
            <label for="wppct_tm_settings_fontsize">px</label>
        </div>

    </section>

    <section class="wppct_metabox_wrapper" id="paragraph">

        <h2>Настройки параграфа</h2>

        <div class="wppct-grig-section text">
            <p>Текст заголовка</p>
            <textarea type="text" name="wppct_pgh_settings_text" id="wppct_pgh_settings_text" value="" rows="5"><?= $paragraph_text ?></textarea>
        </div>

        <div class="wppct-grig-section fontsize">
            <p>Размер текста</p>
            <input type="number" name="wppct_pgh_settings_fontsize" id="wppct_pgh_settings_fontsize" value="<?= $paragraph_fontsize ?>">
            <label for="wppct_pgh_settings_fontsize">px</label>
        </div>

    </section>

    <section class="wppct_metabox_wrapper" id="progress_bar">

        <h2>Настройки полосы прогресса</h2>

        <?php include('wppct-currently-unavalible-layout.php') ?>

    </section>
    
    <section class="wppct_metabox_wrapper" id="button">

        <h2>Настройки кнопки</h2>

        <div class="wppct-grig-section text">
            <p>Текст кнопки</p>
            <input type="text" name="wppct_btn_settings_text" id="wppct_btn_settings_text" value="<?= $button_text ?>">
        </div>

        <div class="wppct-grig-section fontsize">
            <p>Размер текста</p>
            <input type="number" name="wppct_btn_settings_fontsize" id="wppct_btn_settings_fontsize" value="<?= $button_fontsize ?>">
            <label for="wppct_btn_settings_fontsize">px</label>
        </div>

        <div class="wppct-grig-section link">
            <p>Ссылка</p>
            <input type="text" name="wppct_btn_settings_link" id="wppct_btn_settings_link" value="<?= $button_link ?>">
        </div>

    </section>
</div>
