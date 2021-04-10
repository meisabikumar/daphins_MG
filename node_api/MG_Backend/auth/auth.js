
let jwt = require("jsonwebtoken");
let bcrypt = require("bcryptjs");


let authenticateJWT = async (req, res, next) => {
    // console.log("here")
    let authHeader = req.headers.authorization || req.cookies.authorization;
    // console.log(authHeader)
    let token
    if(req.headers.authorization){
        token = authHeader.split(' ')[1]
    } else {
        token = authHeader
    }
    if (authHeader) {
      jwt.verify(token, process.env.SECRET, (err, user) => {
        if (err) {
          return res.sendStatus(403);
        }
        req.user = user;
        next();
      });
    } else {
      res.render('error.ejs')
    }
  };

  module.exports = authenticateJWT