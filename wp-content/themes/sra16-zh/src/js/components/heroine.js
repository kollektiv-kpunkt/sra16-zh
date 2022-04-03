const people = [
  {
    name: "florine",
    ds: "1",
  },
  {
    name: "amelie",
    ds: "2",
  },
  {
    name: "nicolo",
    ds: "3",
  },
];

let i = 0;
let wrap = 0;

function heroineSlider() {
  let bgimg = document.querySelector("#heroine-bg-container img");
  let img = document.querySelector("#heroine-img-container img");
  setTimeout(() => {
    wrap++;
    if (wrap === people.length) {
      wrap = 0;
    }
    console.log(wrap);
    bgimg.style.opacity = "0";
    img.style.opacity = "0";
    setTimeout(() => {
      bgimg.src = `/wp-content/themes/sra16-zh/public/heroines/${people[wrap].name}_bg.jpg`;
      img.src = `/wp-content/themes/sra16-zh/public/heroines/${people[wrap].name}_heroine.png`;
      setTimeout(() => {
        bgimg.style.opacity = "1";
        img.style.opacity = "1";
        document.querySelector("body").classList.remove(`ds-1`);
        document.querySelector("body").classList.remove(`ds-2`);
        document.querySelector("body").classList.remove(`ds-3`);
        document.querySelector("body").classList.remove(`ds-4`);
        document.querySelector("body").classList.remove(`ds-5`);
        document.querySelector("body").classList.add(`ds-${wrap + 1}`);
      }, 500);
    }, 500);
  }, 3000 * i);
}

setInterval(() => {
  heroineSlider();
  i++;
}, 5000);
