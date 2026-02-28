<?php
// PHP Samples Project Index
// 各セクションとファイルの定義（データ化）
$sections = [
    [
        'id' => '01_hello',
        'label' => 'Hello World (基本)',
        'files' => [
            [
                'name' => 'demo.php',
                'label' => 'Hello World',
                'explanation' => '01_hello/explanation.php'
            ]
        ]
    ],
    [
        'id' => '02_variable',
        'label' => '変数と演算',
        'files' => [
            [
                'name' => 'order.php',
                'label' => '注文確認',
                'explanation' => '02_variable/explanation.php'
            ],
            [
                'name' => 'superglobals.php',
                'label' => 'スーパーグローバル変数',
                'explanation' => '02_variable/explanation.php'
            ]
        ]
    ],
    [
        'id' => '03_condition',
        'label' => '条件分岐 (if/match)',
        'files' => [
            [
                'name' => 'menu.php',
                'label' => 'メニュー',
                'explanation' => '03_condition/explanation.php'
            ],
            [
                'name' => 'garbage.php',
                'label' => 'ゴミ出しカレンダー',
                'explanation' => '03_condition/explanation.php'
            ],
            [
                'name' => 'payment.php',
                'label' => 'お支払い判定',
                'explanation' => '03_condition/explanation.php'
            ]
        ]
    ],
    [
        'id' => '04_loops',
        'label' => '繰り返し処理 (for/while)',
        'files' => [
            [
                'name' => 'bingo.php',
                'label' => 'ビンゴカード生成',
                'explanation' => '04_loops/explanation.php'
            ],
            [
                'name' => 'calculate_loan.php',
                'label' => 'ローン計算シミュレーター',
                'explanation' => '04_loops/explanation.php'
            ]
        ]
    ],
    [
        'id' => '05_array_object',
        'label' => '配列とオブジェクト',
        'files' => [
            [
                'name' => 'user/',
                'label' => 'ユーザープロフィール',
                'explanation' => '05_array_object/explanation.php'
            ]
        ]
    ],
    [
        'id' => '06_function',
        'label' => '関数とクロージャ',
        'files' => [
            ['name' => 'closure.php', 'label' => 'クロージャの活用'],
            ['name' => 'data_check.php', 'label' => 'データバリデーション'],
            ['name' => 'function.php', 'label' => '関数の基本'],
            ['name' => 'search_item.php', 'label' => '商品検索処理'],
            ['name' => 'string_check.php', 'label' => '文字列チェック']
        ]
    ],
    [
        'id' => '07_calendar',
        'label' => '日付とカレンダー',
        'files' => [
            ['name' => 'calendar.php', 'label' => '万年カレンダー'],
            ['name' => 'datetime.php', 'label' => 'DateTimeクラスの使い方']
        ]
    ],
    [
        'id' => '08_form_session',
        'label' => 'フォームとセッション',
        'files' => [
            ['name' => 'counter.php', 'label' => 'アクセスカウンター'],
            ['name' => 'post_test.php', 'label' => 'POST送信テスト']
        ]
    ],
    [
        'id' => '09_class',
        'label' => 'オブジェクト指向 (クラス)',
        'files' => [
            ['name' => 'animal_play.php', 'label' => '継承の基本'],
            ['name' => 'calculate_item.php', 'label' => 'インターフェースの実装'],
            ['name' => 'game_play.php', 'label' => '抽象クラスの活用']
        ]
    ],
    [
        'id' => '10_signin',
        'label' => 'ユーザー認証',
        'files' => [
            ['name' => 'index.php', 'label' => 'サインイン画面'],
            ['name' => 'app.php', 'label' => '認証後のメインアプリ']
        ]
    ],
    [
        'id' => '22_gemini',
        'label' => 'Gemini AI 連携',
        'files' => [
            ['name' => 'chat.php', 'label' => 'AIチャットボット'],
            ['name' => 'translate.php', 'label' => 'AI多言語翻訳'],
            ['name' => 'whats_photo.php', 'label' => '画像解析（Vision）']
        ]
    ]
];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP サンプル ダッシュボード</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="antialiased min-h-screen bg-slate-50 text-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <header class="text-center mb-16">
            <div class="inline-block px-4 py-1.5 mb-4 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-widest">
                PHP 8.x 学習用サンプル
            </div>
            <h1 class="font-outfit text-5xl font-extrabold mb-4 tracking-tight text-slate-900">
                PHP Samples <span class="text-indigo-600">v2</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
                PHPの基本文法からモダンな開発手法を学ぶための実践的なコード集です。
            </p>
        </header>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($sections as $section): ?>
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 font-bold font-outfit text-lg">
                            <?= substr($section['id'], 0, 2) ?>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 leading-tight">
                                <?= $section['label'] ?>
                            </h2>
                            <p class="text-slate-400 text-xs uppercase tracking-widest mt-0.5">
                                <?= $section['id'] ?>
                            </p>
                        </div>
                    </div>

                    <ul class="space-y-3">
                        <?php if (empty($section['files'])): ?>
                            <li class="text-slate-300 text-sm italic">サンプルファイルが見つかりません。</li>
                        <?php else: ?>
                            <?php foreach ($section['files'] as $file): ?>
                                <li class="group/item">
                                    <div class="flex flex-col gap-1.5 p-3 rounded-xl bg-slate-50 hover:bg-indigo-50 border border-transparent hover:border-indigo-100 transition-all">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-bold text-slate-700 group-hover/item:text-indigo-700 truncate">
                                                <?= $file['label'] ?>
                                            </span>
                                            <a href="<?= $section['id'] . '/' . $file['name'] ?>"
                                                class="text-xs bg-white px-2 py-1 rounded shadow-sm border border-slate-200 text-slate-500 hover:text-indigo-600 hover:border-indigo-200 transition-colors font-semibold">
                                                デモ
                                            </a>
                                        </div>
                                        <div class="flex items-center justify-between mt-1">
                                            <span class="text-[10px] font-mono text-slate-400"><?= $file['name'] ?></span>
                                            <?php if (isset($file['explanation'])): ?>
                                                <a href="<?= $file['explanation'] ?>"
                                                    class="flex items-center gap-1 text-[10px] font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    解説ページ
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Footer -->
        <footer class="mt-20 pt-8 border-t border-slate-200 text-center">
            <p class="text-slate-400 text-sm font-medium">
                &copy; 2026 PHP Samples Learning Project. PHP & Tailwind CSS で構築。
            </p>
        </footer>
    </div>
</body>

</html>