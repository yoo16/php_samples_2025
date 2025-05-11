<?php
require_once 'env.php';

class Gemini
{
    public $baseURL = 'https://generativelanguage.googleapis.com/v1beta/models/';
    public $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json",
            'ignore_errors' => true
        ]
    ];

    function chat(string $prompt, string $model = 'gemini-2.0-flash')
    {
        $url = "{$this->baseURL}{$model}:generateContent?key=" . API_KEY;

        // リクエストデータを作成
        $data = [
            'contents' => [
                [
                    'parts' => [['text' => $prompt]]
                ]
            ]
        ];

        // リクエストヘッダーを設定
        $this->options['http']['content'] = json_encode($data);

        // ストリームコンテキストを作成
        $context = stream_context_create($this->options);
        // GeminiAPIにリクエストを送信し、レスポンスを取得
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            return null;
        }

        // レスポンスをデコード
        $json = json_decode($response, true);
        // テキストデータを返す
        return $json['candidates'][0]['content']['parts'][0]['text'] ?? null;
    }

    function image($image_path, $model = "gemini-2.0-flash")
    {
        if (!file_exists($image_path)) {
            return ['error' => '画像ファイルが見つかりません'];
        }

        $url = "{$this->baseURL}{$model}:generateContent?key=" . API_KEY;

        // Base64エンコード
        $image_base64 = base64_encode(file_get_contents($image_path));

        // リクエストデータを作成
        $data = [
            'contents' => [[
                'parts' => [
                    ['text' => 'この写真はなんですか？'],
                    [
                        'inline_data' => [
                            'mime_type' => 'image/jpeg',
                            'data' => $image_base64
                        ]
                    ]
                ]
            ]]
        ];

        // リクエストヘッダーを設定
        $this->options['http']['content'] = json_encode($data);

        // ストリームコンテキストを作成
        $context = stream_context_create($this->options);
        // GeminiAPIにリクエストを送信し、レスポンスを取得
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            $results['error'] = 'APIリクエストに失敗';
        } else {
            $json = json_decode($response, true);
            if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                $results['text'] = nl2br(htmlspecialchars($json['candidates'][0]['content']['parts'][0]['text']));
            } else {
                $results['error'] = '画像解析失敗';
            }
        }
        return $results;
    }
}
