<?php
if ( !defined('ABSPATH') ) {
    die;
} ?>
<section class="wpet_metabox_wrapper" id="general">

    <div class="wpet-grig-section blockwidth">
        <label for="wpet_gl_settings_blockwidth">Ширина блока</label>
        <input type="number" id="wpet_gl_settings_blockwidth" name="wpet_gl_settings_blockwidth" value="<?=esc_html($blockwidth)?>">
    </div>

    <div class="wpet-grig-section options">
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

    <div class="wpet-grig-section order">
        <p>Порядок</p>
        <ul id="sortable">
            <li class="ui-state-default">Заголовок<span class="ui-icon ui-icon-arrowthick-2-n-s"></li>
            <li class="ui-state-default">Таймер<span class="ui-icon ui-icon-arrowthick-2-n-s"></li>
            <li class="ui-state-default">Подзаголовок<span class="ui-icon ui-icon-arrowthick-2-n-s"></li>
            <li class="ui-state-default">Полоса прогресса<span class="ui-icon ui-icon-arrowthick-2-n-s"></li>
            <li class="ui-state-default">Кнопка<span class="ui-icon ui-icon-arrowthick-2-n-s"></li>
        </ul>
    </div>

    <div class="wpet-grig-section timer_type">
        <p>Тип таймера</p>
        <div>
            <select name="wpet_gl_settings_timer_type">
                <option value="until_date">До даты</option>
                <option value="by_time">По времени</option>
            </select>
        </div>
    </div>

    <div class="wpet-grig-section date_picker">
        <p>Срок</p>
        <div>
            <input class="datepicker" name="datepicker" placeholder="Введите дату и время">
        </div>
    </div>

</section>