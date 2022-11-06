<div class="wpet-timer-timer timer-<?= $options['timer_id'] ?>">
  <div class="timer__items">
    <div class="timer__item timer__days">00</div>
    <div class="timer__item timer__hours">00</div>
    <div class="timer__item timer__minutes">00</div>
    <div class="timer__item timer__seconds">00</div>
  </div>
  <div class="timer__result"></div>
  <input type="hidden" name="wpet-timer_id" value="<?= $options['timer_id'] ?>">
  <input type="hidden" name="wpet-timer_datetime" value="<?= $options['gl_datetime'] ?>">
  <input type="hidden" name="wpet-timer_timezone" value="<?= get_option('gmt_offset') ?>">
</div>