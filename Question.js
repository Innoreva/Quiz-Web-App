var countdownNumberEl = document.getElementById('countdown-number');
var countdown = 60;

countdownNumberEl.textContent = countdown;

setInterval(function() {
  countdown = --countdown <= 0 ? 0 : countdown;

  if(parseInt(countdown)==0){
    document.getElementById("form-id").submit();
  }
 

  countdownNumberEl.textContent = countdown;
}, 1000);



