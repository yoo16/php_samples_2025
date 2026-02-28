<?php
const SITE_TITLE = 'PHPカードバトル';

require_once 'models/CardGame.php';


session_start();
session_regenerate_id(true);
