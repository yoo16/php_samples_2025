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
                'label' => '変数と演算の基本',
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
            [
                'name' => 'data_check.php',
                'label' => 'ビルトイン関数',
                'explanation' => '06_function/explanation.php'
            ],
            [
                'name' => 'order.php',
                'label' => 'ユーザ定義関数',
                'explanation' => '06_function/explanation.php'
            ],
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
