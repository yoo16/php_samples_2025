<?php
$title = 'PHP基礎：日付操作（DateTime）';
$lesson_number = 8;
$description = 'PHPで日付や時刻を扱う方法は、伝統的な関数ベースの書き方と、モダンなオブジェクト指向ベースの書き方の2種類があります。それぞれの特徴と、実用的なカレンダーの実装方法を解説します。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：日付操作 | PHP DateTime</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include('../components/header.php'); ?>

        <!-- Section 1: date() and Timestamp -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                date() 関数とタイムスタンプ
            </h3>
            <p class="mb-4">PHPで最も基本的な日付操作です。<strong>タイムスタンプ</strong>（1970年1月1日からの経過秒数）を元に、指定したフォーマットの文字列を作成します。</p>

            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 現在のタイムスタンプを取得</span>
<span class="hl-var">$now</span> = <span class="hl-num">time()</span>; 

<span class="hl-comment">// フォーマットして表示 (2026/02/28 15:30:00 形式)</span>
echo <span class="hl-num">date</span>(<span class="hl-string">'Y/m/d H:i:s'</span>, <span class="hl-var">$now</span>);

<span class="hl-comment">// 主なフォーマット文字</span>
<span class="hl-comment">// Y: 4桁の年, m: 2桁の月, d: 2桁の日</span>
<span class="hl-comment">// H: 24時間表記の時, i: 分, s: 秒, t: 指定した月の日数</span></code></pre>
            </div>
            
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800">
                <strong>重要:</strong> PHPで日付を扱う前に <code>date_default_timezone_set('Asia/Tokyo');</code> でタイムゾーンを設定するのを忘れないようにしましょう。
            </div>
        </section>

        <!-- Section 2: strtotime() -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                strtotime() による相対指定
            </h3>
            <p class="mb-4">「明日の今頃」「3ヶ月前」といった人間が理解しやすい英語表現を、タイムスタンプに変換してくれる非常に強力な関数です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 明日のタイムスタンプ</span>
<span class="hl-var">$next_day</span> = <span class="hl-num">strtotime</span>(<span class="hl-string">'+1 day'</span>);

<span class="hl-comment">// 先月の初日</span>
<span class="hl-var">$last_month</span> = <span class="hl-num">strtotime</span>(<span class="hl-string">'first day of last month'</span>);

<span class="hl-comment">// 次の日曜日</span>
<span class="hl-var">$next_sun</span> = <span class="hl-num">strtotime</span>(<span class="hl-string">'+1 sunday'</span>);</code></pre>
            </div>
        </section>

        <!-- Section 3: DateTime Class -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                DateTime クラス (モダンな手法)
            </h3>
            <p class="mb-4">モダンなPHP開発では、<code>DateTime</code> オブジェクトを使用するのが一般的です。日付の加算・減算や比較が直感的に行え、不変（Immutable）な扱いも可能です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// インスタンス作成</span>
<span class="hl-var">$date</span> = <span class="hl-keyword">new</span> <span class="hl-num">DateTime()</span>;

<span class="hl-comment">// メソッドチェーンで操作</span>
<span class="hl-var">$date</span>-><span class="hl-num">modify</span>(<span class="hl-string">'+1 week'</span>)-><span class="hl-num">format</span>(<span class="hl-string">'Y-m-d'</span>);

<span class="hl-comment">// 日付の比較（そのまま不等号で比較可能）</span>
<span class="hl-keyword">if</span> (<span class="hl-var">$date1</span> <span class="hl-op">&lt;</span> <span class="hl-var">$date2</span>) {
    <span class="hl-comment">// $date1 の方が古い</span>
}</code></pre>
            </div>
        </section>

        <!-- Section 4: Calendar Logic -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                応用：カレンダーの生成ロジック
            </h3>
            <p class="mb-4">カレンダーを作る際は、<strong>「2次元配列」</strong>に日付オブジェクトをマッピングしていく考え方が基本です。</p>
            
            <div class="bg-white p-6 rounded-2xl border border-slate-200 mb-6">
                <h4 class="font-bold text-slate-800 mb-4">実装の手順</h4>
                <ol class="space-y-4 text-sm">
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">1</span>
                        <div>
                            <strong>月初と末日の特定:</strong><br>
                            <code>format('t')</code> でその月が何日まであるかを取得します。
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">2</span>
                        <div>
                            <strong>曜日の判定:</strong><br>
                            <code>format('w')</code> を使い、1日が何曜日（0:日 〜 6:土）から始まるかを確認します。
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">3</span>
                        <div>
                            <strong>配列への格納:</strong><br>
                            <code>$calendar[行][曜日] = $date;</code> のように格納し、土曜日（6）に達したら行をインクリメントします。
                        </div>
                    </li>
                </ol>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800">
                <strong>Tips:</strong> 表示する際は、この2次元配列を入れ子の <code>foreach</code> でループさせ、<code>&lt;table&gt;</code> や CSS Grid で出力します。
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"日付操作をマスターすると、予約システムやスケジュール管理など、作れるアプリケーションの幅が一気に広がります。"</p>
        </footer>
    </main>

</body>

</html>
