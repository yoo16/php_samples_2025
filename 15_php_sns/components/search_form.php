<div class="p-5 border-b border-gray-200 pb-3">
    <form action="home/search/" method="get" class="flex items-center space-x-2">
        <input type="text" name="keyword" placeholder="キーワード検索"
            value="<?= isset($keyword) ? $keyword : '' ?>"
            class="w-1/2 px-4 py-2 rounded-full border border-gray-300">
        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full w-auto">
            検索
        </button>
    </form>
</div>