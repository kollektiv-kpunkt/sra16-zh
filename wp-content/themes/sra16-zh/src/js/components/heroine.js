const people = ["florine", "amelie", "nicolo", "daria", "chiara"];

let i = 0;
let wrap = 0;

function heroineSlider() {
  let person = people[wrap];
  let bgimg = document.querySelector(
    `#heroine-bg-container img[data-heroine-person="${person}"]`
  );
  let img = document.querySelector(
    `#heroine-img-container img[data-heroine-person="${person}"]`
  );
  bgimg.classList.remove("heroine-active");
  img.classList.remove("heroine-active");
  wrap++;
  if (wrap === people.length) {
    wrap = 0;
  }
  person = people[wrap];
  bgimg = document.querySelector(
    `#heroine-bg-container img[data-heroine-person="${person}"]`
  );
  img = document.querySelector(
    `#heroine-img-container img[data-heroine-person="${person}"]`
  );
  setTimeout(() => {
    bgimg.classList.add("heroine-active");
    img.classList.add("heroine-active");
    document.querySelector("body").classList.remove(`ds-1`);
    document.querySelector("body").classList.remove(`ds-2`);
    document.querySelector("body").classList.remove(`ds-3`);
    document.querySelector("body").classList.remove(`ds-4`);
    document.querySelector("body").classList.remove(`ds-5`);
    document.querySelector("body").classList.add(`ds-${wrap + 1}`);
  }, 500);
}

if (document.getElementById("heroine-bg-container")) {
  setInterval(() => {
    heroineSlider();
    i++;
  }, 7000);
}
