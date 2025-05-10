<?php 
require_once '../app.php';

if ($_SESSION['auth_user']) {
    unset($_SESSION['auth_user']);
}
header('Location: ../login/input.php');
?>