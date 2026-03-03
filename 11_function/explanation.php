<?php
$title = '関数（Function）';
$description = '特定の処理をひとまとめにして名前をつけたものを「関数」と呼びます。PHPが最初から用意しているビルトイン関数と、自分で作るユーザー定義関数の両方を、注文処理（order.php）とデータチェック（data_check.php）の実例で学びましょう。';
$lesson_number = 7;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：関数 | PHP Functions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Prism.js for code highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: Built-in Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                PHPビルトイン関数（標準関数）
            </h3>
            <p class="mb-4">PHPには、データのチェックや文字列の加工など、便利な道具が最初からたくさん用意されています。<code>data_check.php</code> では、テスト用の文字列に対してこれらの関数を適用し、結果を <code>$results</code> 配列にまとめて表示しています。</p>

            <h4 class="font-bold text-slate-900 mb-3 mt-8">データ検証関数</h4>
            <pre class="language-php mb-6"><code class="language-php">&lt;?php
$testValue = $_GET['v'] ?? '  Hello, PHP Tokyo!  ';

// 1. 変数・データチェック関数
$results['check'] = [
    'isset'      => isset($testValue),       // 変数が存在し null でないか
    'empty'      => empty($testValue),       // 空とみなされるか（"" / 0 / null / [] など）
    'is_string'  => is_string($testValue),   // 文字列型か
    'is_numeric' => is_numeric($testValue),  // 数値または数値文字列か
    'is_null'    => is_null($testValue),     // null か
];</code></pre>

            <h4 class="font-bold text-slate-900 mb-3 mt-8">文字列操作関数</h4>
            <pre class="language-php mb-6"><code class="language-php">&lt;?php
$rawString    = $testValue;
$trimmedString = trim($rawString); // 前後の空白を除去

// 2. 文字列の長さ
$results['string'] = [
    'strlen'    => strlen($rawString),    // バイト数（日本語は1文字3バイト）
    'mb_strlen' => mb_strlen($rawString), // 文字数（マルチバイト対応）
    'trimmed'   => $trimmedString,
    'upper'     => strtoupper($trimmedString), // 大文字に変換
    'lower'     => strtolower($trimmedString), // 小文字に変換
];

// 3. 部分文字列の抽出
$results['substr'] = [
    'substr_5'   => substr($trimmedString, 0, 5),    // 先頭5バイト
    'mb_substr_2' => mb_substr($trimmedString, 0, 2), // 先頭2文字（マルチバイト対応）
];

// 4. 置換・検索
$results['replace'] = [
    'replace' => str_replace('PHP', '🐘', $trimmedString), // 文字列を置換
    'pos'     => mb_strpos($trimmedString, 'PHP'),          // 位置を検索（なければ false）
];</code></pre>

            <h4 class="font-bold text-slate-900 mb-3 mt-8">数値操作関数</h4>
            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// 5. 数値操作（入力が数値のときのみ意味を持つ）
$number = $results['check']['is_numeric'] ? $testValue : 0;

$results['number'] = [
    'format' => number_format($number), // 3桁カンマ区切り
    'ceil'   => ceil($number),          // 切り上げ
    'floor'  => floor($number),         // 切り捨て
    'round'  => round($number),         // 四捨五入
];</code></pre>

            <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 text-sm text-emerald-800 rounded-r-2xl">
                <strong>マルチバイト関数について：</strong> 日本語などの全角文字を扱う場合は、先頭に <code>mb_</code> がつく関数（マルチバイト関数）を使いましょう。<code>strlen()</code> はバイト数、<code>mb_strlen()</code> は文字数を返します。「東京」は <code>strlen</code> で 6、<code>mb_strlen</code> で 2 になります。
            </div>
        </section>

        <!-- Section 2: User Defined Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                ユーザー定義関数（自分で作る関数）
            </h3>
            <p class="mb-4"><code>function</code> キーワードを使って独自の関数を定義できます。<code>order.php</code> では注文処理に必要な計算をそれぞれ関数として切り出しています。モダンな PHP では引数と戻り値に<strong>型</strong>を指定することで、より安全なコードが書けます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// 定数（スコープをまたいでどこからでも参照できる）
const TAX_RATE   = 0.1;
const POINT_RATE = 0.05;

/**
 * ユーザーをIDで検索
 * ? をつけると「null を返す可能性がある」ことを示す（Null許容型）
 */
function findUser(int $id): ?array
{
    require_once "data/users.php";
    $ids   = array_column($users, "id");
    $index = array_search($id, $ids);
    return ($index !== false) ? $users[$index] : null;
}

/**
 * 商品をIDで検索
 */
function findProduct(int $id): ?array
{
    require_once "data/products.php";
    $ids   = array_column($products, "id");
    $index = array_search($id, $ids);
    return ($index !== false) ? $products[$index] : null;
}

/**
 * 合計金額の計算（単価 × 数量）
 * 引数に int、戻り値にも : int を指定して型を厳格にする
 */
function calculateSubtotal(int $price, int $quantity): int
{
    return $price * $quantity;
}

/**
 * ポイントの計算
 * デフォルト引数：$rate を省略すると POINT_RATE（0.05）が使われる
 */
function calculatePoint(int $amount, float $rate = POINT_RATE): int
{
    return (int)floor($amount * $rate);
}

// 呼び出し
$user    = findUser(1);        // ['id'=>1, 'display_name'=>'Chris Johnson', ...]
$product = findProduct(1);     // ['id'=>1, 'name'=>'クラフトコーラ', 'price'=>750, ...]

if ($user && $product) {
    $subtotal     = calculateSubtotal($product['price'], 3); // 750 × 3 = 2250
    $earnedPoints = calculatePoint($subtotal);               // floor(2250 × 0.05) = 112
}</code></pre>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">要素</th>
                            <th class="px-6 py-3 text-left">意味</th>
                            <th class="px-6 py-3 text-left">例</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 text-sm">
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">引数</td>
                            <td class="px-6 py-3">関数に渡す入力値。型を指定できる</td>
                            <td class="px-6 py-3 font-mono">int $price</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">デフォルト引数</td>
                            <td class="px-6 py-3">省略したときに使われる値</td>
                            <td class="px-6 py-3 font-mono">float $rate = POINT_RATE</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">戻り値の型</td>
                            <td class="px-6 py-3">関数が返す値の型</td>
                            <td class="px-6 py-3 font-mono">: int</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">Null許容型</td>
                            <td class="px-6 py-3">その型または null を許容する</td>
                            <td class="px-6 py-3 font-mono">: ?array</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800 rounded-r-2xl">
                <strong>DocBlock コメント：</strong> 関数の直前に <code>/** ... */</code> 形式で書くコメントを <strong>DocBlock</strong> といいます。引数・戻り値の説明を書いておくと、IDE が補完に活用してくれます。チームでの開発では書くことを習慣にしましょう。
            </div>
        </section>

        <!-- Section 3: Closures and Arrow Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                無名関数とアロー関数
            </h3>
            <p class="mb-4">名前をつけずに変数に代入する<strong>無名関数（クロージャ）</strong>と、1行で書けるシンプルな<strong>アロー関数</strong>（PHP 7.4+）も、モダンなPHPでは利用できます。<code>order.php</code> ではメッセージ生成と税抜き計算にそれぞれ使っています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
/**
 * メッセージの作成（無名関数 / クロージャ）
 * 変数に代入して使う。外部変数が必要なら use で取り込む。
 */
$formatGreeting = function (string $name): string {
    return "{$name}さん、この商品を購入しますか？";
};

// $user['display_name'] を渡して呼び出し
echo $formatGreeting($user['display_name']); // "Chris Johnsonさん、この商品を購入しますか？"

/**
 * 税抜き価格の計算（アロー関数）
 * fn キーワードで1行に書ける。外部の定数 TAX_RATE に use なしでアクセス可。
 */
$getExclTaxPrice = fn(int $inclTaxPrice): int => (int)ceil($inclTaxPrice / (1 + TAX_RATE));

echo $getExclTaxPrice($product['price']); // ceil(750 / 1.1) = 682（税抜き価格）

// array_filter() や array_map() との組み合わせが典型的な使い方
$expensive = array_filter($products, fn($p) => $p['price'] >= 700);
$names     = array_map(fn($p) => $p['name'], $products);</code></pre>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-purple-50 border border-purple-200 p-4 rounded-2xl text-sm">
                    <p class="font-bold text-purple-800 mb-1">無名関数 <code>function() {}</code></p>
                    <p class="text-purple-700">変数に入れて使う・他の関数に渡す（コールバック）。外部変数を使いたい場合は <code>use</code> が必要。</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-200 p-4 rounded-2xl text-sm">
                    <p class="font-bold text-indigo-800 mb-1">アロー関数 <code>fn() =&gt;</code></p>
                    <p class="text-indigo-700">1行の戻り値のみの処理に使う。外部変数に <code>use</code> なしでアクセスできる。PHP 7.4 以降。</p>
                </div>
            </div>
        </section>

        <!-- Section 4: Scope -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                変数のスコープ（有効範囲）
            </h3>
            <p class="mb-4">PHPでは、関数の<strong>外で定義した変数は関数の中では使えません</strong>。これを<strong>スコープ</strong>といいます。<code>order.php</code> の <code>findUser()</code> や <code>findProduct()</code> が関数内で <code>require_once</code> を呼び出しているのもこのためです。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
const TAX_RATE = 0.1; // 定数はどこからでもアクセス可能

$taxRate = 0.1; // グローバルスコープの変数

function calcTax(int $price): float
{
    // $taxRate はここでは使えない（関数スコープ）
    // → 引数で受け取るか、定数を使う
    return $price * TAX_RATE; // 定数は $ なしで直接参照できる
}

// 外部変数を関数内で使いたい場合：use で取り込む（無名関数のみ）
$calc = function(int $price) use ($taxRate): float {
    return $price * $taxRate; // use で取り込んだ変数は使える
};

echo calcTax(750);  // 75.0
echo $calc(750);    // 75.0</code></pre>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800 rounded-r-2xl">
                <strong>定数はスコープを超えられる：</strong> <code>const TAX_RATE = 0.1</code> のように定義した定数は、関数の中からでも <code>$</code> なしで直接参照できます。<code>order.php</code> の <code>TAX_RATE</code> と <code>POINT_RATE</code> がまさにこのパターンです。
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"共通の処理を関数にまとめることで、修正が一箇所で済み、ミスが減り、読みやすいコードになります。"</p>
        </footer>
    </main>

    <!-- Prism.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
</body>

</html>
