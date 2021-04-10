"use strict";

let express = require("express");
let routes = require("./routes/index");
let admin = require('./routes/admin/admin')

let fs = require('fs')
let sqlite3 = require('sqlite3')

let cors = require("cors");
let methodOverride = require("method-override");
let cookie_parser = require("cookie-parser");

require("dotenv").config();

let app = express();
let mongoose = require("mongoose");
var bodyParser = require("body-parser");

var path = require("path");
global.appRoot = path.resolve(__dirname);

app.use(express.static("assets"));
app.use(express.static("uploads"));
app.use(methodOverride("_method"));

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors());
app.use(cookie_parser());

// app.use("/api", routes);
// app.use("/admin", admin);


global.CustomError = require("./utilities/custom_error");
const multer = require("multer");
let urlencodedParser = bodyParser.urlencoded({ extended: true });

//mongoose

// mongoose.connect(process.env.MONGODB_URI, {
//   useNewUrlParser: true,
//   useCreateIndex: true,
//   useUnifiedTopology: true,
// });

//multer

const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, "./uploads");
  },
  filename: function (req, file, cb) {
    let extArray = file.mimetype.split("/");
    let extension = extArray[extArray.length - 1];
    cb(null, file.fieldname + "-" + Date.now() + "." + extension);
  },
});
const upload = multer({ storage: storage });

//routes import
let adminRoutes = require("./routes/admin/admin");
const router = require("./routes/admin/login");
const { throws } = require("assert");

//my sql

const dataSql = fs.readFileSync('./u467066974_mgdb.sql').toString();
let db = new sqlite3.Database('mydatabase', (err) => {
    if (err) {
      return console.error(err.message);
    }
    console.log('Connected to the in-memory SQLite database.');
  });
console.log("Heree")
let dataArr = dataSql.split(';')
db.serialize(() => {
    console.log("Working")
    db.run('PRAGMA foreign_keys=OFF;');
  db.run('BEGIN TRANSACTION;');
  dataArr.forEach((query) => {
    if(query) {
      // Add the delimiter back to each query before you run them
      // In my case the it was `);`
      query += ';';
      db.run(query, (err) => {
         if(err) throw err;
      });
    }
  });
  db.run('COMMIT;');
});

db.close((err) => {
    if (err) {
      return console.error(err.message);
    }
    console.log('Closed the database connection.');
  });

app.get("/", async (req, res) => {
  res.render("login");
});

app.set("view engine", "ejs");

app.listen(process.env.PORT || 5000, () => {
  console.log(`server running on port ${process.env.PORT || 5000}`);
});

module.exports = app;
