_paq.push(["rememberConsentGiven"]);

/* FB */
!(function (f, b, e, v, n, t, s) {
  if (f.fbq) return;
  n = f.fbq = function () {
    n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
  };

  if (!f._fbq) f._fbq = n;
  n.push = n;
  n.loaded = !0;
  n.version = "2.0";

  n.queue = [];
  t = b.createElement(e);
  t.async = !0;

  t.src = v;
  s = b.getElementsByTagName(e)[0];

  s.parentNode.insertBefore(t, s);
})(
  window,
  document,
  "script",

  "https://connect.facebook.net/en_US/fbevents.js"
);

fbq("init", "510581613773365");

fbq("track", "PageView");

/* NOSCRIPT */

const noscript = document.createElement("noscript");
const noscriptImg = document.createElement("img");
noscriptImg.src =
  "https://www.facebook.com/tr?id=510581613773365&ev=PageView&noscript=1";
noscriptImg.width = 1;
noscriptImg.height = 1;
noscriptImg.style.display = "none";
noscript.appendChild(noscriptImg);
