glowCookies.start("en", {
  hideAfterClick: true,
  policyVersion: 1,
  border: "none",
  customScript: [
    {
      type: "custom",
      position: "body",
      content: "_paq.push(['rememberConsentGiven']);",
    },
  ],
  policyLink: "/datenschutz",
  bannerDescription:
    "Um unsere Kampagne zu optimieren, setzen wir auf unserer Webseite Cookies ein. Mit deinem Einverständnis hilft du uns, eine effiziente Kampagne durchzuführen.",
  bannerLinkText: "Mehr erfahren",
  bannerBackground: "#ffffff",
  bannerColor: "#232323",
  bannerHeading: "<span style='color: var(--color60)'>Datenschutz</span>",
  acceptBtnText: "Zustimmen",
  acceptBtnColor: "#ffffff",
  acceptBtnBackground: "var(--color60)",
  rejectBtnText: '<i class="fas" id="cookie-reject"></i>',
  rejectBtnColor: "white",
  rejectBtnBackground: "black",
});
