<?php
session_start();
require '../server/connection.php';

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$queryLogin = mysqli_query($conn, "SELECT admin_name FROM admins WHERE admin_email = '$usuario' AND admin_password = '$senha'");
if ($queryLogin->num_rows > 0) {
    $_SESSION['isLoggedIn'] = true;
    header('Location: dashboard.php');
} else {
    $_SESSION['isLoggedIn'] = false;
    header('Location: index.php?error=true');
}