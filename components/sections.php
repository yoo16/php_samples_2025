<?php
// PHP Samples Project Index
// 各セクションとファイルの定義（データ化）
$sections = [
    [
        'id' => '04_hello',
        'label' => 'Hello World (基本)',
        'public' => true,
        'files' => [
            [
                'name' => 'demo.php',
                'label' => 'Hello World',
                'explanation' => '04_hello/explanation.php'
            ]
        ]
    ],
    [
        'id' => '05_variable',
        'label' => '変数とデータ型',
        'public' => true,
        'files' => [
            [
                'name' => 'player.php',
                'label' => '変数の基本',
                'explanation' => '05_variable/explanation.php'
            ],
            [
                'name' => 'superglobals.php',
                'label' => 'スーパーグローバル変数',
                'explanation' => '05_variable/explanation.php'
            ],
            [
                'name' => 'check.php',
                'label' => 'データ型チェック',
                'explanation' => '05_variable/explanation.php'
            ]
        ]
    ],
    [
        'id' => '06_calculate',
        'label' => '演算',
        'public' => true,
        'files' => [
            [
                'name' => 'order.php',
                'label' => '演算の基本',
                'explanation' => '06_calculate/explanation.php'
            ],
        ]
    ],
    [
        'id' => '07_includes',
        'label' => '外部ファイルの読み込み',
        'public' => true,
        'files' => [
            [
                'name' => 'index.php',
                'label' => 'ファイル分離の基本',
                'explanation' => '07_includes/explanation.php'
            ],
        ]
    ],
    [
        'id' => '08_condition',
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
        'id' => '09_loops',
        'label' => '繰り返し処理 (for/while)',
        'public' => true,
        'files' => [
            [
                'name' => 'bingo.php',
                'label' => 'ビンゴカード生成',
                'explanation' => '09_loops/explanation.php'
            ],
            [
                'name' => 'calculate_loan.php',
                'label' => 'ローン計算シミュレーター',
                'explanation' => '09_loops/explanation.php'
            ]
        ]
    ],
    [
        'id' => '10_array_object',
        'label' => '配列とオブジェクト',
        'public' => true,
        'files' => [
            [
                'name' => 'user/',
                'label' => 'ユーザープロフィール',
                'explanation' => '10_array_object/explanation.php'
            ]
        ]
    ],
    [
        'id' => '11_function',
        'label' => '関数とクロージャ',
        'public' => true,
        'files' => [
            [
                'name' => 'data_check.php',
                'label' => 'ビルトイン関数',
                'explanation' => '11_function/explanation.php'
            ],
            [
                'name' => 'order.php',
                'label' => 'ユーザ定義関数',
                'explanation' => '11_function/explanation.php'
            ],
        ]
    ],
    [
        'id' => '12_form_session',
        'label' => 'フォームとセッション',
        'public' => true,
        'files' => [
            [
                'name' => 'get_request.php',
                'label' => 'GETリクエスト',
                'explanation' => '12_form_session/explanation.php'
            ],
            [
                'name' => 'post_request.php',
                'label' => 'POSTリクエスト',
                'explanation' => '12_form_session/explanation.php'
            ],
        ]
    ],
    [
        'id' => '13_datetime',
        'label' => '日付',
        'public' => true,
        'files' => [
            [
                'name' => 'date.php',
                'label' => 'date()関数',
                'explanation' => '13_datetime/explanation.php'
            ],
            [
                'name' => 'datetime.php',
                'label' => 'DateTimeクラスの使い方',
                'explanation' => '13_datetime/explanation.php'
            ],
            [
                'name' => 'calendar.php',
                'label' => 'カレンダー表示',
                'explanation' => '13_datetime/explanation.php'
            ],
        ]
    ],
    [
        'id' => '14_class',
        'label' => 'オブジェクト指向とクラス',
        'public' => true,
        'files' => [
            [
                'name' => 'instance.php',
                'label' => 'OOPとクラス',
                'explanation' => '14_class/explanation.php'
            ],
            [
                'name' => 'card_list.php',
                'label' => 'カードリスト',
                'explanation' => '14_class/explanation.php'
            ],
        ]
    ],
    [
        'id' => '15_card_game',
        'label' => 'クラスの応用',
        'public' => true,
        'files' => [
            [
                'name' => 'card_list.php',
                'label' => 'ポリモーフィズム',
                'explanation' => '15_card_game/explanation.php'
            ],
        ]
    ],
    [
        'id' => '16_mysql',
        'label' => 'MySQL & PDO',
        'public' => true,
        'files' => [
            [
                'name' => 'create_database.php',
                'label' => 'DB作成',
                'explanation' => '16_mysql/explanation.php'
            ],
            [
                'name' => 'connect_test.php',
                'label' => 'DB接続テスト',
                'explanation' => '16_mysql/explanation.php'
            ],
            [
                'name' => 'connect_test_for_module.php',
                'label' => 'DB接続テスト（モジュール化）',
                'explanation' => '16_mysql/explanation.php'
            ],
        ]
    ],
    [
        'id' => '17_mysql_crud',
        'label' => 'CRUD操作',
        'public' => true,
        'files' => [
            [
                'name' => 'index.php',
                'label' => 'CRUD操作',
                'explanation' => '17_mysql_crud/explanation.php'
            ],
        ]
    ],
    [
        'id' => '18_register',
        'label' => 'ユーザー登録',
        'public' => true,
        'files' => [
            ['name' => 'regist/', 'label' => '登録画面'],
        ]
    ],
    [
        'id' => '19_signin',
        'label' => 'ユーザー認証',
        'public' => true,
        'files' => [
            ['name' => '/', 'label' => 'サインイン画面'],
        ]
    ],
    [
        'id' => '20_php_sns',
        'label' => 'PHP SNS',
        'public' => true,
        'files' => [
            [
                'name' => 'home/',
                'label' => 'SNSアプリ',
                'explanation' => 'explain.php?n=20_0'
            ],
        ]
    ],
];
