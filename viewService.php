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
    <title>Service Assist</title>
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
        <h2 class="h2">Service Assist</h2>
    </div>
    <div>
        <table id="usertable">
            <thead>
                <th class="text-center">S.N.</th>
                <th class="text-center">User </th>
                <th class="text-center">Address</th>
                <th class="text-left pl-5">action</th>
            </thead>
            <tbody id="tbody1">

            </tbody>
        </table>
    </div>

    <script type="text/javascript">
    var tbody = document.getElementById('tbody1');

    var assistNo = 0;
    var slist = [];

    function AddItemToTable(email, address) {
        let row = document.createElement('tr');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');


        slist.push([address]);
        td1.innerHTML = ++assistNo;
        td2.innerHTML = email;
        td3.innerHTML = address;


        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);

        var ControlDiv = document.createElement("div");
        ControlDiv.innerHTML =
            '<button type="submit" class="btn btn-secondary ml-5 my-2" style="height:40px" data-toggle="modal" data-target="#delModal" onclick="map(' +
            assistNo + ')">Open in Maps</button>';
        row.appendChild(ControlDiv);
        tbody.appendChild(row);
    }

    function AddAllItemsToTable(Serviceassist) {

        var assistNo = 0;
        tbody.innerHTML = "";
        Serviceassist.forEach(element => {
            AddItemToTable(element.email, element.address, element.status);
        });
    }


    function map(index) {
        --index;
        maplink = slist[index][0]
        //window.location.href="https://maps.google.com/?q="+maplink;
        window.open("https://maps.google.com/?q=" + maplink, "_blank");
    }
    </script>
    <script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
    import {
        getFirestore,
        doc,
        getDocs,
        onSnapshot,
        collection
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
        const dbRef = collection(db, "breakdowns");
        onSnapshot(dbRef, (querySnapshot) => {
            var Serviceassist = [];
            querySnapshot.forEach(doc => {
                Serviceassist.push(doc.data());
                // console.log(doc.data());
            });

            AddAllItemsToTable(Serviceassist);
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