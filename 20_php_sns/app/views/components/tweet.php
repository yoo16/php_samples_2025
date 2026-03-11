<?php

use App\Models\User;
use Lib\File;

?>
<div class="px-4 py-4 border-b border-slate-100 hover:bg-slate-50 transition">
    <div class="flex gap-3">
        <!-- プロフィール画像 -->
        <a href="user/?id=<?= $value['user_id'] ?>" class="shrink-0">
            <img src="<?= User::profileImage($value['profile_image']) ?>" class="rounded-full w-10 h-10 object-cover">
        </a>

        <!-- ツイート全体（本文＋ツールバー） -->
        <div class="flex-1 min-w-0">
            <!-- ユーザ情報 -->
            <div class="flex items-baseline gap-1 flex-wrap">
                <a href="user/?id=<?= $value['user_id'] ?>" class="font-bold text-slate-900 hover:underline">
                    <?= htmlspecialchars($value['display_name']) ?>
                </a>
                <span class="text-slate-400 text-sm">@<?= htmlspecialchars($value['account_name']) ?></span>
                <span class="text-slate-400 text-sm">·</span>
                <span class="text-slate-400 text-sm"><?= $value['created_at'] ?></span>
            </div>

            <!-- ツイート本文 -->
            <div class="mt-1 text-slate-800 text-sm leading-relaxed tweet-message" data-id="<?= $value['id'] ?>">
                <?= nl2br(htmlspecialchars($value['message'])) ?>
            </div>

            <!-- アップロード画像 -->
            <?php if (File::has($value['image_path'])): ?>
                <div class="mt-2">
                    <img src="<?= $value['image_path'] ?>" class="rounded-xl max-w-sm max-h-80 object-cover border border-slate-100" alt="">
                </div>
            <?php endif; ?>

            <!-- アクションツールバー -->
            <?php include COMPONENT_DIR . 'tweet_nav.php' ?>
        </div>
    </div>
</div>