import { v4 as uuid } from "uuid";

function sendKomitee(e) {
  e.preventDefault();
  let form = e.target;
  let formWrapper = form.querySelector(".form-wrapper");
  let alertBar = form.querySelector(".alertBar");
  var data = {
    uuid: uuid(),
    fname: document.getElementById("fname").value,
    lname: document.getElementById("lname").value,
    position: document.getElementById("position").value,
    email: document.getElementById("email").value,
    optin: document.getElementById("optin").checked,
  };

  (async () => {
    const rawResponse = await fetch(`/api/v1/komitee`, {
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
    }
  })();
}

document.querySelector("#komitee-form").addEventListener("submit", sendKomitee);
