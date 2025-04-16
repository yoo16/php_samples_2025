<?php
$email = "";
$password = "";

// if (!empty($_GET)) {
//     $email = $_GET["email"];
//     $password = $_GET["password"];
// }
if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <h2>ログイン</h2>
    <form action="" method="post">
        <div>
            <label for="">Email</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="">パスワード</label>
            <input type="password" name="password">
        </div>
        <button>ログイン</button>
    </form>

    <h2>結果</h2>
    <h3>Email</h3>
    <p><?= $email ?></p>
    <h3>パスワード</h3>
    <p><?= $password ?></p>
</body>

</html>