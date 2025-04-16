<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="">
        <div>
            <label for="">Email</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="">パスワード</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="">性別</label>
            <input type="radio" name="gender" value="male">
            <label for="">男</label>
            <input type="radio" name="gender" value="female">
            <label for="">女</label>
        </div>
        <div>
            <label for="">質問</label>
            <input type="checkbox" name="questions[]" value="a1">
            <label for="">回答1</label>
            <input type="checkbox" name="questions[]" value="a2">
            <label for="">回答2</label>
            <input type="checkbox" name="questions[]" value="a3">
            <label for="">回答3</label>
        </div>
        <div>
            <label for="">ファイルアップロード</label>
            <input type="file" name="file">
        </div>
        <div>
            <select name="year">
                <option value="2000">2000年</option>
                <option value="2001">2001年</option>
                <option value="2002">2002年</option>
            </select>
        </div>
        <div>
            <textarea name="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="更新">
            <button>更新</button>
        </div>
    </form>
</body>

</html>