// 現在のホストとプロトコルを取得
const HOST = `${window.location.protocol}//${window.location.host}`;

// 現在のパスからベースディレクトリを抽出（例: /myapp）
const BASE_PATH = window.location.pathname.split('/').slice(0, -1).join('/');

// TRANSLATION_URIを設定
const TRANSLATION_URI = `${HOST}${BASE_PATH}/api/ai/translate.php`;
// Custom
// const TRANSLATION_URI = `http://localhost/api/ai/translate.php`;
