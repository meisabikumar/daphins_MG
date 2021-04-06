// Initialize Firebase
// var config = {
// 	apiKey: "AIzaSyCM6HkdFXiEyHWMHRumjXQSXRxkCyT99u8",
// 	authDomain: "my-test-app-91f99.firebaseapp.com",
// 	databaseURL: "https://my-test-app-91f99.firebaseio.com",
// 	projectId: "my-test-app-91f99",
// 	storageBucket: "my-test-app-91f99.appspot.com",
// 	messagingSenderId: "279160965485"
// };
var firebaseConfig = {
    apiKey: "AIzaSyCndZ75KTbKXtnXSbhi_7ZWT6AtCcgpwK4",
    authDomain: "myclubtap.firebaseapp.com",
    databaseURL: "https://myclubtap.firebaseio.com",
    projectId: "myclubtap",
    storageBucket: "myclubtap.appspot.com",
    messagingSenderId: "742055482305",
    appId: "1:742055482305:web:ac5a3d309b2277eb205540",
    measurementId: "G-BZRXR0EP0J"
  };

firebase.initializeApp(config); 

// Initialize Cloud Firestore through Firebase
var db = firebase.firestore();

// Disable deprecated features
// db.settings({
// 	timestampsInSnapshots: true
// });