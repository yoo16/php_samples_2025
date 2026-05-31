<?php
// ============================================================
// api.php - Gemini API バックエンド
// フロントから受け取った都市・スタイルを元に
// Gemini へリクエストし、観光スポットを JSON で返す
// ============================================================

require_once 'env.php';

// ---------- ① レスポンスヘッダー設定 ----------
header('Content-Type: application/json; charset=utf-8');

// ---------- ② POST パラメータ取得 ----------
$city  = trim($_POST['city']  ?? '');
$style = trim($_POST['style'] ?? '');

// 入力バリデーション
if ($city === '' || $style === '') {
    http_response_code(400);
    echo json_encode(['error' => '都市名と旅行スタイルを入力してください。']);
    exit;
}

// ---------- ③ Gemini へのプロンプト作成 ----------
$prompt = <<<PROMPT
あなたは旅行ガイドの専門家です。
以下の条件でおすすめの観光スポットを5件、日本語で提案してください。

都市: {$city}
旅行スタイル: {$style}

以下の JSON 形式のみで回答してください。説明文や```は不要です。
{
    "city": "都市名",
    "spots": [
        {
            "name": "スポット名",
            "category": "カテゴリ（例：寺院・公園・グルメ・美術館など）",
            "description": "おすすめの理由（80文字以内）",
        "address": "住所（Google Maps で検索できる形式）"
        }
    ]
}
PROMPT;

// ---------- ④ Gemini API リクエスト ----------
$endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/'
    . GEMINI_MODEL
    . ':generateContent?key='
    . GEMINI_API_KEY;

$requestBody = json_encode([
    'system_instruction' => [
        'parts' => [['text' => 'あなたは旅行ガイドの専門家です。必ず JSON のみで回答してください。']]
    ],
    'contents' => [
        [
            'role'  => 'user',
            'parts' => [['text' => $prompt]]
        ]
    ],
    'generationConfig' => [
        'maxOutputTokens' => 1024,
        'temperature'     => 0.7,
    ]
]);

// cURL でリクエスト送信
$ch = curl_init($endpoint);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $requestBody,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// ---------- ⑤ レスポンス処理 ----------
if ($httpCode !== 200) {
    http_response_code(502);
    echo json_encode(['error' => 'Gemini API エラー。時間をおいて再試行してください。']);
    exit;
}

$geminiData = json_decode($response, true);
$text = $geminiData['candidates'][0]['content']['parts'][0]['text'] ?? '';

// Gemini が返した JSON 文字列をパース
$spots = json_decode($text, true);

if (json_last_error() !== JSON_ERROR_NONE || !isset($spots['spots'])) {
    http_response_code(500);
    echo json_encode(['error' => 'レスポンスの解析に失敗しました。再試行してください。']);
    exit;
}

// フロントへ返却
echo json_encode($spots, JSON_UNESCAPED_UNICODE);
