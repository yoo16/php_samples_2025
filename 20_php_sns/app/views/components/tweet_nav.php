<div class="flex items-center gap-5 mt-3">
    <!-- コメント -->
    <div class="inline-flex items-center gap-1.5 text-slate-400 hover:text-sky-500 transition cursor-pointer">
        <img src="svg/bubble.svg" class="w-4 h-4" alt="コメント">
        <span class="text-xs">0</span>
    </div>

    <!-- いいね -->
    <form action="home/like/" method="post" class="inline-flex items-center">
        <button type="submit" class="inline-flex items-center gap-1.5 text-slate-400 hover:text-rose-500 transition">
            <img src="svg/heart.svg" class="w-4 h-4" alt="いいね">
            <span class="text-xs"><?= $value['like_count'] ?></span>
        </button>
        <input type="hidden" name="tweet_id" value="<?= $value['id'] ?>">
        <input type="hidden" name="user_id" value="<?= $auth_user['id'] ?>">
    </form>

    <!-- リポスト -->
    <div class="inline-flex items-center gap-1.5 text-slate-400 hover:text-emerald-500 transition cursor-pointer">
        <img src="svg/loop.svg" class="w-4 h-4" alt="リポスト">
        <span class="text-xs">0</span>
    </div>

    <?php if (isset($auth_user['id']) && $auth_user['id'] === $value['user_id']): ?>
        <!-- 削除 -->
        <form action="home/delete/" method="post" class="ml-auto">
            <div onclick="deleteTweet(this)" class="inline-flex items-center gap-1.5 text-slate-400 hover:text-red-500 transition cursor-pointer">
                <img src="svg/trash.svg" class="w-4 h-4" alt="削除">
            </div>
            <input type="hidden" name="tweet_id" value="<?= $value['id'] ?>">
            <input type="hidden" name="user_id" value="<?= $auth_user['id'] ?>">
        </form>
    <?php endif ?>
</div>