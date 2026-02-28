# Tailwind CSS デザイン制御プロンプト集

「海外SaaS風（グラデーション・パープル）」を回避し、日本的なクリーン・フラットデザインにするための指示書。

---

## 1. 基本のデザイン方針

プロンプトの冒頭、または「デザイン指示」セクションに含めるキーワード：

- **色の制御**:
  - 「グラデーション（gradient）を禁止し、ソリッドカラーのみ使用」
  - 「プライマリカラーを濃紺（#1a202c）や深緑などの落ち着いた色に固定」
  - 「背景は白（#ffffff）と極薄いグレー（#f9fafb）の2色で構成」
- **形状と装飾**:
  - 「大きな角丸（rounded-3xlなど）を避け、`rounded-sm` または `rounded-none` にする」
  - 「ドロップシャドウを廃止し、境界線（border-gray-200）でセクションを区切る」
- **タイポグラフィ**:
  - 「日本語の可読性を最優先し、Noto Sans JP または游ゴシックを指定」

---

## 2. そのまま使えるプロンプト・テンプレート

> **[Design Rules]**
>
> - Avoid any purple/pink gradients or "modern tech" aesthetic.
> - Background: Pure white (#FFFFFF) only.
> - UI Style: Flat design. No heavy shadows.
> - Border: Use subtle 1px borders (#E5E7EB) instead of color blocks for sectioning.
> - Accent: Use a single professional color (e.g., Navy #001F3F).
> - Components: High information density, clean and professional alignment.

---

## 3. Tailwind クラスの変換辞書（AIへの指示用）

AIに対し、「以下のクラス置換ルールを適用して」と指示すると効果的です。

| 避けたい要素（海外風） | 推奨する要素（日本・フラット風） |
| :--- | :--- |
| `bg-gradient-to-br` | `bg-white` |
| `from-purple-500` | `border-b border-gray-200` |
| `rounded-2xl` / `rounded-3xl` | `rounded-md` / `rounded-none` |
| `shadow-xl` | `border border-gray-100` |
| `text-indigo-600` | `text-slate-900` (基本は黒) |

---

## 4. 適用例

「日本のビジネスサイト、または信頼感のあるコーポレートサイト」を目指す場合は、**「明朝体（font-serif）」**をアクセントに使う指示を加えると、一気に雰囲気が変わります。
