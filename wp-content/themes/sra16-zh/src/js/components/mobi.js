import { Notyf } from "notyf";
var showdown = require("showdown");
import "notyf/notyf.min.css";
const notyf = new Notyf();

if (document.querySelector("#sra-mobi-buttons button")) {
  document.querySelectorAll("#sra-mobi-buttons button").forEach((button) => {
    button.addEventListener("click", function (e) {
      let lang;
      if (document.getElementById("sra-mobi-changelang")) {
        lang = document
          .getElementById("sra-mobi-changelang")
          .getAttribute("data-mobi-lang");
      } else {
        lang = "de";
      }
      let type = e.target.getAttribute("data-type");
      let text = document.querySelector(
        `#sra-mobimessage #sra-msg-${lang}`
      ).innerHTML;
      text = text.replace(/<p>(.*)<\/p>/g, "$1");
      text = text.replace(/<strong>(.*)<\/strong>/g, "$1");
      _paq.push(["trackEvent", "Schlussmobi", type, text]);
      let url = document
        .querySelector("#sra-mobimessage")
        .getAttribute("data-mobi-url");
      if (type == "whatsapp") {
        text = text.replace(/<b>(.*)<\/b>/g, "*$1*");
        window.open(
          `https://api.whatsapp.com/send/?text=${encodeURIComponent(
            text
          )}%0A${encodeURIComponent(url)}`
        );
      } else if (type == "facebook") {
        window.open(
          `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
            url
          )}`
        );
      } else if (type == "twitter") {
        text = text.replace(/<b>(.*)<\/b>/g, "$1");
        window.open(
          `https://twitter.com/intent/tweet?text=${encodeURIComponent(
            text
          )}%0A${encodeURIComponent(url)}`
        );
      } else if (type == "email") {
        window.open(
          `mailto:?body=${encodeURIComponent(text)}%0A${encodeURIComponent(
            url
          )}`
        );
      } else if (type == "copy") {
        navigator.clipboard.writeText(text + "\n" + url);
        notyf.success("Die Nachricht wurde in die Zwischenablage kopiert!");
      } else if (type == "telegram") {
        text = text.replace(/<b>(.*)<\/b>/g, "**$1**");
        window.open(
          `https://t.me/share/url?url=${encodeURIComponent(
            url
          )}&text=${encodeURIComponent(text)}`
        );
      }
    });
  });
}

if (document.getElementById("sra-mobi-changelang")) {
  document
    .getElementById("sra-mobi-changelang")
    .addEventListener("click", function (e) {
      let lang = e.target.getAttribute("data-mobi-lang");
      let msg = document.querySelector(`#sra-msg-${lang}`);
      msg.style.display = "none";
      if (lang == "de") {
        lang = "ch";
        e.target.innerText = "Hochdeutsch";
      } else {
        lang = "de";
        e.target.innerText = "CH-Deutsch";
      }
      msg = document.querySelector(`#sra-msg-${lang}`);
      msg.style.display = "block";
      e.target.setAttribute("data-mobi-lang", lang);
    });
}
