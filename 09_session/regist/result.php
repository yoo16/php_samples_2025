<?php
// セッション開始
session_start();
session_regenerate_id(true);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // POSTメソッドでない場合強制終了
    exit;
}

// セッションがあれば削除
if (isset($_SESSION['member'])) {
    unset($_SESSION['member']);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main class="m-auto w-50">
        <h2 class="p-2 text-center">会員登録完了</h2>
        <p>
            会員登録が完了しました。
        </p>
        <div class="d-flex mt-3">
            <a href="./input.php" class="btn btn-outline-primary w-50">戻る</a>
        </div>
    </main>
</body>

</html>