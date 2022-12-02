<?php
session_start();
$count = 0;
if (!isset($_SESSION['email'])) {
    header("Location:login.php");
} else {
    $count++;
}
?>
<html>

<head>
    <title>View Orders</title>
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

    <div id="ordersBtn">
        <h2 class="h2">All Bookings</h2>
        <table class="table-striped">
            <thead>
                <th>O.N.</th>
                <th>Customer</th>
                <th>Vehicle</th>
                <th>BookedDate</th>
                <th>Address</th>
                <th>EndDate</th>
                <th>Driver</th>
            </thead>
            <tbody id="tbody2">
            </tbody>
        </table>

    </div>


    <script type="module">
    var tbody = document.getElementById('tbody2');



    function AddItemToTable(oNo, email, vehicle, bookedDate, address, endDate, driver) {
        let row = document.createElement('tr');
        let td0 = document.createElement('td');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');
        let td6 = document.createElement('td');

        td0.innerHTML = oNo;
        td1.innerHTML = email;
        td2.innerHTML = vehicle;
        td3.innerHTML = bookedDate;
        td4.innerHTML = address;
        td5.innerHTML = endDate;
        td6.innerHTML = driver;

        row.appendChild(td0);
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        tbody.appendChild(row);
    }


    function AddAllItemsToTable(bookings) {
        var oNo = 0;
        tbody.innerHTML = "";
        bookings.forEach(element => {
            oNo++;
            AddItemToTable(oNo, element.email, element.vehicle, element.bookedDate, element.address, element
                .endDate, element.driver);
        });
    }


    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
    import {
        getFirestore,
        addDoc,
        getDocs,
        onSnapshot,
        collection,
        setDoc,
        doc,
        query,
        where
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
    const db = getFirestore(app);

    var bookings = [];
    var book = [];

    async function getData() {


        const userFlightRef = query(collection(db, "bookings"));
        const userUidDoc = await getDocs(userFlightRef);
        userUidDoc.forEach(async userDoc => {
            if (userDoc.data().email != null) {
                bookings.push(userDoc.data());
                //console.log(userDoc.data());
            }
            const userFlightsQuery = query(collection(db, "bookings/" + userDoc.id + "/oldbookings"));
            const userFlights = await getDocs(userFlightsQuery);
            userFlights.forEach(flyer => {
                bookings.push(flyer.data());
                //console.log(flyer.data());
            });
            //console.log("vvv");
            AddAllItemsToTable(bookings);

        });
        //console.log("evsccwsc");

        //console.log("ev");

    }

    //}
    window.onload = getData();
    </script>

    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>