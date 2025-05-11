<?php
// サイトタイトル
const SITE_TITLE = "My Form";

// サイトベースURL
define('BASE_URL', dirname(rtrim(dirname($_SERVER['SCRIPT_NAME']), '/')));

// セッション開始
session_start();
session_regenerate_id(true);

// アプリケーションのルートディレクトリパス
const BASE_DIR = __DIR__;
const COMPONENT_DIR = __DIR__ . "/components/";