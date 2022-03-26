var countdownNumberEl = document.getElementById('countdown-number');
var countdown = 60;

countdownNumberEl.textContent = countdown;

setInterval(function() {
  countdown = --countdown <= 0 ? 0 : countdown;

  countdownNumberEl.textContent = countdown;
}, 1000);