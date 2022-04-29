const countDownDate = new Date("May 15, 2022 11:00:00").getTime();

const names = {
  days: ["Tage", "Tag"],
  hours: ["Stunden", "Stunde"],
  minutes: ["Minuten", "Minute"],
  seconds: ["Sekunden", "Sekunde"],
};

function calcDifference(date) {
  var distance = countDownDate - date;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  if (distance <= 0) {
    days = 0;
    hours = 0;
    minutes = 0;
    seconds = 0;
  }
  return {
    days: days,
    hours: hours,
    minutes: minutes,
    seconds: seconds,
  };
}

function setDigit(digit, digittype, difference) {
  var number = digit.querySelector(".sra-popup-countdown-number");
  var unit = digit.querySelector(".sra-popup-countdown-unit");
  number.innerText = difference[digittype];
  unit.innerText = names[digittype][difference[digittype] == 1 ? 1 : 0];
}

setInterval(() => {
  document.querySelectorAll(".sra-countdown-digit").forEach((digit) => {
    setDigit(
      digit,
      digit.getAttribute("data-digit-type"),
      calcDifference(new Date().getTime())
    );
  });
}, 1000);

window.addEventListener("load", () => {
  document.querySelectorAll(".sra-countdown-digit").forEach((digit) => {
    setDigit(
      digit,
      digit.getAttribute("data-digit-type"),
      calcDifference(new Date().getTime())
    );
  });
});
