## MVCとは

`MVC` は、`Web` アプリケーションの役割を分けて整理する考え方です。  
`Model`、`View`、`Controller` の 3 つに分けることで、コードの見通しがよくなります。

**画面表示、処理の流れ、データ操作を分けて考えられること**が `MVC` の大きな特徴です。

### MVCが必要な理由

小さなプログラムでは、1つの `PHP` ファイルの中に画面表示も `DB` 処理もまとめて書ける場合があります。  
しかし、機能が増えると、どこに何が書いてあるのか分かりにくくなります。

`MVC` を使うと、役割ごとにファイルを分けられます。  
そのため、修正しやすく、複数人でも開発しやすくなります。

### MVCの3つの役割

| 役割 | 内容 |
| ---- | ---- |
| Model | データの取得、登録、更新、削除を担当 |
| View | 画面の表示を担当 |
| Controller | リクエストを受け取り、Model と View をつなぐ役割を担当 |

> `MVC` は機能を3つに完全分離するというより、役割を意識して整理するための考え方として理解すると分かりやすいです。

## このプロジェクトでのMVC

このプロジェクトでは、`app/controllers`、`app/models`、`app/views` に役割が分かれています。  
実際のディレクトリ構成を見ると、`MVC` の形がはっきり分かります。

| ディレクトリ | 主な役割 | 例 |
| ---- | ---- | ---- |
| app/controllers | 処理の流れを制御 | HomeController.php |
| app/models | データを扱う処理 | Tweet.php |
| app/views | 画面表示 | home/index.view.php |
| home | 最初の受け口となるファイル | index.php |

### Controllerの例

`home/index.php` では、`HomeController` を呼び出しています。

```php
<?php
require_once '../app.php';

use App\Controllers\HomeController;

$controller = new HomeController();
$controller->index();
```

このファイルは、利用者からのアクセスを受け取り、どの `Controller` を動かすかを決める入口です。

次に、`HomeController` の `index` メソッドで、投稿一覧を取得して `View` に渡しています。

```php
public function index()
{
    $auth_user = AuthUser::get();
    $tweet = new Tweet();
    $tweets = $this->hydrateTweets($tweet->get(), (int) $auth_user['id']);

    Request::render('home/index', [
        'auth_user' => $auth_user,
        'tweets' => $tweets,
    ]);
}
```

このように `Controller` は、画面を直接作るのではなく、必要なデータを集めて `View` に渡します。

### Modelの例

`app/models/Tweet.php` には、投稿データを取得する処理があります。

```php
public function get($limit = 10, $offset = 0)
{
    return $this->fetchTweets('', [], $limit, $offset);
}
```

さらに内部では、`SQL` を使って `tweets` テーブルや `users` テーブルからデータを取得しています。

```php
$sql = "SELECT
        tweets.id,
        tweets.message,
        users.account_name,
        users.display_name
    FROM tweets
    JOIN users ON tweets.user_id = users.id";
```

`Model` の中心的な役割は、`DB` とやり取りすることです。  
画面の `HTML` を書くのではなく、必要なデータを返すことに集中します。

### Viewの例

`app/views/home/index.view.php` では、受け取った `$tweets` を使って画面を表示しています。

```php
<?php foreach ($tweets as $tweet) : ?>
    <?php include COMPONENT_DIR . 'tweet_item.php' ?>
<?php endforeach; ?>
```

`View` は、見た目や表示内容を担当する場所です。  
「どのデータを取るか」よりも、「受け取ったデータをどう見せるか」に注目します。

## MVCの処理の流れ

このプロジェクトで投稿一覧ページを表示する流れを整理すると、次のようになります。

| 順番 | 処理 |
| ---- | ---- |
| 1 | 利用者が home/index.php にアクセス |
| 2 | HomeController の index が呼ばれる |
| 3 | Controller が Tweet Model に投稿取得を依頼 |
| 4 | Model が DB からデータを取得 |
| 5 | Controller が取得結果を View に渡す |
| 6 | View が HTML を作って画面に表示 |

### 流れを文章で見る

まず利用者がページにアクセスします。  
すると入口となる `PHP` ファイルが `Controller` を呼び出します。

その後、`Controller` は必要なデータを `Model` から取得します。  
取得したデータを整理して、最後に `View` へ渡します。

`View` は受け取ったデータをもとに、一覧画面や詳細画面を表示します。

> `Controller` は司令塔、`Model` はデータ担当、`View` は画面担当と考えると理解しやすいです。

## MVCのメリット

`MVC` を使うと、コードの役割が分かれます。  
そのため、開発や修正のときに、どこを見ればよいか判断しやすくなります。

| メリット | 内容 |
| ---- | ---- |
| 見通しのよさ | 役割ごとにファイルが分かれる構成 |
| 修正しやすさ | 画面変更と DB 処理を分けて対応できる構成 |
| 再利用しやすさ | 同じ Model や View を別の処理でも使いやすい構成 |
| 分担しやすさ | 複数人で担当を分けやすい構成 |

### たとえばどこを直すか

たとえば「投稿一覧の見た目を変えたい」なら、主に `View` を確認します。  
「投稿の取得条件を変えたい」なら、主に `Model` を確認します。  
「どの画面を表示するかの流れを変えたい」なら、主に `Controller` を確認します。

このように、目的に応じて確認する場所を絞りやすい点が `MVC` の便利なところです。

## MVCを学ぶときの注意点

`MVC` を学び始めたときは、役割の境界があいまいになりやすいです。  
特に、`Controller` に多くの処理を書きすぎることがあります。

### よくある混同

| 場所 | 書くべき内容 | 書きすぎに注意する内容 |
| ---- | ---- | ---- |
| Model | DB 操作、データ取得、保存処理 | HTML の出力 |
| View | 画面表示、レイアウト、表示用の繰り返し | 複雑な DB 処理 |
| Controller | リクエスト受付、Model 呼び出し、View への受け渡し | 何でもまとめた長い処理 |

### 学習のポイント

最初は「このコードは、データ担当か、画面担当か、進行担当か」を考えるのがおすすめです。  
その意識を持つだけでも、`MVC` の整理の仕方が見えてきます。

## このプロジェクトでMVCを見るときの着目点

このプロジェクトを読むときは、次の順番で追うと理解しやすいです。

| 着目点 | 見るファイル | 確認内容 |
| ---- | ---- | ---- |
| 入口 | home/index.php | どの Controller を呼んでいるか |
| 制御 | app/controllers/HomeController.php | どの Model と View を使うか |
| データ | app/models/Tweet.php | どの SQL でデータ取得するか |
| 表示 | app/views/home/index.view.php | 受け取ったデータをどう表示するか |

この順番で読むと、`MVC` のつながりを追いやすくなります。  
いきなりすべてのファイルを読むより、1つの画面にしぼって流れを追う方が理解しやすいです。

## まとめ

| 項目 | 内容 |
| ---- | ---- |
| MVC | Model、View、Controller に役割を分ける考え方 |
| Model | DB とのやり取りやデータ操作を担当 |
| View | 画面表示を担当 |
| Controller | リクエストを受け取り、Model と View をつなぐ役割 |
| このプロジェクトでの例 | home/index.php から HomeController、Tweet、index.view.php へつながる構成 |
| 学習のコツ | 1画面ごとに入口、制御、データ、表示の順で追うこと |
