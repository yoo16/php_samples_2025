<?php
$title = '日付操作（DateTime）';
$description = 'PHPで日付や時刻を扱う方法は、伝統的な関数ベースの書き方と、モダンなオブジェクト指向ベースの書き方の2種類があります。それぞれの特徴と、実用的なカレンダーの実装方法を解説します。';
$lesson_number = 9;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：日付操作 | PHP DateTime</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Prism.js for code highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: date() and Timestamp -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                <code>date()</code> 関数とタイムスタンプ
            </h3>
            <p class="mb-4">PHPで最も基本的な日付操作です。<strong>タイムスタンプ</strong>とは、1970年1月1日 00:00:00（UTC）からの経過秒数のことで、<code>time()</code> 関数で現在のタイムスタンプを取得できます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
date_default_timezone_set('Asia/Tokyo');

// 現在のタイムスタンプを取得
$now_time = time();

// x日後のタイムスタンプ（秒単位で計算）
$day = 7;
$next_time = $now_time + (24 * 60 * 60) * $day;

// date() でフォーマットして表示
$year          = date('Y');       // 4桁の年
$month         = date('m');       // 2桁の月（01〜12）
$days          = date('t');       // 今月の日数
$today_string  = date('Y/m/d H:i:s'); // 2026/03/02 15:30:00</code></pre>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">書式文字</th>
                            <th class="px-6 py-3 text-left">意味</th>
                            <th class="px-6 py-3 text-left">出力例</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 text-sm">
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">Y</td>
                            <td class="px-6 py-3">4桁の年</td>
                            <td class="px-6 py-3 font-mono">2026</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">m</td>
                            <td class="px-6 py-3">2桁の月（ゼロ埋め）</td>
                            <td class="px-6 py-3 font-mono">03</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">d</td>
                            <td class="px-6 py-3">2桁の日（ゼロ埋め）</td>
                            <td class="px-6 py-3 font-mono">02</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">H</td>
                            <td class="px-6 py-3">24時間表記の時（ゼロ埋め）</td>
                            <td class="px-6 py-3 font-mono">15</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">i</td>
                            <td class="px-6 py-3">分（ゼロ埋め）</td>
                            <td class="px-6 py-3 font-mono">30</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">s</td>
                            <td class="px-6 py-3">秒（ゼロ埋め）</td>
                            <td class="px-6 py-3 font-mono">00</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">t</td>
                            <td class="px-6 py-3">指定した月の日数</td>
                            <td class="px-6 py-3 font-mono">28</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">w</td>
                            <td class="px-6 py-3">曜日の数値（0:日 〜 6:土）</td>
                            <td class="px-6 py-3 font-mono">0</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">n</td>
                            <td class="px-6 py-3">月（ゼロ埋めなし）</td>
                            <td class="px-6 py-3 font-mono">3</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800 rounded-r-2xl">
                <strong>タイムゾーンの設定：</strong> PHPで日付を扱う前に <code>date_default_timezone_set('Asia/Tokyo');</code> でタイムゾーンを設定しないと、サーバーの設定によって時刻がずれることがあります。必ずスクリプトの先頭で呼び出しましょう。
            </div>
        </section>

        <!-- Section 2: strtotime() -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                <code>strtotime()</code> による相対指定
            </h3>
            <p class="mb-4">「1日後」「3ヶ月前」「次の日曜日」といった人間が理解しやすい<strong>英語表現</strong>をタイムスタンプに変換してくれる関数です。<code>date()</code> と組み合わせることで、相対的な日付を柔軟に計算できます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// 1日後のタイムスタンプ → 日付文字列に変換
$next_day_time = strtotime('+1 day');
$next_day      = date('Y/m/d', $next_day_time);

// 3ヶ月前
$prev_day_time = strtotime('-3 month');
$prev_day      = date('Y/m/d', $prev_day_time);

// 3時間後
$next_hour_time = strtotime('+3 hour');
$next_hour      = date('Y/m/d H:i:s', $next_hour_time);

// 次の日曜日
$next_week_time = strtotime('+1 sunday');
$next_week      = date('Y/m/d H:i:s', $next_week_time);</code></pre>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800 rounded-r-2xl">
                <strong>主な英語表現：</strong> <code>+1 day</code>（1日後）、<code>-3 month</code>（3ヶ月前）、<code>+3 hour</code>（3時間後）、<code>+1 sunday</code>（次の日曜日）、<code>first day of last month</code>（先月の初日）など、直感的な英語が使えます。
            </div>
        </section>

        <!-- Section 3: DateTime Class -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                DateTime クラス（モダンな手法）
            </h3>
            <p class="mb-4">モダンなPHP開発では、<code>DateTime</code> クラスを使うのが一般的です。<code>setDate()</code> や <code>modify()</code> などの<strong>メソッドチェーン</strong>で直感的に日付を操作でき、オブジェクト同士を比較演算子でそのまま比較できます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
date_default_timezone_set('Asia/Tokyo');

// インスタンス作成（引数なしで現在日時）
$date = new DateTime();

// 特定の日時をセット（メソッドチェーン）
$date->setDate(2022, 3, 10)->setTime(10, 30, 45);

// フォーマットして文字列化
$date_string = $date->format('Y-m-d H:i:s'); // 2022-03-10 10:30:45

// modify() で相対的に変更
$date2 = new DateTime();
$date2->setDate(2022, 3, 10)->setTime(10, 30, 45);
$date2->modify('+1 day');
$date_string2 = $date2->format('Y-m-d H:i:s'); // 2022-03-11 10:30:45

// 日付の比較（そのまま比較演算子が使える）
$is_match = ($date < $date2); // true（$date の方が前の日時）</code></pre>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">メソッド</th>
                            <th class="px-6 py-3 text-left">意味</th>
                            <th class="px-6 py-3 text-left">例</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 text-sm">
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-emerald-600">setDate(Y, m, d)</td>
                            <td class="px-6 py-3">年・月・日を設定する</td>
                            <td class="px-6 py-3 font-mono">setDate(2022, 3, 10)</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-emerald-600">setTime(H, i, s)</td>
                            <td class="px-6 py-3">時・分・秒を設定する</td>
                            <td class="px-6 py-3 font-mono">setTime(10, 30, 45)</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-emerald-600">modify(string)</td>
                            <td class="px-6 py-3">相対的な日時変更（strtotime 書式）</td>
                            <td class="px-6 py-3 font-mono">modify('+1 month')</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-emerald-600">format(string)</td>
                            <td class="px-6 py-3">フォーマット文字列に変換する</td>
                            <td class="px-6 py-3 font-mono">format('Y-m-d')</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-emerald-600">clone $date</td>
                            <td class="px-6 py-3">オブジェクトのコピーを作る</td>
                            <td class="px-6 py-3 font-mono">$copy = clone $date</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 text-sm text-emerald-800 rounded-r-2xl">
                <strong>clone に注意：</strong> PHPのオブジェクトは代入しても<strong>参照コピー</strong>になります。別の変数として独立させたい場合は <code>clone</code> キーワードを使います。<code>calendar.php</code> の前月・次月リンク生成でも <code>clone $today</code> が使われています。
            </div>
        </section>

        <!-- Section 4: Calendar Logic -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                応用：カレンダーの生成ロジック
            </h3>
            <p class="mb-4">カレンダーを作る際は、<strong>2次元配列</strong>に日付オブジェクトをマッピングしていく考え方が基本です。<code>calendar.php</code> では以下のロジックで実装しています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
date_default_timezone_set('Asia/Tokyo');

$today = new DateTime();
$year  = $today->format('Y');
$month = $today->format('n'); // ゼロ埋めなしの月

// クエリパラメータで月を切り替え可能に
if (isset($_GET['y'])) $year  = (int)$_GET['y'];
if (isset($_GET['m'])) $month = (int)$_GET['m'];

$today->setDate($year, $month, 1);
$end_day = (int)$today->format('t'); // 月の日数
$days    = range(1, $end_day);

// カレンダー配列の初期化（最大6行 × 7列、null で埋める）
$calendar = array_fill(0, 6, array_fill(0, 7, null));
$row = 0;

foreach ($days as $day) {
    $date        = new DateTime();
    $date->setDate($year, $month, $day);
    $week_number = (int)$date->format('w'); // 0:日 〜 6:土

    $calendar[$row][$week_number] = $date;

    // 土曜日（6）に達したら次の行へ
    if ($week_number === 6) {
        $row++;
    }
}</code></pre>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 mb-6">
                <h4 class="font-bold text-slate-800 mb-4">実装の手順</h4>
                <ol class="space-y-4 text-sm">
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">1</span>
                        <div>
                            <strong>月初と末日の特定：</strong><br>
                            <code>setDate($year, $month, 1)</code> で1日にセットし、<code>format('t')</code> でその月が何日まであるかを取得します。
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">2</span>
                        <div>
                            <strong>曜日ごとの列にセット：</strong><br>
                            <code>format('w')</code> で曜日の数値（0:日 〜 6:土）を取得し、<code>$calendar[$row][$week_number] = $date</code> に格納します。
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">3</span>
                        <div>
                            <strong>土曜日で行を切り替え：</strong><br>
                            <code>$week_number === 6</code>（土曜日）のタイミングで <code>$row++</code> して次の週（行）に進みます。
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="flex-none w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-500">4</span>
                        <div>
                            <strong>2次元配列を HTML に展開：</strong><br>
                            入れ子の <code>foreach</code> でループし、CSS Grid（<code>grid-template-columns: repeat(7, 1fr)</code>）で7列のカレンダーを描画します。
                        </div>
                    </li>
                </ol>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800 rounded-r-2xl">
                <strong>空行のスキップ：</strong> 最大6行で初期化していますが、月によっては5行で収まります。<code>array_filter($row_date)</code> で全セルが <code>null</code> の行をスキップすることで、余白のない綺麗なカレンダーになります。
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"日付操作をマスターすると、予約システムやスケジュール管理など、作れるアプリケーションの幅が一気に広がります。"</p>
        </footer>
    </main>

    <!-- Prism.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
</body>

</html>
