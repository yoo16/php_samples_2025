<?php
return [
    // ファイルパス関連
    'paths' => [
        'layout'   => __DIR__ . '/../templates/layout.php',
        'template' => __DIR__ . '/../templates/card.php',
        'css'      => __DIR__ . '/../css/pdf.css',
    ],
    'mpdf' => [
        'mode'          => 'ja-JP',
        'format'        => [91, 55], // 名刺サイズ
        'margin_left'   => 0,
        'margin_right'  => 0,
        'margin_top'    => 0,
        'margin_bottom' => 0,
    ],
    'default_filename' => 'business_card.pdf'
];
