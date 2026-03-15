<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../app.php';

use App\Controllers\UserController;

$controller = new UserController();
$controller->follow();
