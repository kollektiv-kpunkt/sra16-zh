import "cropperjs/dist/cropper.css";
import Cropper from "cropperjs";
import { Notyf } from "notyf";
import "notyf/notyf.min.css"; // for React, Vue and Svelte
import { v4 as uuid } from "uuid";
import scrollIntoView from "scroll-into-view";

const notyf = new Notyf();

import { toJpeg, toCanvas } from "html-to-image";

if (document.querySelector("#testimonial-form")) {
  document
    .querySelector("#testimonial-form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      document.querySelector(
        ".form-step-container[data-testimonial-step='1']"
      ).style.display = "none";
      document.querySelector(
        ".form-step-container[data-testimonial-step='2']"
      ).style.display = "block";
      scrollIntoView(
        document.querySelector(
          ".form-step-container[data-testimonial-step='2']"
        )
      );
    });
}

if (document.querySelector("#testimonial-picture")) {
  document
    .querySelector("#testimonial-picture")
    .addEventListener("change", handleFiles, false);
  function handleFiles() {
    const picture = this.files[0];
    let reader = new FileReader();
    reader.readAsDataURL(picture);
    reader.onload = function (e) {
      const img = e.target.result;
      const testimonialImage = document.querySelector(
        "#cropper-testimonial-img"
      );
      const testimonialCreateButton = document.querySelector(
        "#cropper-testimonial-button"
      );
      document.querySelector("#upload-button-wrapper").remove();
      testimonialImage.src = img;
      testimonialCreateButton.style.display = "block";
      const cropper = new Cropper(testimonialImage, {
        aspectRatio: 1 / 2,
        autoCrop: true,
        autoCropArea: 1,
        viewMode: 1,
      });
      testimonialCreateButton.addEventListener("click", function (e) {
        e.preventDefault();
        document
          .querySelector("#testimonial-loader-blind")
          .classList.add("show");
        const croppedimage = cropper.getCroppedCanvas().toDataURL("image/jpg");
        (async () => {
          const rawResponse = await fetch(`/api/v1/testimonial/picture`, {
            method: "POST",
            headers: {
              // Accept: "application/json",
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              croppedimage: croppedimage,
            }),
          });
          const content = await rawResponse.json();
          if (content.status === "success") {
            let testimonialdata = {
              uuid: uuid(),
              testimonial_picture: content.imgurl,
              fname: document.getElementById("fname").value,
              lname: document.getElementById("lname").value,
              position: document.getElementById("position").value,
              email: document.getElementById("email").value,
              over18: document.getElementById("over18").checked,
              testimonial: document.getElementById("testimonial").value,
              optin: document.getElementById("optin").checked,
            };
            (async () => {
              const rawResponse = await fetch(`/api/v1/testimonial/data`, {
                method: "POST",
                headers: {
                  // Accept: "application/json",
                  "Content-Type": "application/json",
                },
                body: JSON.stringify(testimonialdata),
              });
              const content = await rawResponse.json();
              if (content.status === "success") {
                document.getElementById("testimonial-form").remove();
                console.log(testimonialdata);
                document.getElementById("testimonial-img").src = croppedimage;
                document.querySelector(
                  "#testimonial-quote i"
                ).innerText = `«${testimonialdata.testimonial}»`;
                document.querySelector(
                  "#testimonial-name b"
                ).innerText = `${testimonialdata.fname} ${testimonialdata.lname}`;
                document.querySelector("#testimonial-position").innerText =
                  testimonialdata.position;
                if (testimonialdata.over18) {
                  document.querySelector("#testimonial-slogan-1").innerText =
                    "Meine Stimme";
                  document.querySelector("#testimonial-slogan-2").innerText =
                    "für deine Stimme";
                } else {
                  document.querySelector("#testimonial-slogan-1").innerText =
                    "Deine Stimme";
                  document.querySelector("#testimonial-slogan-2").innerText =
                    "für meine Stimme";
                }

                if (testimonialdata.testimonial.length > 125) {
                  document
                    .querySelector("#testimonial-quote")
                    .classList.add("size-1");
                } else if (testimonialdata.testimonial.length > 80) {
                  document
                    .querySelector("#testimonial-quote")
                    .classList.add("size-2");
                }

                document.getElementById(
                  "testimonial-presentation-container"
                ).style.display = "block";
                setTimeout(() => {
                  document
                    .querySelector("#testimonial-loader-blind")
                    .classList.remove("show");
                }, 500);
              }
            })();
          }
        })();
      });
    };
  }
}

if (document.querySelector("#testimonial-change-ds")) {
  document
    .querySelector("#testimonial-change-ds")
    .addEventListener("click", function (e) {
      e.preventDefault();
      let ds = document.querySelector("body").getAttribute("data-ds");
      let dsNo = parseInt(ds.split("-")[1]);
      let newDs;
      if (dsNo === 5) {
        newDs = "ds-1";
      } else {
        newDs = `ds-${dsNo + 1}`;
      }
      document.querySelector("body").setAttribute("data-ds", newDs);
      document.querySelector("body").classList.remove(ds);
      document.querySelector("body").classList.add(newDs);
    });
}

if (document.querySelector("#testimonial-download")) {
  document
    .querySelector("#testimonial-download")
    .addEventListener("click", function (e) {
      e.preventDefault();
      notyf.success({
        message:
          "Dein Testimonial wird gleich heruntergeladen. Bitte habe einen Moment Geduld :)",
        duration: 5000,
      });
      if (
        document
          .querySelector(".testimonial-wrapper")
          .getAttribute("data-browser") === "fuckusafari"
      ) {
        downloadSafari();
      } else {
        downloadRegular();
      }
    });
}

function testimonialTest() {
  let testimonialdata = {
    uuid: uuid(),
    testimonial_picture:
      "/wp-content/themes/sra16-zh/public/testimonials/image_624ebf9bcca1714.jpg",
    fname: "Timothy",
    lname: "Oesch",
    position: "Grafiker und Student",
    email: "timothy",
    over18: true,
    testimonial:
      "Ich sage ja zum Stimmrechtsalter 16, weil die Zukunft der Jugend gehören soll!",
    optin: true,
  };

  document.getElementById("testimonial-form").remove();
  console.log(testimonialdata);
  document.getElementById("testimonial-img").src =
    testimonialdata.testimonial_picture;
  document.querySelector(
    "#testimonial-quote i"
  ).innerText = `«${testimonialdata.testimonial}»`;
  document.querySelector(
    "#testimonial-name b"
  ).innerText = `${testimonialdata.fname} ${testimonialdata.lname}`;
  document.querySelector("#testimonial-position").innerText =
    testimonialdata.position;
  if (testimonialdata.over18) {
    document.querySelector("#testimonial-slogan-1").innerText = "Meine Stimme";
    document.querySelector("#testimonial-slogan-2").innerText =
      "für deine Stimme";
  } else {
    document.querySelector("#testimonial-slogan-1").innerText = "Deine Stimme";
    document.querySelector("#testimonial-slogan-2").innerText =
      "für meine Stimme";
  }

  if (testimonialdata.testimonial.length > 125) {
    document.querySelector("#testimonial-quote").classList.add("size-1");
  } else if (testimonialdata.testimonial.length > 80) {
    document.querySelector("#testimonial-quote").classList.add("size-2");
  }

  document.getElementById("testimonial-presentation-container").style.display =
    "block";
}
testimonialTest();

function pixelsAreWhite(imageData) {
  let white = [];
  for (let i = 0; i < 60; i++) {
    white[i] = imageData.data[i] === 255;
  }
  console.log(white);
  return white.every(Boolean);
}

function downloadSafari() {
  toCanvas(document.getElementById("testimonial-container")).then((canvas) => {
    const context = canvas.getContext("2d");
    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    let test = pixelsAreWhite(imageData);
    let attempts = 0;
    if (test) {
      setTimeout(() => {
        console.log(`Trying Safari rendering again...`);
        downloadSafari();
        attempts++;
      }, 1000);
    } else {
      downloadRegular();
    }
  });
}

function downloadRegular() {
  toJpeg(document.getElementById("testimonial-container"), {
    quality: 1,
    pixelRatio: 4,
  }).then(function (dataUrl) {
    var link = document.createElement("a");
    let name = document.querySelector("#testimonial-name b").innerText;
    link.download = `SRA16-testimonial-${name}-${uuid()}.jpg`;
    link.href = dataUrl;
    link.click();
    link.remove();
  });
}
