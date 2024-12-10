const { createCanvas } = require("canvas");

const bodyParser = require("body-parser");

const express = require("express");

const fs = require("node:fs");

const app = express();

const httpsPort = 3006;

const pathKey = [__dirname, "/certsFiles/selfsigned.key"];

const certKey = [__dirname, "/certsFiles/selfsigned.crt"];

const key = fs.readFileSync(pathKey.join(""));

const cert = fs.readFileSync(certKey.join(""));

const credentials = {
  key,
  cert
};

const https = require("node:https").createServer(credentials, app);

https.listen(httpsPort, () => {

  console.log(`Https server listing on port : ${  httpsPort}`);
});

app.use(bodyParser.urlencoded({ extended: true }));

app.use(bodyParser.json());

app.use(function(req, res, next) {

  const allowedOrigins = [
    "https://login.sunnyhome.site", "http://localhost:3000"
  ];

  const origin = req.headers.origin;

  if (allowedOrigins.includes(origin)) {

    res.setHeader("Access-Control-Allow-Origin", origin);
  }

  res.header("Access-Control-Allow-Methods", "POST");
  res.header("Access-Control-Allow-Headers", "Content-Type, application/json");
  res.header("Access-Control-Allow-Credentials", true);
  return next();
});

const rand = () => {
  return Math.random().toString(36).slice(2);
};

const getToken = () => {
  return rand() + rand();
};

let captchaToken = "";

const alpha = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
  "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

let text = "";

const randomColor = () => {

  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);

  return `rgb(${  r  },${  g  },${  b  })`;
};

const init = () => {

  const canvas = createCanvas(140, 50);
  text = "";

  for (let i = 1; i <= 7; i++) {

    text += alpha[Math.floor(Math.random() * alpha.length)];
  }

  const context = canvas.getContext("2d");
  context.font = "25px Bold";

  let i = text.length;

  while (i--) {

    const sDeg = (Math.random() * 45 * Math.PI) / 180;
    const x = (i * 18) + 8;
    const y = (Math.random() * 10) + 25;

    context.translate(x, y);
    context.rotate(sDeg);
    context.fillStyle = randomColor();
    context.fillText(text[i], 0, 0);
    context.rotate(-sDeg);
    context.translate(-x, -y);
  }

  for (let i = 0; i < 5; i++) {

    context.strokeStyle = randomColor();
    context.beginPath();
    context.moveTo(
      Math.random() * canvas.width,
      Math.random() * canvas.height
    );
    context.lineTo(
      Math.random() * canvas.width,
      Math.random() * canvas.height
    );
    context.stroke();
  }

  for (let i = 0; i < 70; i++) {

    context.strokeStyle = randomColor();
    context.beginPath();
    const x = Math.random() * canvas.width;
    const y = Math.random() * canvas.height;
    context.moveTo(x, y);
    context.lineTo(x + 1, y + 1);
    context.stroke();
  }

  return canvas.toDataURL();
};

app.post("/captcha/init", function(req, res) {

  captchaToken = getToken();
  res.json({

    CaptchaToken: captchaToken,
    key: btoa(process.env.REACT_APP_KEY),
    Canvas: init()
  });
});

app.post("/captcha/authorization", function(req, res) {

  if (req.body.Text === text && req.body.CaptchaToken === captchaToken) {

    res.json({

      CaptchaToken: captchaToken,
      key: btoa(process.env.REACT_APP_KEY),
      CaptchaForm: false
    });
  } else {

    res.json({

      CaptchaToken: captchaToken,
      key: btoa(process.env.REACT_APP_KEY),
      CaptchaForm: "Incorrect"
    });
  }
});
