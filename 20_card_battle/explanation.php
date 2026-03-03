<?php
$title = 'オブジェクト指向（クラス）';
$lesson_number = 10;
$description = 'クラス、継承、インターフェース、多態性（ポリモーフィズム）といった OOP の核心概念を、カードバトルゲームの設計を通じて学びます。責務の分離（MVC）や CSRF 対策のカプセル化など、実務で必須となる考え方も解説します。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：オブジェクト指向 | PHP Classes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Prism.js for code highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: Class and Instance -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                クラスとインスタンス
            </h3>
            <p class="mb-4"><strong>クラス</strong>はオブジェクトの設計図です。クラスには<strong>プロパティ</strong>（データ）と<strong>メソッド</strong>（処理）を定義します。<code>new</code> キーワードでクラスから実体（<strong>インスタンス</strong>）を作り、<code>-></code> 演算子でプロパティやメソッドにアクセスします。</p>
            <p class="mb-4"><code>__construct()</code> は <strong>コンストラクタ</strong>と呼ばれる特別なメソッドで、<code>new</code> でインスタンスを作成した直後に自動的に呼ばれます。<code>BaseCard</code> では引数で受け取った値を各プロパティに設定しています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// コンストラクタで全プロパティを初期化する抽象クラス
abstract class BaseCard implements CardInterface
{
    public int    $level  = 1;
    public string $name   = '';
    public int    $attack = 0;
    public int    $defense = 0;
    public int    $hp     = 0;
    public int    $maxHp  = 0;
    // ... その他のプロパティ

    public function __construct(
        string $name,
        int    $attack,
        int    $defense,
        int    $hp,
        int    $mp,
        string $element,
        string $image,
        string $specialSkill,
        int    $specialSkillPower
    ) {
        $this->name    = $name;
        $this->attack  = $attack;
        $this->defense = $defense;
        $this->hp      = $hp;
        $this->maxHp   = $hp; // 最大HPは初期HP
        // ...
    }
}

// インスタンスの作成と使用
$card = new KnightCard();
echo $card->name;    // 炎の騎士
echo $card->attack;  // 25</code></pre>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">用語</th>
                            <th class="px-6 py-3 text-left">意味</th>
                            <th class="px-6 py-3 text-left">例</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">class</td>
                            <td class="px-6 py-3">オブジェクトの設計図</td>
                            <td class="px-6 py-3 font-mono">class KnightCard {}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">new</td>
                            <td class="px-6 py-3">クラスからインスタンスを生成する</td>
                            <td class="px-6 py-3 font-mono">new KnightCard()</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">__construct()</td>
                            <td class="px-6 py-3">インスタンス生成時に自動実行されるメソッド</td>
                            <td class="px-6 py-3 font-mono">public function __construct(...)</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">$this</td>
                            <td class="px-6 py-3">クラス内から自分自身のインスタンスを指す</td>
                            <td class="px-6 py-3 font-mono">$this->name</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-indigo-600">-></td>
                            <td class="px-6 py-3">インスタンスのプロパティ・メソッドへアクセス</td>
                            <td class="px-6 py-3 font-mono">$card->attack()</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 2: Access Modifiers and Encapsulation -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                アクセス修飾子とカプセル化
            </h3>
            <p class="mb-4">プロパティやメソッドには<strong>アクセス修飾子</strong>を付けてアクセス範囲を制限できます。外部から変更されたくないデータを <code>private</code> にして隠すことを<strong>カプセル化</strong>といいます。</p>
            <p class="mb-4"><code>CardGame</code> クラスではゲームの状態（<code>$player</code>・<code>$enemy</code>・<code>$logs</code>）をすべて <code>private</code> で隠し、外部からはメソッド経由でのみ操作できるようにしています。CSRF トークンのロジックも内部に閉じ込め、利用側は仕組みを知らなくても安全に使えます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
class CardGame implements CardGameInterface
{
    private ?BaseCard $player   = null; // 外部から直接変更不可
    private ?BaseCard $enemy    = null;
    private array     $logs     = [];
    private bool      $gameOver = false;

    // 外部からはメソッド経由でのみ取得できる
    public function getPlayer(): ?BaseCard { return $this->player; }
    public function getLogs(): array       { return $this->logs; }

    /**
     * CSRFトークンの生成（内部実装を隠蔽）
     */
    public function getCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * CSRFトークンの検証（内部実装を隠蔽）
     */
    public function validateCsrfToken(?string $token): bool
    {
        return !empty($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }
}

// 利用側（GameController）はトークンの仕組みを知らなくてよい
$game  = new CardGame();
$token = $game->getCsrfToken();                       // 生成
$valid = $game->validateCsrfToken($_POST['csrf_token'] ?? null); // 検証</code></pre>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">修飾子</th>
                            <th class="px-6 py-3 text-left">アクセス範囲</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-emerald-600">public</td>
                            <td class="px-6 py-3">どこからでもアクセス可能</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-amber-600">protected</td>
                            <td class="px-6 py-3">そのクラスと子クラスからのみアクセス可能</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold text-rose-600">private</td>
                            <td class="px-6 py-3">そのクラスの内部からのみアクセス可能</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 3: Inheritance and Abstract Class -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                継承と抽象クラス
            </h3>
            <p class="mb-4"><strong>継承</strong>は、既存クラスの機能を引き継いで新しいクラスを作る仕組みです。<code>extends</code> キーワードを使い、共通の処理を<strong>親クラス（スーパークラス）</strong>にまとめることでコードの重複を避けられます。</p>
            <p class="mb-4"><code>abstract</code> をつけたクラスは<strong>抽象クラス</strong>と呼ばれ、直接 <code>new</code> できません。<code>KnightCard</code>・<code>AquaCard</code> など全カードの共通処理（攻撃計算・レベルアップなど）を <code>BaseCard</code> に集約し、各カードのコンストラクタでパラメータだけを渡すシンプルな設計になっています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// 親クラス（抽象クラス）：共通処理をまとめる
abstract class BaseCard implements CardInterface
{
    // 攻撃の計算ロジックはすべての子クラスで共通
    public function attack(BaseCard $target): int
    {
        $baseDmg = ($this->attack * 1.5) - $target->defense;
        $random  = rand(-5, 5);
        $dmg     = (int)($baseDmg + $random);

        $minDmg = (int)($this->attack * 0.2); // 最低ダメージ保証
        if ($dmg < $minDmg) $dmg = $minDmg;

        $target->hp -= $dmg;
        if ($target->hp < 0) $target->hp = 0;
        return $dmg;
    }
    // levelUp() や gainExp() なども共通で定義
}

// 子クラス：コンストラクタでパラメータを親に渡すだけ
class KnightCard extends BaseCard
{
    public function __construct()
    {
        parent::__construct(    // 親のコンストラクタを呼ぶ
            '炎の騎士',         // name
            25,                 // attack
            15,                 // defense
            100,                // hp
            2,                  // mp
            '火',               // element
            'KnightCard.png',   // image
            'ブレイズソード',    // specialSkill
            45                  // specialSkillPower
        );
    }
}

class AquaCard extends BaseCard
{
    public function __construct()
    {
        parent::__construct('水の精霊', 18, 25, 100, 3, '水', 'AquaCard.png', 'ハイドロポンプ', 35);
    }
}</code></pre>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800 rounded-r-2xl">
                <strong>parent::__construct() の役割：</strong> 子クラスのコンストラクタ内で <code>parent::__construct()</code> を呼ぶことで、親クラスの初期化処理を実行できます。<code>::</code>（ダブルコロン）はインスタンスを作らずにクラスのメソッドを呼ぶための演算子です。
            </div>
        </section>

        <!-- Section 4: Interface -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                インターフェース
            </h3>
            <p class="mb-4"><strong>インターフェース</strong>は「このクラスは必ずこのメソッドを持つ」という<strong>契約（仕様）</strong>を定義します。<code>implements</code> を使ったクラスは、インターフェースで宣言されたすべてのメソッドを実装しなければなりません。</p>
            <p class="mb-4">このプロジェクトでは <code>CardInterface</code>（カードが持つべき操作）と <code>CardGameInterface</code>（ゲームが持つべき操作）の2つを定義し、実装の詳細とは切り離された設計になっています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// カードが持つべきメソッドを定義（実装は書かない）
interface CardInterface
{
    public function attack(BaseCard $target): int;
    public function specialSkill(BaseCard $target): int;
    public function gainExp(int $exp): void;
    public function isLevelUp(): bool;
    public function levelUp(): void;
}

// ゲームが持つべきメソッドを定義
interface CardGameInterface
{
    public function init(string $cardId): void;
    public function processAction(string $action): void;
    public function getPlayer(): ?BaseCard;
    public function getEnemy(): ?BaseCard;
    public function getLogs(): array;
    public function isGameOver(): bool;
}

// BaseCard は CardInterface を「実装する」
abstract class BaseCard implements CardInterface { /* ... */ }

// CardGame は CardGameInterface を「実装する」
class CardGame implements CardGameInterface { /* ... */ }</code></pre>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-purple-50 border border-purple-200 p-4 rounded-2xl text-sm">
                    <p class="font-bold text-purple-800 mb-1">抽象クラス <code>abstract class</code></p>
                    <p class="text-purple-700">共通の処理（実装）を持てる。<code>extends</code> で継承。単一継承のみ。</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-200 p-4 rounded-2xl text-sm">
                    <p class="font-bold text-indigo-800 mb-1">インターフェース <code>interface</code></p>
                    <p class="text-indigo-700">メソッドの宣言のみ。実装は持たない。<code>implements</code> で適用。複数適用可能。</p>
                </div>
            </div>
        </section>

        <!-- Section 5: Polymorphism -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-rose-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">5</span>
                ポリモーフィズム（多態性）
            </h3>
            <p class="mb-4"><strong>ポリモーフィズム</strong>とは、同じメソッド名でも、インスタンスの実際のクラスによって振る舞いが変わる性質です。<code>CardGame</code> は <code>$player</code> が <code>KnightCard</code> でも <code>AquaCard</code> でも、<code>attack()</code> や <code>specialSkill()</code> を同じ呼び方で実行できます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// $player は KnightCard かもしれないし AquaCard かもしれない
// でも、どちらも BaseCard（CardInterface）を実装しているので
// 同じメソッド名で呼べる

private function executePlayerTurn(string $action): void
{
    if ($action === 'attack') {
        // attack() は BaseCard に共通実装がある
        $dmg = $this->player->attack($this->enemy);
        $this->addLog("{$this->player->name} の攻撃！\n敵に {$dmg} のダメージ！");

    } elseif ($action === 'skill') {
        if ($this->player->mp > 0) {
            // specialSkill() も同様にどのカードでも呼べる
            $dmg = $this->player->specialSkill($this->enemy);
            $this->addLog("スキル発動！『{$this->player->specialSkill}』！\n敵に {$dmg} のダメージ！");
        }
    }
}

// 静的マップを使ったインスタンス生成（文字列からクラスを動的に解決）
private static array $cardMap = [
    'knight'  => KnightCard::class,
    'aqua'    => AquaCard::class,
    'forest'  => ForestCard::class,
    'thunder' => ThunderCard::class,
];

public function init(string $cardId = 'knight'): void
{
    $playerClass  = self::$cardMap[$cardId];
    $this->player = new $playerClass(); // 文字列からインスタンスを動的に生成

    $enemyClass   = self::$cardMap[array_rand(self::$cardMap)];
    $this->enemy  = new $enemyClass(); // ランダムな敵カード
}</code></pre>

            <div class="bg-rose-50 border-l-4 border-rose-400 p-4 text-sm text-rose-800 rounded-r-2xl">
                <strong>型宣言の活用：</strong> <code>attack(BaseCard $target)</code> のように引数の型を <code>BaseCard</code> にすることで、「<code>BaseCard</code> を継承したどのカードでも受け取れる」という柔軟な設計が実現します。これがポリモーフィズムの核心です。
            </div>
        </section>

        <!-- Section 6: Static Methods and Properties -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-teal-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">6</span>
                静的メソッド・プロパティ
            </h3>
            <p class="mb-4"><code>static</code> キーワードをつけたプロパティやメソッドは、<strong>インスタンスを作らずにクラス名で直接呼べます</strong>。<code>CardGame::getAvailableCards()</code> のようにユーティリティ的な処理や、クラス全体で共有するデータに使います。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
class CardGame implements CardGameInterface
{
    // static プロパティ：全インスタンスで共有（クラスに紐づく）
    private static array $cardMap = [
        'knight'  => KnightCard::class,
        'aqua'    => AquaCard::class,
        'forest'  => ForestCard::class,
        'thunder' => ThunderCard::class,
    ];

    // static メソッド：インスタンスなしで呼べる
    public static function getAvailableCards(): array
    {
        $cards = [];
        foreach (self::$cardMap as $id => $className) {
            $cards[$id] = new $className();
        }
        return $cards;
    }
}

// インスタンス不要 — クラス名::メソッド名() で呼ぶ
$availableCards = CardGame::getAvailableCards();

// self:: は自クラス、parent:: は親クラスを指す
// static:: は実行時の実クラスを指す（遅延静的束縛）</code></pre>
        </section>

        <!-- Section 7: MVC and PRG Pattern -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-slate-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm">7</span>
                MVC パターンと責務の分離
            </h3>
            <p class="mb-4">このプロジェクトでは<strong>MVC（Model-View-Controller）</strong>に近い責務の分離が行われています。各ファイルが「何を担当するか」を明確にすることで、変更の影響範囲を小さく保ちます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// Controller 基底クラス：ビューのレンダリングを担当
class Controller
{
    public function render($view, $data = [])
    {
        extract($data); // 配列のキーを変数名として展開
        require VIEW_DIR . $view;
    }
}

// GameController：各画面のルーティングと処理を担当
class GameController extends Controller
{
    public function battle()
    {
        // バトル中でなければ選択画面へ（ガード節）
        if (!isset($_SESSION['game_data'])) {
            header('Location: ../select/');
            exit;
        }

        $game = new CardGame();

        // View に必要なデータだけを渡す
        $this->render('battle.view.php', [
            'csrf_token' => $game->getCsrfToken(),
            'player'     => $game->getPlayer(),
            'enemy'      => $game->getEnemy(),
            'logs'       => $game->getLogs(),
            'isGameOver' => $game->isGameOver(),
        ]);
    }

    public function action()
    {
        $game = new CardGame();

        // CSRF 検証（POST 以外や不正トークンは即終了）
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'
            || !$game->validateCsrfToken($_POST['csrf_token'] ?? null)
        ) {
            die('不正なリクエストです（CSRFトークン不一致）');
        }

        // アクションに応じた処理
        if (isset($_POST['start'])) {
            $game->init($_POST['card_id']);
        } elseif (isset($_POST['action'])) {
            $game->processAction($_POST['action']);
        } elseif (isset($_POST['reset'])) {
            unset($_SESSION['game_data']);
        }

        // PRGパターン：POST後は必ずリダイレクト（二重送信防止）
        header('Location: ../battle/');
        exit;
    }
}</code></pre>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 mb-6">
                <h4 class="font-bold text-slate-800 mb-4">このプロジェクトの責務の割り当て</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-3">
                        <span class="flex-none px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded font-bold text-xs">Model</span>
                        <div><code>BaseCard</code> / <code>KnightCard</code> 等 / <code>CardGame</code> — ゲームのデータとロジック（攻撃計算・レベルアップ・セッション管理）</div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="flex-none px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded font-bold text-xs">View</span>
                        <div><code>views/select.view.php</code> / <code>views/battle.view.php</code> — HTML の描画のみ。ロジックを含まない</div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="flex-none px-2 py-0.5 bg-amber-100 text-amber-700 rounded font-bold text-xs">Controller</span>
                        <div><code>GameController</code> — リクエストを受け取り、Model を呼び、View にデータを渡す。POST 後は必ずリダイレクト（PRG パターン）</div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800 rounded-r-2xl">
                <strong>PRG パターン（Post / Redirect / Get）：</strong> POST を受け取って処理した後、<code>header('Location: ...')</code> でリダイレクトし、GET でページを再表示します。ブラウザの再読み込みによるフォームの二重送信を防ぐ定番パターンです。リダイレクト後は必ず <code>exit</code> でスクリプトを停止しましょう。
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"クラスで設計すると、ビジネスロジック・セキュリティ・表示を美しく分離でき、変更に強いコードになります。"</p>
        </footer>
    </main>

    <!-- Prism.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
</body>

</html>