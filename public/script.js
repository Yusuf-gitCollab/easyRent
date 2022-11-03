import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";
import { collection, addDoc } from "firebase/firestore";
console.log("here we go")
const firebaseConfig = {
    apiKey: "AIzaSyB-cPHtToFAQHLfV-ZLKoVroS-Lf6Jk4XE",
    authDomain: "easyrent-ec7d6.firebaseapp.com",
    databaseURL: "https://easyrent-ec7d6-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "easyrent-ec7d6",
    storageBucket: "easyrent-ec7d6.appspot.com",
    messagingSenderId: "544208790303",
    appId: "1:544208790303:web:baf6f59e7d948d2db9462a",
    measurementId: "G-H7GZ4WKC6Y"
};

// Initialzie firebase
const app = initializeApp(firebaseConfig);

// Initialize Cloud Firestore and get reference to the service
const db = getFirestore(app);


try {
    const docRef = await addDoc(collection(db, "users"), {
        first: "Ada",
        last: "Lovelace",
        born: 1815
    });
    console.log("Document written with ID: ", docRef.id);
}catch(e) {
    console.log("Error adding Document: ", e);
}