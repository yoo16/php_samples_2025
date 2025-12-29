<?php

namespace App;

use Mpdf\Mpdf;

class Generator
{
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function generate(array $data, ?string $fileName = null)
    {
        // 1. パーツの準備
        $css     = file_get_contents($this->config['paths']['css']);
        $content = $this->render($this->config['paths']['template'], $data);
        $html    = $this->render($this->config['paths']['layout'], ['content' => $content]);

        // 2. mPDFの初期化
        $mpdf = new Mpdf($this->config['mpdf']);

        // 3. 【重要】CSSとHTMLを分離して書き込む
        // 第1引数にCSS文字列、第2引数に「1」を指定すると、スタイルとして処理される
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html, 2); // 「2」は本文として処理

        if (ob_get_length()) ob_end_clean();
        $mpdf->Output($fileName ?? $this->config['default_filename'], 'D');
        exit;
    }

    private function render(string $path, array $vars): string
    {
        extract($vars);
        ob_start();
        include $path;
        return ob_get_clean() ?: '';
    }
}
