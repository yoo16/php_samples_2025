<?php
$path = __DIR__ . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (is_file($path)) {
    return false;
}

echo "<h2>ファイル一覧</h2><ul>";
foreach (scandir(__DIR__) as $file) {
    if ($file === '.' || $file === '..') continue;
    echo "<li><a href='/$file'>$file</a></li>";
}
echo "</ul>";
