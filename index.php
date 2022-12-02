<?php
session_start();
$count = 0;
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
} else {
    $count++;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    </link>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?
    include "./adminHeader.php";
    include "./sidebar.php";
    ?>

    <script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
    import {
        getFirestore,
        collection,
        onSnapshot,
        getDocs,
        query,
        where,
        doc,
        setDoc,
        updateDoc,
        deleteDoc
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-firestore.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
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

    var count = 0;
    const querySnapshot = await getDocs(collection(db, "users"));
    querySnapshot.forEach((doc) => {
        count++;
    });

    var vcount = 0;
    const querySnapshot1 = await getDocs(collection(db, "vehicles"));
    querySnapshot1.forEach((doc) => {
        // console.log(`${doc.id} => ${doc.data()}`);
        vcount++;
    });

    var ccount = 0;
    const querySnapshot2 = await getDocs(collection(db, "category"));
    querySnapshot2.forEach((doc) => {
        //console.log(`${doc.id} => ${doc.data()}`);
        ccount++;
    });

    var bcount = 0;
    const q = await getDocs(collection(db, "bookings"));
    q.forEach(async (docs) => {
        if (docs.data().email != null) {
            bcount++;
        }
        const qu = await getDocs(collection(db, "bookings", docs.id, "oldbookings"));
        qu.forEach(async (docs1) => {
            if (docs1.data().email != null) {
                bcount++;
            }
        });
        document.getElementById("bcount").innerHTML = bcount;
    });

    document.getElementById("count").innerHTML = count;
    document.getElementById("vcount").innerHTML = vcount;
    document.getElementById("ccount").innerHTML = ccount;









    //query for monthly bookings   
    var count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    const qq = await getDocs(collection(db, "bookings"));
    qq.forEach(async (docs) => {
        if (docs.data().email != null) {
            var parts = docs.data().bookedDate.split("/");
            var dt = new Date(parseInt(parts[2], 10), parseInt(parts[1], 10) - 1, parseInt(parts[0], 10));
            //incrementing the count of the month
            count[dt.getMonth()] += 1
        }
        const quu = await getDocs(collection(db, "bookings", docs.id, "oldbookings"));
        quu.forEach(async (docs1) => {
            if (docs1.data().email != null) {
                var parts = docs1.data().bookedDate.split("/");
                var dt = new Date(parseInt(parts[2], 10), parseInt(parts[1], 10) - 1, parseInt(
                    parts[0], 10));
                //incrementing the count of the month
                count[dt.getMonth()] += 1
            }
        });

        const labels = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D']
        const data = {
            labels: labels,
            datasets: [{
                label: 'My first dataset',
                backgroundColor: 'rgba(0,0,0,0.1)',
                scaleFontColor: '#FFFFFF',
                borderColor: 'rgb(255,99,132)',
                data: count
            }]
        }
        const config = {
            type: 'line',
            data: data,
            options: {}
        }
        var ctx = document.getElementById('myChart');
        new Chart(ctx, config);
    });



    //query for new users
    var count1 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    const dbRef1 = collection(db, "users");
    onSnapshot(dbRef1, (querySnapshot1) => {
        querySnapshot1.forEach(doc => {

            var parts1 = doc.data().registeredDate.split("/");

            var dt = new Date(parseInt(parts1[2], 10), parseInt(parts1[1], 10) - 1, parseInt(parts1[0],
                10));
            //console.log(dt);
            //incrementing the count of the month
            count1[dt.getMonth()] += 1;
            //console.log("user4");
        })

        //chart
        const labels1 = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D']
        const data1 = {
            labels: labels1,
            datasets: [{
                label: 'My first dataset',
                backgroundColor: 'rgba(0,0,0,0.1)',
                scaleFontColor: '#FFFFFF',
                borderColor: 'rgb(255,99,132)',
                data: count1
            }]
        }
        const config1 = {
            type: 'line',
            data: data1,
            options: {}
        }
        var ctx1 = document.getElementById('myChart2');
        new Chart(ctx1, config1);
    })


    //query for daily bookings


    var count2 = [0, 0, 0, 0, 0, 0, 0];

    const qqq = await getDocs(collection(db, "bookings"));
    qqq.forEach(async (docs) => {
        if (docs.data().email != null) {
            var parts2 = docs.data().bookedDate.split("/");
            var dt = new Date(parseInt(parts2[2], 10), parseInt(parts2[1], 10) - 1, parseInt(parts2[0],
                10));
            //incrementing the count of the month
            count2[dt.getDay()] += 1;
        }
        const qu = await getDocs(collection(db, "bookings", docs.id, "oldbookings"));
        qu.forEach(async (docs1) => {
            if (docs1.data().email != null) {
                var parts4 = docs1.data().bookedDate.split("/");
                var dtt = new Date(parseInt(parts4[2], 10), parseInt(parts4[1], 10) - 1,
                    parseInt(parts4[0], 10));
                //incrementing the count of the month
                count2[dtt.getDay()] += 1;
            }
        });


        //chart
        const labels2 = ['M', 'T', 'W', 'T', 'F', 'S', 'S']
        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'My first dataset',
                backgroundColor: 'rgba(0,0,0,0.1)',
                scaleFontColor: '#FFFFFF',
                borderColor: 'rgb(255,99,132)',
                data: count2
            }]
        }
        const config2 = {
            type: 'line',
            data: data2,
            options: {}
        }
        var ctx2 = document.getElementById('myChart1');
        new Chart(ctx2, config2);
    });



    //query for breakdowns
    var count3 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    const dbRef3 = collection(db, "breakdowns");
    onSnapshot(dbRef3, (querySnapshot3) => {
        querySnapshot3.forEach(doc => {
            // var parts = doc.data().registeredDate.split("/");
            var parts3 = doc.data().breakdownDate.split("/");
            var dt = new Date(parseInt(parts3[2], 10), parseInt(parts3[1], 10) - 1, parseInt(parts3[0],
                10));
            //incrementing the count of the month
            count3[dt.getMonth()] += 1;
        })

        //chart
        const labels3 = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D']
        const data3 = {
            labels: labels3,
            datasets: [{
                label: 'My first dataset',
                backgroundColor: 'rgba(0,0,0,0.1)',
                scaleFontColor: '#FFFFFF',
                borderColor: 'rgb(255,99,132)',
                data: count3
            }]
        }
        const config3 = {
            type: 'line',
            data: data3,
            options: {}
        }
        var ctx3 = document.getElementById('myChart3');
        new Chart(ctx3, config3);
    })
    </script>



    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-users  mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Users</h4>
                    <h5 id="count" style="color:white;" class="ml-3">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Categories</h4>
                    <h5 id="ccount" style="color:white;" class="ml-3">
                    </h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Vehicles</h4>
                    <h5 id="vcount" style="color:white;" class="ml-3">
                    </h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-list mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Bookings</h4>
                    <h5 id="bcount" style="color:white;" class="ml-3">

                    </h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports  -->

    <div id="main-content1" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div>
                        <canvas id="myChart1" width="500" height="600"></canvas>
                    </div>
                    <i class=" mb-2" style="font-size: 70px;"></i>
                    <h6 style="color:white;" class="ml-3 text-center">Daily Bookings</h6>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div>
                        <canvas id="myChart" width="500" height="600"></canvas>
                    </div>
                    <i class=" mb-2" style="font-size: 70px;"></i>
                    <h6 style="color:white;" class="ml-3 text-center">
                        Monthly Bookings
                    </h6>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div>
                        <canvas id="myChart2" width="500" height="600"></canvas>
                    </div>
                    <i class=" mb-2" style="font-size: 70px;"></i>
                    <h6 style="color:white;" class="ml-3 text-center">
                        New Users
                    </h6>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div>
                        <canvas id="myChart3" width="500" height="600"></canvas>
                    </div>
                    <i class=" mb-2" style="font-size: 70px;"></i>
                    <h6 style="color:white;" class="ml-3 text-center">
                        Breakdowns
                    </h6>
                </div>
            </div>
        </div>
    </div>


    <div class="text-center mt-5">
        Ceilao Paradise Travels2022© All Rights Reserved
    </div>


    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>