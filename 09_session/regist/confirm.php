<?php
// セッション開始
session_start();
session_regenerate_id(true);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // POSTメソッドでない場合強制終了
    exit;
}
// POSTデータ取得
// サニタイズ
$posts = check($_POST);

// セッション登録
$_SESSION['member'] = $_POST;

// バリデート
$errors = validate($posts);

// エラーをセッションに登録
$_SESSION['errors'] = $errors;
// var_dump($_SESSION['errors']);

// エラーの場合、入力画面にリダイレクト
if ($errors) {
    header("Location: input.php");
    exit;
}

function validate(array $posts)
{
    // データチェック
    $errors = [];

    $length = mb_strlen($posts['name']);
    if (empty($posts['name'])) {
        $errors['name'] = "氏名を入力してください。";
    } else if ($length > 20) {
        $errors['name'] = "氏名は20文字以内で入力してください。";
    }
    if (empty($posts['email'])) {
        $errors['email'] = "Emailを入力してください。";
    }
    $length = mb_strlen($posts['password']);
    if (empty($posts['password'])) {
        $errors['password'] = "パスワードを入力してください。";
    } else if ($length < 4 || $length > 15) {
        $errors['password'] = "パスワードは4文字以上15文字以内で入力してください。";
    }
    return $errors;
}

function check(array $posts)
{
    // データがなければ中断
    if (empty($posts)) return;
    // 繰り返しチェック
    foreach ($posts as $key => $value) {
        // トリム
        $value = trim($value);

        // 文字のエスケープ
        $posts[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $posts;
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
        <form action="result.php" method="post">
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