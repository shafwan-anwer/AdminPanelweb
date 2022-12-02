<html>

<head>
    <title>
        Admin Login
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-  Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <style>
    h3 {
        font-size: 30px;
        text-align: center;
    }

    button {
        border-radius: 23px;
        display: block;
        margin: 0 auto;
        margin-top: 5px;
        width: 260px;
        height: 36px;
        border-radius: 30px;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
    }

    input {
        margin-left: 145px;
        border: none;
        outline: none;
        background: none;
        display: block;
        width: 50%;
        font-size: 16px;
        padding-bottom: 5px;
        border-bottom: 1px solid rgba(109, 93, 93, 0.4);
        text-align: center;
        font-family: 'Nunito', sans-serif;
    }

    #myModal {
        margin-top: 200px;
        margin-left: 400px;
        width: 400px;
    }

    #myModal button {
        width: 50%;
    }

    #myModal li {
        font-size: 12;
    }

    #m_otp {
        margin-left: 92px;
    }
    </style>
</head>

<body style="background: rgba(19,19,19,1.00);">
    <div class="cont">
        <div class="form sign-in">
            <form>
                <h3 class="font-weight-bold">ADMIN LOGIN</h3>
                <div class="text-center">
                    <label for="name" class="text-center text-secondary">EMAIL ADDRESS</label>
                    <input type="email" id="txtmail" name="email" class="text-secondary">
                </div>
                <div class="text-center">
                    <label for="password" class="text-center text-secondary">PASSWORD</label>
                    <input type="password" id="txtpassword" name="password" class="text-secondary">
                </div>
                <div class="text-center">
                    <button class="submit text-center " name="btnlogin" id="btn_login" type="button">Sign In</button>
                </div>
            </form>
        </div>

        <div class="sub-cont">
            <div class="img">
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">OTP</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="closeModal();">&times;</button>
                </div>
                <div class="modal-body">
                    <li>Check email for an OTP</li>
                    <form enctype='multipart/form-data' method="POST" id="otp">
                        <div class="form-group text-center">
                            <label for="name" class="text-center">Enter OTP</label>
                            <input type="text" id="m_otp" name="m_otp" class="text-center" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-secondary mt-3 text-center" id="otp_submit"
                                style="height:40px" name="submit">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>
    <script type="text/javascript">
    function openModal() {
        document.getElementById("backdrop").style.display = "block";
        document.getElementById("myModal").style.display = "block";
        document.getElementById("myModal").classList.add("show");
    }

    function closeModal() {
        document.getElementById("backdrop").style.display = "none";
        document.getElementById("myModal").style.display = "none";
        document.getElementById("myModal").classList.remove("show");
    }
    // Get the modal
    var modal = document.getElementById('myModal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
    </script>

    <script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
    import {
        getAuth,
        signInWithEmailAndPassword
    } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-auth.js";
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
    const auth = getAuth(app);

    btn_login.addEventListener('click', (e) => {

        var email = document.getElementById('txtmail').value;
        var password = document.getElementById('txtpassword').value;

        signInWithEmailAndPassword(auth, email, password)
            .then((userCredential) => {
                const user = userCredential.user;
                var otp = Math.floor(Math.random() * 999999) + 100000;
                //console.log(otp);

                jQuery.ajax({
                    type: "POST",
                    url: "mail_function.php",
                    dataType: "json",
                    data: {
                        email,
                        otp
                    },
                    success: function(result) {
                        console.log(result);
                    }
                })

                openModal();
                otp_submit.addEventListener('click', (e) => {
                    var otpvalue = document.getElementById("m_otp").value;
                    console.log(otpvalue);
                    if (otp == otpvalue) {
                        event.preventDefault();
                        jQuery.ajax({
                            type: "POST",
                            url: "session.php",
                            dataType: "json",
                            data: {
                                email
                            },
                            success: function(result) {
                                console.log(result);
                            }
                        })
                        window.location.href = "index.php";
                    } else {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid OTP!',
                            footer: 'To resend OTP. Submit again',
                        })
                    }
                })

            })
            .catch((error) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please check Username and Password!',
                })
            });
    });
    </script>
</body>

</html>