<?php
session_start();
session_regenerate_id(true);

// セッションがあれば復元
if (isset($_SESSION['member'])) {
    $member = $_SESSION['member'];
    // var_dump($member);
}
// エラーがあれば取得
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    // var_dump($errors);
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
        <h2 class="p-2 text-center">会員登録</h2>
        <form action="confirm.php" method="post">
            <div class="form-floating mt-3">
                <input class="form-control" type="text" name="name" value="<?= @$member['name'] ?>">
                <label class="form-label" for="">氏名</label>
                <p class="text-danger"><?= @$errors["name"] ?></p>
            </div>

            <div class="form-floating mt-3">
                <input class="form-control" type="email" name="email" value="<?= @$member['email'] ?>">
                <label class="form-label" for="">Email</label>
                <p class="text-danger"><?= @$errors["email"] ?></p>
            </div>

            <div class="form-floating mt-3">
                <input class="form-control" type="password" name="password">
                <label class="form-label" for="">パスワード</label>
                <p class="text-danger"><?= @$errors["password"] ?></p>
            </div>

            <div class="d-flex mt-3">
                <button class="btn btn-primary w-50 me-1">確認</button>
                <a href="../" class="btn btn-outline-primary w-50">戻る</a>
            </div>
        </form>
    </main>
</body>

</html>