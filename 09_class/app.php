<?php
const SITE_TITLE = 'PHPカードバトル';
const VIEW_DIR = __DIR__ . '/views/';

require_once 'models/CardGame.php';
require_once 'controllers/Controller.php';
require_once 'controllers/GameController.php';
require_once 'helpers/UI.php';

session_start();
session_regenerate_id(true);
