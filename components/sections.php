<?php
// PHP Samples Project Index
// 各セクションとファイルの定義（データ化）
$sections = [
    [
        'id' => '01_hello',
        'label' => 'Hello World (基本)',
        'public' => true,
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
        'public' => true,
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
        'public' => true,
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
        'public' => true,
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
        'public' => true,
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
        'public' => true,
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
        'id' => '07_form_session',
        'label' => 'フォームとセッション',
        'public' => true,
        'files' => [
            [
                'name' => 'get_request.php',
                'label' => 'GETリクエスト',
                'explanation' => '07_form_session/explanation.php'
            ],
            [
                'name' => 'post_request.php',
                'label' => 'POSTリクエスト',
                'explanation' => '07_form_session/explanation.php'
            ],
        ]
    ],
    [
        'id' => '08_datetime',
        'label' => '日付',
        'public' => true,
        'files' => [
            [
                'name' => 'date.php',
                'label' => 'date()関数',
                'explanation' => '08_datetime/explanation.php'
            ],
            [
                'name' => 'datetime.php',
                'label' => 'DateTimeクラスの使い方',
                'explanation' => '08_datetime/explanation.php'
            ],
            [
                'name' => 'calendar.php',
                'label' => 'カレンダー表示',
                'explanation' => '08_datetime/explanation.php'
            ],
        ]
    ],
    [
        'id' => '09_class',
        'label' => 'オブジェクト指向 (クラス)',
        'public' => true,
        'files' => [
            ['name' => 'index.php', 'label' => 'カードバトル（OOP応用）', 'explanation' => '09_class/explanation.php']
        ]
    ],
    [
        'id' => '10_mysql',
        'label' => 'MySQL & PDO',
        'public' => true,
        'files' => [
            ['name' => 'index.php', 'label' => 'MySQL サンプルメニュー', 'explanation' => '10_mysql/explanation.php'],
            ['name' => 'select_users.php', 'label' => 'ユーザ一覧取得', 'explanation' => '10_mysql/explanation.php'],
            ['name' => 'insert_user.php', 'label' => '新規ユーザ登録', 'explanation' => '10_mysql/explanation.php'],
            ['name' => 'find_user.php', 'label' => 'ユーザ詳細検索', 'explanation' => '10_mysql/explanation.php']
        ]
    ],
    [
        'id' => '11_signin',
        'label' => 'ユーザー認証',
        'public' => true,
        'files' => [
            ['name' => 'index.php', 'label' => 'サインイン画面'],
            ['name' => 'app.php', 'label' => '認証後のメインアプリ']
        ]
    ],
    [
        'id' => '22_gemini',
        'label' => 'Gemini AI 連携',
        'public' => false,
        'files' => [
            ['name' => 'chat.php', 'label' => 'AIチャットボット'],
            ['name' => 'translate.php', 'label' => 'AI多言語翻訳'],
            ['name' => 'whats_photo.php', 'label' => '画像解析（Vision）']
        ]
    ]
];
