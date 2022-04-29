if (document.getElementById("sra-popup-close")) {
  document
    .getElementById("sra-popup-close")
    .addEventListener("click", function () {
      document.getElementById("sra-popup-wrapper").style.opacity = 0;
      document.getElementById("sra-popup-wrapper").style.visibility = "hidden";
      document.getElementById("sra-popup-blind").style.opacity = 0;
      setTimeout(() => {
        document.getElementById("sra-popup-wrapper").remove();
        document.getElementById("sra-popup-blind").remove();
      }, 250);
    });
}
