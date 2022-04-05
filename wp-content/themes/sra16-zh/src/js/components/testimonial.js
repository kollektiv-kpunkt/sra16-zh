import "cropperjs/dist/cropper.css";
import Cropper from "cropperjs";
import { v4 as uuid } from "uuid";

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
        var croppedimage = cropper.getCroppedCanvas().toDataURL("image/jpg");
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
                document.getElementById(
                  "testimonial-presentation-container"
                ).style.display = "block";
              }
            })();
          }
        })();
      });
    };
  }
}
