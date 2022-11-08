<div class="wppct-timer-timer timer-<?= $options['timer_id'] ?>">
  <div class="timer__items">
    <div class="timer__item timer__days" style="font-size: <?= $options['tm_fontsize'] ?>px;">00</div>
    <div class="timer__item timer__hours" style="font-size: <?= $options['tm_fontsize'] ?>px;">00</div>
    <div class="timer__item timer__minutes" style="font-size: <?= $options['tm_fontsize'] ?>px;">00</div>
    <div class="timer__item timer__seconds" style="font-size: <?= $options['tm_fontsize'] ?>px;">00</div>
  </div>
  <div class="timer__result"></div>
  <input type="hidden" name="wppct-timer_id" value="<?= $options['timer_id'] ?>">
  <input type="hidden" name="wppct-timer_datetime" value="<?= $options['gl_datetime'] ?>">
  <input type="hidden" name="wppct-timer_timezone" value="<?= get_option('gmt_offset') ?>">
</div>