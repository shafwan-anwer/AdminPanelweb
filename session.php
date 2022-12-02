<?php
session_start();
$email = $_POST['email'];
$_SESSION["email"] = $email;
?>