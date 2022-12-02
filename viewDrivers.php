<?php
session_start();
$count = 0;
if (!isset($_SESSION['email'])) {
    header("Location:login.php");
} else {
    $count++;
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>View Drivers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-  Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    </link>
</head>

<body>

    <?
    include "./adminHeader.php";
    include "./sidebar.php";
    ?>



    <div>
        <h2 class="h2">All Drivers</h2>
    </div>
    <div>
        <table id="usertable">
            <thead>
                <th class="text-center">S.N.</th>
                <th class="text-center">Username </th>
                <th class="text-center">Email</th>
                <th class="text-center">Contact Number</th>
                <th class="text-center">Is Available?</th>
                <th class="text-center">Registered Date</th>
            </thead>
            <tbody id="tbody1">

            </tbody>
        </table>
    </div>

    <script type="module">
    var tbody = document.getElementById('tbody1');

    var userNo = 0;

    function AddItemToTable(fullName, email, mobileNo, isAvailable, registeredDate) {
        let row = document.createElement('tr');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');
        let td6 = document.createElement('td');

        td1.innerHTML = ++userNo;
        td2.innerHTML = fullName;
        td3.innerHTML = email;
        td4.innerHTML = mobileNo;
        td5.innerHTML = isAvailable;
        td6.innerHTML = registeredDate;

        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);


        tbody.appendChild(row);
    }

    function AddAllItemsToTable(users) {

        var userNo = 0;
        tbody.innerHTML = "";
        users.forEach(element => {
            AddItemToTable(element.fullName, element.email, element.mobileNo, element.isAvailable, element
                .registeredDate);
        });
    }

    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
    import {
        getFirestore,
        doc,
        getDocs,
        onSnapshot,
        collection,
        where,
        query
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-firestore.js";

    const firebaseConfig = {
        apiKey: "AIzaSyCRuqAbV-e21DW5DmqVHaHMSf-Nedvh1kY",
        authDomain: "ppaapp-5d413.firebaseapp.com",
        projectId: "ppaapp-5d413",
        storageBucket: "ppaapp-5d413.appspot.com",
        messagingSenderId: "415052255713",
        appId: "1:415052255713:web:20e1b4959d37d4d68d42a0",
        measurementId: "G-PYN9WRV7F9"
    };


    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const db = getFirestore();



    async function GetAllDataRealtime() {

        const q = query(collection(db, "users"), where("role", "==", "Driver"));
        onSnapshot(q, (querySnapshot) => {
            var users = [];
            querySnapshot.forEach(doc => {
                users.push(doc.data());
                //console.log(doc.data());
            });
            AddAllItemsToTable(users);
        });
    }
    window.onload = GetAllDataRealtime;
    </script>

    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>