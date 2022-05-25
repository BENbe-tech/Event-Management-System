/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyBa4IMUOp5iSAii_oNS2UMgxGfSEe4VN-U",
    authDomain: "ems-system-4a9ce.firebaseapp.com",
    databaseURL: "https://ems-system-4a9ce-default-rtdb.firebaseio.com/",
    projectId: "ems-system-4a9ce",
    storageBucket: "ems-system-4a9ce.appspot.com",
    messagingSenderId: "296613395959",
   appId: "1:296613395959:web:62d752dd125b212fcd02f2",
    measurementId: "G-T7QLH0JLL0"
    });

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
