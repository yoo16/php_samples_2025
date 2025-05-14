<section class="max-w-md mx-auto p-6 rounded-lg">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6"><?= $title ?></h2>

    <div class="flex justify-center mb-4">
        <p class="text-lg text-gray-700 mb-4"><?= $message ?></p>
    </div>

    <div class="flex justify-center mb-4">
        <button onClick="showLoading()" class="bg-sky-500 text-white p-4 rounded">ローディング</button>
    </div>
</section>

<script>
    // ページが読み込まれたときにローディングを表示
    // (() => {
    //     showLoading(1000);
    // })();
</script>