// Timer Class
class CountdownTimer {
    constructor(deadline, cbChange, cbComplete) {
        this._deadline = deadline;
        this._cbChange = cbChange;
        this._cbComplete = cbComplete;
        this._timerId = null;
        this._out = {
        days: '', hours: '', minutes: '', seconds: '',
        daysTitle: '', hoursTitle: '', minutesTitle: '', secondsTitle: ''
        };
        this._start();
    }
    static declensionNum(num, words) {
        return words[(num % 100 > 4 && num % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(num % 10 < 5) ? num % 10 : 5]];
    }
    _start() {
        this._calc();
        this._timerId = setInterval(this._calc.bind(this), 1000);
    }
    _calc() {
        const diff = this._deadline - new Date();
        const days = diff > 0 ? Math.floor(diff / 1000 / 60 / 60 / 24) : 0;
        const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
        const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
        const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
        this._out.days = days < 10 ? '0' + days : days;
        this._out.hours = hours < 10 ? '0' + hours : hours;
        this._out.minutes = minutes < 10 ? '0' + minutes : minutes;
        this._out.seconds = seconds < 10 ? '0' + seconds : seconds;
        this._out.daysTitle = CountdownTimer.declensionNum(days, ['день', 'дня', 'дней']);
        this._out.hoursTitle = CountdownTimer.declensionNum(hours, ['час', 'часа', 'часов']);
        this._out.minutesTitle = CountdownTimer.declensionNum(minutes, ['минута', 'минуты', 'минут']);
        this._out.secondsTitle = CountdownTimer.declensionNum(seconds, ['секунда', 'секунды', 'секунд']);
        this._cbChange ? this._cbChange(this._out) : null;
        if (diff <= 0) {
        clearInterval(this._timerId);
        this._cbComplete ? this._cbComplete() : null;
        }
    }
}

const timers = document.querySelectorAll(".wpet-timer-timer");

timers.forEach(timer => {
    // Timer data
    let timer_id = '.timer-' + timer.querySelector('input[name="wpet-timer_id"]').value;
    let timer_datetime = timer.querySelector('input[name="wpet-timer_datetime"]').value;

    // Timer datetime parse
    let year = timer_datetime.slice(6, 10);
    let month = timer_datetime.slice(3, 5) - 1;
    let day = timer_datetime.slice(0, 2);
    let hour = timer_datetime.slice(11, 13);
    let minute = timer_datetime.slice(14, 16);

    // Timer elements
    let elDays = document.querySelector(timer_id + ' .timer__days');
    let elHours = document.querySelector(timer_id + ' .timer__hours');
    let elMinutes = document.querySelector(timer_id + ' .timer__minutes');
    let elSeconds = document.querySelector(timer_id + ' .timer__seconds');

    // Datetime
    let deadline = new Date(year, month, day, hour, minute);

    // New Timer Obj
    new CountdownTimer(deadline, (timer) => {
        elDays.textContent = timer.days;
        elHours.textContent = timer.hours;
        elMinutes.textContent = timer.minutes;
        elSeconds.textContent = timer.seconds;
        elDays.dataset.title = timer.daysTitle;
        elHours.dataset.title = timer.hoursTitle;
        elMinutes.dataset.title = timer.minutesTitle;
        elSeconds.dataset.title = timer.secondsTitle;
      }, () => {
        document.querySelector(timer_id + ' .timer__result').textContent = 'Таймер завершился!';
      });
});