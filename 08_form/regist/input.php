<?php 

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
                <input class="form-control" type="text" name="name">
                <label class="form-label" for="">氏名</label>
            </div>

            <div class="form-floating mt-3">
                <input class="form-control" type="email" name="email">
                <label class="form-label" for="">Email</label>
            </div>

            <div class="form-floating mt-3">
                <input class="form-control" type="password" name="password">
                <label class="form-label" for="">パスワード</label>
            </div>

            <div class="d-flex mt-3">
                <button class="btn btn-primary w-50 me-1">確認</button>
                <a href="../" class="btn btn-outline-primary w-50">戻る</a>
            </div>
        </form>
    </main>
</body>
</html>