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
    <title>View Categories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-  Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    </link>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>

    <?
    include "./adminHeader.php";
    include "./sidebar.php";
    ?>

    <div>
        <h2 class="h2">Category Items</h2>
    </div>
    <div>
        <table id="usertable">
            <thead>
                <th class="text-center">S.N.</th>
                <th class="text-center">Category </th>
                <th class="text-left pl-5">Controls</th>
            </thead>
            <tbody id="tbodyCategory">

            </tbody>
        </table>

        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-secondary ml-5 my-2" style="height:40px" data-toggle="modal"
            data-target="#myModal">
            Add Category
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Category Item</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form enctype='multipart/form-data' method="POST" id="add-cat">
                            <div class="form-group">
                                <label for="c_name">Category Name:</label>
                                <input type="text" class="form-control" name="c_name" id="c_name" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary" name="upload" style="height:40px">Add
                                    Category</button>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-default" data-dismiss="modal"
                            style="height:40px">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--deletemodal-->
    <div class="modal fade" id="delModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Category Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype='multipart/form-data' method="POST" id="del-cat">
                        <div class="form-group">
                            <label for="c_name">Category Name:</label>
                            <!--	<h4 id="name"></h4>-->
                            <input type="text" class="form-control" name="c_name" id="name">
                        </div>
                        <div class="form-group">
                            <button type="submit" id="btn_delete" class="btn btn-danger" name="upload"
                                style="height:40px">Delete Category</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal"
                        style="height:40px">Close</button>
                </div>
            </div>

        </div>
    </div>
    </div>


    <script type="text/javascript">
    const form = document.getElementById('add-cat');
    const form1 = document.getElementById('del-cat');
    var tbody = document.getElementById('tbodyCategory');
    var catname = document.getElementById('c_name');

    var catNo = 0;
    var catlist = [];

    function AddItemToTable(category) {
        let row = document.createElement('tr');
        let td0 = document.createElement('td');
        let td1 = document.createElement('td');
        ++catNo;
        catlist.push([category]);
        td0.innerHTML = catNo;
        td1.innerHTML = category;
        row.appendChild(td0);
        row.appendChild(td1);

        var ControlDiv = document.createElement("div");
        ControlDiv.innerHTML =
            '<button type="button" class="btn btn-secondary ml-5 my-2" style="height:40px" data-toggle="modal" data-target="#delModal" onclick="Fill(' +
            catNo + ');"> Delete Category</button>';
        row.appendChild(ControlDiv);
        tbody.appendChild(row);
    }

    function Fill(index) {
        // var catname = document.getElementById('c_name');
        var btdel = document.getElementById('btn_delete').value;
        if (index == null) {
            //console.log(catname);
        } else {
            --index;
            catname = catlist[index][0];
            document.getElementById("name").value = catname;
            //console.log(catname);
        }
    }


    function AddAllItemsToTable(category) {
        var catNo = 0;
        tbody.innerHTML = "";
        category.forEach(element => {
            AddItemToTable(element.category);
        });
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
        collection,
        setDoc,
        addDoc,
        deleteDoc
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

    const app = initializeApp(firebaseConfig);
    const db = getFirestore();

    //add with custom id

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const docRef = doc(db, "category", c_name.value)
        const data = {
            category: form.c_name.value
        };

        setDoc(docRef, data).then(() => {
                console.log("document has been added");
                Swal.fire({
                    title: 'Category succesfully Added',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                })
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Couldnt add Category',
                    icon: 'error'
                })
                console.log(error);
            })
    })




    //Remove data 
    form1.addEventListener('submit', (e) => {
        var name = document.getElementById('name').value;
        e.preventDefault();
        //console.log(name);
        const docRef = doc(db, "category", name);
        deleteDoc(docRef)
            .then(() => {
                console.log("Entire Document has been deleted successfully.")
                Swal.fire({
                    title: 'Category succesfully Deleted',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                })
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Couldnt delete Category',
                    icon: 'error'
                })
                console.log(error);
            })
    })


    async function GetAllDataRealtime() {
        const dbRef = collection(db, "category");
        onSnapshot(dbRef, (querySnapshot) => {
            var category = [];
            querySnapshot.forEach(doc => {
                category.push(doc.data());
                //console.log(doc.data());
            });
            AddAllItemsToTable(category);
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