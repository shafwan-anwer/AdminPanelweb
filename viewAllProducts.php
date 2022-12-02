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
    <title>Show AllVehicles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-  Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    </link>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <style>
    img {
        margin-top: 30px;
        margin-left: 10px;
        width: 100px;
        height: 100px;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <?
    include "./adminHeader.php";
    include "./sidebar.php";
    ?>
    <div>
        <h2 class="h2">All Vehicles</h2>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="text-center">S.N.</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Model</th>
                    <th class="text-center">Vehicle number</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Category </th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Availability</th>
                    <th class="text-center">Owner</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="tbody2">
                <!--<td><button class="btn btn-primary" style="height:40px" >Edit</button></td>-->
                <!--<td><button class="btn btn-danger" style="height:40px" >Delete</button></td>-->
            </tbody>
        </table>
    </div>

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-secondary ml-5 my-2" style="height:40px" data-toggle="modal"
        data-target="#myModal">
        Add Vehicle
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Vehicle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype='multipart/form-data' method="POST" id="add-vehicle">
                        <div class="form-group">
                            <label for="name">Model</label>
                            <input type="text" class="form-control" id="m_model" name="Model" required>
                        </div>

                        <div class="form-group">
                            <label for="file">Choose Image:</label>
                            <input type="file" class="form-control-file" id="fileitem">
                        </div>
                        <div class="form-group">
                            <label for="name">Vehicle No:</label>
                            <input type="text" class="form-control" id="p_name" name="vehicleNo" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="p_price" name="Price" required>
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <!--<input type="text" class="form-control" id="category" name="category" required>-->
                            <select class="form-control" id="category">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Description:</label>
                            <input type="text" class="form-control" id="p_desc" name="description" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" id="upload" style="height:40px"
                                name="submit">Add Item</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px"
                        onclick="window.location.reload(true)">Close</button>
                </div>
            </div>

        </div>
    </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="Modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Vehicle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype='multipart/form-data' method="POST" id="del-vehicle">
                        <div class="form-group">
                            <label for="name">Model</label>
                            <h4 id="name"></h4>
                            <input type="text" class="form-control" id="m_model_edit" name="Model" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Vehicle No:</label>
                            <input type="text" class="form-control" id="p_name_edit" name="vehicleNo" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="p_price_edit" name="Price" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select class="form-control" id="category_edit">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Description:</label>
                            <input type="text" class="form-control" id="p_desc_edit" name="description" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="name">Available:</label>
                            <input type="text" class="form-control" id="p_availability_edit" name="vehicleNo" value=""
                                placeholder="true or false" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btn_del" class="btn btn-default" data-dismiss="modal"
                                style="height:40px">Delete</button>
                            <button type="submit" id="btn_edit" class="btn btn-default" data-dismiss="modal"
                                style="height:40px">Edit</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px"
                        onclick="window.location.reload(true)">Close</button>
                </div>
            </div>

        </div>
    </div>
    </div>





    <script type="text/javascript">
    var tbody = document.getElementById('tbody2');
    const form = document.getElementById('add-vehicle');
    const form1 = document.getElementById('del-vehicle');
    var Model = document.getElementById('m_model');
    var vno = document.getElementById('p_name');
    var price = document.getElementById('p_price');
    var category = document.getElementById('category');
    var owner = document.getElementById("owner");
    var description = document.getElementById('p_desc');
    var available = document.getElementById('p_availability_edit');
    var uploadImage = document.getElementById('uploadImage');
    var img = document.getElementById('photo');

    var vlist = [];
    var clist = [];

    function AddItemToTable(index, URL, model, vehicleName, price, category, description, isAvailable, owner) {
        let row = document.createElement('tr');
        let td0 = document.createElement('td');
        let img = document.createElement('img');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');
        let td6 = document.createElement('td');
        let td7 = document.createElement('td');
        let td8 = document.createElement('td');

        vlist.push([URL, model, vehicleName, price, category, description, isAvailable, owner]);
        td0.innerHTML = index+1;
        img.src = URL;
        td2.innerHTML = model;
        td3.innerHTML = vehicleName;
        td4.innerHTML = price;
        td5.innerHTML = category;
        td6.innerHTML = description;
        td7.innerHTML = isAvailable;
        td8.innerHTML = owner;


        row.appendChild(td0);
        row.appendChild(img);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        row.appendChild(td7);
        row.appendChild(td8);

        var ControlDiv = document.createElement("div");
        ControlDiv.innerHTML =
            '<button type="button" id="btn_delete" class="btn btn-danger ml-5 my-2 " style="height:40px" data-toggle="modal" data-target="#Modal" onclick="Fill(' +
            index + ')"><i class="fa fa-trash-o"></i></button>';
        ControlDiv.innerHTML +=
            '<button type="button" id="btn_delete" class="btn btn-secondary ml-5 my-2 " style="height:40px" data-toggle="modal" data-target="#Modal" onclick="Fill(' +
            index + ')"><i class="fa fa-wrench"></i></button>';
        row.appendChild(ControlDiv);
        tbody.appendChild(row);
    }

    var vNo = 0;

    function AddAllItemsToTable(vehicles) {
        vlist = []
        tbody.innerHTML = "";
        vehicles.forEach((element, index) => {
            AddItemToTable(index, element.URL, element.model, element.vehicleName, element.price, element.category,
                element.description, element.isAvailable, element.owner);
        });
    }

    var select = document.getElementById('category');
    var select1 = document.getElementById('category_edit');
    var select2 = document.getElementById('owner');

    function catselect(clist) {
        for (index in clist) {
            select.options[select.options.length] = new Option(clist[index], index);
        }
    }

    function catselectedit(clist) {
        for (index in clist) {
            select1.options[select1.options.length] = new Option(clist[index], index);
        }
    }

    function Fill(index) {
        
        if (index == null) {
            Model.value = "";
            vno.value = "";
            price.value = "";
            category.value = "";
            description.value = "";
            available.value = "";
        } else {
            Model.value = vlist[index][1];
            vno.value = vlist[index][2];
            price.value = vlist[index][3];
            category.value = vlist[index][4];
            description.value = vlist[index][5];
            available.value = vlist[index][6];

            document.getElementById("m_model_edit").value = Model.value;
            document.getElementById("p_name_edit").value = vno.value;
            document.getElementById("p_price_edit").value = price.value;
            document.getElementById("category_edit").value = category.value;
            document.getElementById("p_desc_edit").value = description.value;
            document.getElementById("p_availability_edit").value = available.value;

        }
    }
    </script>

    <script type="module">
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
        deleteDoc,
        updateDoc,
        where,
        query
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-firestore.js";
    import {
        getStorage,
        ref,
        uploadBytes,
        deleteObject,
        getDownloadURL
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-storage.js";

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
    const storage = getStorage(app);


    //Add Vehicle with custom id
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        //window.alert("Text: " + select.options[select.selectedIndex].text);
        //Image upload
        const file = document.getElementById('fileitem').files[0];
        const filename = document.getElementById('p_name').value;
        const storageRef = ref(storage, "images/" + filename);

        uploadBytes(storageRef, file).then((snapshot) => {
            getDownloadURL(storageRef)
                .then(() => {
                    //console.log(url);


                    const docRef = doc(db, "vehicles", vno.value);
                    const data = {
                        model: Model.value,
                        vehicleName: vno.value,
                        price: price.value,
                        category: select.options[select.selectedIndex].text,
                        description: description.value,
                        isAvailable: "true",
                        owner: "celiao"
                    };
                    setDoc(docRef, data).then(() => {
                        console.log("document has been added");
                        Swal.fire({
                            title: 'Vehicle succesfully Added',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        })
                    })
                })
            console.log("image uploaded");
        });
    })


    //Remove data
    var btdel = document.getElementById('btn_del');
    btdel.addEventListener('click', (e) => {
        //console.log(model);
        var vno = document.getElementById("p_name_edit").value;
        var availability = document.getElementById("p_availability_edit").value;
        console.log(availability)
        //var model = document.getElementById("m_model_edit").value;
        if (availability == "true") {
            e.preventDefault();
            const storageRef = ref(storage, "images/" + vno);
            deleteObject(storageRef).then(() => {
                // File deleted successfully
            }).catch((error) => {
                console.log("Oops - System error - code is " + error);
            });
            const docRef = doc(db, "vehicles", vno);
            deleteDoc(docRef)
                .then(() => {
                    console.log("Entire Document has been deleted successfully.");
                    Swal.fire({
                        title: 'Vehicle succesfully Deleted',
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
                    console.log(error);
                })

        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Cannot Delete Booked Vehicles',
                icon: 'error'
            })
        }


    })


    //update data
    var btedit = document.getElementById('btn_edit');
    btedit.addEventListener('click', (e) => {
        e.preventDefault();
        const file = document.getElementById('fileitem').files[0];
        // const filename = document.getElementById('p_name_edit').value;
        var model = document.getElementById("m_model_edit");
        var vno = document.getElementById("p_name_edit");
        var price = document.getElementById("p_price_edit");
        var category = document.getElementById("category_edit");
        var desc = document.getElementById("p_desc_edit");
        var available = document.getElementById("p_availability_edit");
        // console.log(model.value);
        //console.log("dfvdfv");
        // const storageRef = ref(storage,"images/"+filename);
        const docRef = doc(db, "vehicles", vno.value);
        const data = {
            model: model.value,
            vehicleName: vno.value,
            price: price.value,
            category: select1.options[select1.selectedIndex].text,
            description: desc.value,
            isAvailable: available.value
        };
        updateDoc(docRef, data)
            .then(docRef => {
                console.log("Value of an Existing Document Field has been updated");
                Swal.fire({
                    title: 'Vehicle details Updated',
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
                    text: 'Couldnt update details',
                    icon: 'error'
                })
                console.log(error);
            })
    })


    //getting data
    async function GetAllDataRealtime() {


        const dbReff = collection(db, "category");
        onSnapshot(dbReff, (querySnapshot1) => {
            querySnapshot1.forEach(doc => {
                clist.push(doc.id);
            });
            catselect(clist);
            catselectedit(clist);
        });

        const dbRef = collection(db, "vehicles");
        onSnapshot(dbRef, (querySnapshot) => {
            var vehicles = [];
            querySnapshot.forEach(doc => {
                getDownloadURL(ref(storage, 'images/'+doc.id))
                .then((url) => {
                    var a = doc.data()
                    a.URL = url
                    vehicles.push(a);                    
                    AddAllItemsToTable(vehicles);
                })
            });
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