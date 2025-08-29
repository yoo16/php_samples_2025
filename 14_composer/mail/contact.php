<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8 text-gray-800">

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">お問い合わせフォーム</h1>

        <form action="send.php" method="POST" class="space-y-4" onsubmit="handleSubmit(event)">
            <div>
                <label class="block font-semibold mb-1">お名前</label>
                <input type="text" name="name" required class="w-full border px-4 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">メールアドレス</label>
                <input type="email" name="email" required class="w-full border px-4 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">件名</label>
                <input type="text" name="subject" required class="w-full border px-4 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">本文</label>
                <textarea name="body" rows="6" required class="w-full border px-4 py-2 rounded"></textarea>
            </div>
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center gap-2">
                    <span>送信する</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function handleSubmit(event) {
            document.getElementById("loadingOverlay").classList.remove("hidden");
        }
    </script>
</body>
</html>
