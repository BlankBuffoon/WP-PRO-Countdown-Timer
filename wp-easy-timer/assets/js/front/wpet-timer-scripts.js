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

// Convert float number to time
function convertNumToTime(number) {
    // Check sign of given number
    var sign = (number >= 0) ? 1 : -1;

    // Set positive value of number of sign negative
    number = number * sign;

    // Separate the int from the decimal part
    var hour = Math.floor(number);
    var decpart = number - hour;

    var min = 1 / 60;
    // Round to nearest minute
    decpart = min * Math.round(decpart / min);

    var minute = Math.floor(decpart * 60) + '';

    // Add padding if need
    if (minute.length < 2) {
    minute = '0' + minute; 
    }

    hour = hour.toString();
    if (hour.length < 2) {
    hour = '0' + hour; 
    }

    // Add Sign in final result
    sign = sign == 1 ? '+' : '-';

    // Concate hours and minutes
    time = sign + hour + ':' + minute;

    return time;
}


// Multitimer support
const timers = document.querySelectorAll(".wpet-timer-timer");

timers.forEach(timer => {
    // Timer data
    let timer_id = '.timer-' + timer.querySelector('input[name="wpet-timer_id"]').value;
    let timer_datetime = timer.querySelector('input[name="wpet-timer_datetime"]').value;
    let timer_timezone = timer.querySelector('input[name="wpet-timer_timezone"]').value;

    // Timer datetime parse
    let year = timer_datetime.slice(6, 10);
    let month = timer_datetime.slice(3, 5);
    let day = timer_datetime.slice(0, 2);
    let hour = timer_datetime.slice(11, 13);
    let minute = timer_datetime.slice(14, 16);

    // Convert to ISO 8601
    let iso8601_datetime = year + '-' + month + '-' + day + 'T' + hour + ':' + minute + convertNumToTime(timer_timezone);

    // Timer elements
    let elDays = document.querySelector(timer_id + ' .timer__days');
    let elHours = document.querySelector(timer_id + ' .timer__hours');
    let elMinutes = document.querySelector(timer_id + ' .timer__minutes');
    let elSeconds = document.querySelector(timer_id + ' .timer__seconds');

    // Datetime
    let deadline = new Date(Date.parse(iso8601_datetime));

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
      }, () => {});
});