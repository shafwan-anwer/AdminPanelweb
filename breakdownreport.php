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
    <title>Breakdown Reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-  Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.3/jspdf.plugin.autotable.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
    </link>
</head>

<body>
    <?
  include "./adminHeader.php";
  include "./sidebar.php";
  ?>

    <div>
        <h2 class="h2">Breakdown Report</h2>
    </div>

    <div class="row my-3 mx-5">
        <div class="col-sm-3  mx-5">
            <select class="custom-select" id="month">
                <option selected value="0">1 Year</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
        <div class="col-sm-3  mx-5">
            <button type="button" class="btn btn-secondary px-5" id="btn_download"><i
                    class="fa fa-download"></i></button>
        </div>
    </div>

    <table id="reportbreakdowntable">
        <thead>
            <th class="text-center">Ceilo Paradise Travels</th>
            <th class="text-center">Breakdown Report</th>
            <th class="text-center" id="m"></th>
        </thead>
        <thead>
            <th class="text-center">Breakdown ID</th>
            <th class="text-center">Customer</th>
            <th class="text-center">Address</th>
            <th class="text-center">Breakdown Date </th>
            <th class="text-center">Vehicle Number</th>
        </thead>
        <tbody id="tbody1">
        </tbody>
    </table>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#btn_download').click(function() {
            var pdf = new jsPDF('p', 'pt', 'A3');
            source = $('#reportbreakdowntable')[0];
            pdf.addHTML(source, function() {
                pdf.save('Breakdown-report.pdf');

            });
        });
    });

    var tbody = document.getElementById('tbody1');
    var slist = [];

    function AddItemToTable(email, address, breakdownDate, vehicle) {
        var assistNo = 0;
        let row = document.createElement('tr');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');


        slist.push([email, address, breakdownDate, vehicle]);
        td1.innerHTML = ++assistNo;
        td2.innerHTML = email;
        td3.innerHTML = address;
        td4.innerHTML = breakdownDate;
        td5.innerHTML = vehicle;


        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);

        tbody.appendChild(row);
    }

    function AddAllItemsToTable(Serviceassist) {

        var assistNo = 0;
        tbody.innerHTML = "";
        Serviceassist.forEach(element => {
            AddItemToTable(element.email, element.address, element.breakdownDate, element.vehicle);
        });
    }
    </script>
    <script type="module">
    var tbody = document.getElementById('tbody1');
    $(function() {
        $("#month").change(function() {
            GetAllDataRealtime();
        });
    });

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



    function GetAllDataRealtime() {
        var service = [];
        var vehicles = [];
        //get dropdown data and convert to date
        var select = document.getElementById('month');
        var text = select.options[select.selectedIndex].value;

        if (text != 0) {
            const dbRef = collection(db, "breakdowns");
            onSnapshot(dbRef, (querySnapshot) => {
                querySnapshot.forEach(doc => {

                    var parts = doc.data().breakdownDate.split("/");
                    var dt = new Date(parseInt(parts[2], 10), parseInt(parts[1], 10) - 1, parseInt(
                        parts[0], 10));
                    var mt = dt.getMonth() + 1;
                    var text1 = select.options[select.selectedIndex].text;
                    document.getElementById("m").innerHTML = text1;

                    if (mt == text) {
                        service.push(doc.data());
                    } else {
                        var text1 = select.options[select.selectedIndex].text;
                        document.getElementById("m").innerHTML = text1;
                        service = [];
                        AddAllItemsToTable(service);
                    }

                });
                AddAllItemsToTable(service);
            });

        } else {
            var text1 = select.options[select.selectedIndex].text;
            document.getElementById("m").innerHTML = text1;
            service = [];
            const dbRef = collection(db, "breakdowns");
            onSnapshot(dbRef, (querySnapshot) => {
                querySnapshot.forEach(doc => {
                    service.push(doc.data());
                });
                AddAllItemsToTable(service);
            });
        }
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