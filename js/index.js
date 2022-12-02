
// Import the functions you need from the SDKs you need
  import { getFirestore, collection, getDocs, addDoc} from "https://www.gstatic.com/firebasejs/9.10.0/firebase-firestore.js";  
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDX_xnSZz_-69R0QKbklQdMZwbZK5_aH7E",
  authDomain: "admin-panel-248fb.firebaseapp.com",
  projectId: "admin-panel-248fb",
  storageBucket: "admin-panel-248fb.appspot.com",
  messagingSenderId: "341702481485",
  appId: "1:341702481485:web:f6d3b893e07c53f757ee04"
};

// Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const db = getFirestore(app);
  const auth = getAuth();

//const querySnapshot = await getDocs(collection(db, "users"));
//querySnapshot.forEach((doc) => {
//console.log(`${doc.id} => ${doc.data()}`);
//alert(`${doc.id} => ${doc.data()}`);

signInWithEmailAndPassword(auth, email, password)
  .then((userCredential) => {
    // Signed in 
    const user = userCredential.user;
    window.location.href="index.php";
    // ...
  })
  .catch((error) => {
    const errorCode = error.code;
    const errorMessage = error.message;
  });

