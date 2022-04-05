import { v4 as uuid } from "uuid";

function ctaLogic(button) {
  let type = button.getAttribute("data-action");
  let buttonContainer = button.parentElement;
  if (type === "newsletter") {
    buttonContainer.remove();
    let newsletterContainer = document.querySelector(
      ".cta-newsletter-container"
    );
    newsletterContainer.style.display = "block";
  }
}

document
  .querySelectorAll(".cta-buttons-container .sra-button[data-action]")
  .forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      ctaLogic(button);
    });
  });

function sendNewsletter(e) {
  e.preventDefault();
  let form = e.target;
  let formWrapper = form.querySelector(".form-wrapper");
  let alertBar = form.querySelector(".alertBar");
  var data = {
    uuid: uuid(),
    fname: form.querySelector("#fname").value,
    email: form.querySelector("#email").value,
    optin: form.querySelector("#optin").checked,
  };

  (async () => {
    const rawResponse = await fetch(`/api/v1/newsletter`, {
      method: "POST",
      headers: {
        // Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    const content = await rawResponse.json();
    if (content.status === "success") {
      formWrapper.style.display = "none";
      alertBar.style.display = "block";
      alertBar.classList.add(content.status);
      alertBar.innerText = content.message;
    } else {
      alertBar.classList.add(content.status);
      alertBar.style.display = "block";
      alertBar.innerText = content.message;
    }
  })();
}

if (document.querySelector(".cta-newsletter-container form")) {
  document
    .querySelector(".cta-newsletter-container form")
    .addEventListener("submit", sendNewsletter);
}
