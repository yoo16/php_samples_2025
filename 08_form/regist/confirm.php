<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // POSTメソッドでない場合強制終了
    exit;
}
// POSTデータ取得
$posts = $_POST;
// var_dump($posts);

// データチェック
$errors = [];
if (empty($posts["name"])) {
    $errors[] = "氏名が未入力です。";
}
if (empty($posts["email"])) {
    $errors[] = "Emailが未入力です。";
}
if (empty($posts["password"])) {
    $errors[] = "パスワードが未入力です。";
}
// var_dump($errors);
// エラーの場合、入力画面にリダイレクト
if ($errors) {
    header("Location: input.php");
    exit;
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
        <h2 class="p-2 text-center">会員登録確認</h2>
        <form action="" method="post">
            <div class="form-group mt-3">
                <label class="form-label" for="">氏名</label>
                <p><?= $posts["name"] ?></p>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="">Email</label>
                <p><?= $posts["email"] ?></p>
            </div>

            <div class="d-flex mt-3">
                <button class="btn btn-primary w-50 me-1">登録</button>
                <a href="./input.php" class="btn btn-outline-primary w-50">戻る</a>
            </div>
        </form>
    </main>
</body>

</html>