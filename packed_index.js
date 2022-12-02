import { initializeApp } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-auth.js";
import { getStorage, ref, uploadBytes, deleteObject, getDownloadURL } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-storage.js";

const firebaseConfig = {
    apiKey: "AIzaSyDX_xnSZz_-69R0QKbklQdMZwbZK5_aH7E",
    authDomain: "admin-panel-248fb.firebaseapp.com",
    projectId: "admin-panel-248fb",
    storageBucket: "admin-panel-248fb.appspot.com",
    messagingSenderId: "341702481485",
    appId: "1:341702481485:web:f6d3b893e07c53f757ee04"
  };
  
const app = initializeApp(firebaseConfig);
const storage = getStorage(app);

var btn_upload = document.getElementById('imgupload');
btn_upload.addEventListener('click', (e) =>{

    const file = document.getElementById('fileitem').files[0];
    const filename = document.getElementById('fileitem').files[0].name;
    const storageRef = ref(storage,filename );
    uploadBytes(storageRef, file).then((snapshot) => {
        alert('Successful upload');
    });

})

/*

window.onload = function () {
    document.getElementById('fileitem').onchange = function () { uploadFile() };
}

function uploadFile() {
    const file = document.getElementById('fileitem').files[0];
    const filename = document.getElementById('fileitem').files[0].name;
    const storageRef = ref(storage,filename );
    uploadBytes(storageRef, file).then((snapshot) => {
        alert('Successful upload');
    });
}
*/