<?php
require_once "../app.php";

if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
}
header('Location: input.php');
