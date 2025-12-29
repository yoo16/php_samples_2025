<?php
$bg_base64 = $bg_base64 ?? '';
$bgStyle = "";

if (!empty($bg_base64)) {
  $bgStyle = "style=\"background-image: url('{$bg_base64}');\"";
}
?>
<div class="card" <?= $bgStyle ?>>
  <div class="name"><?= htmlspecialchars($name ?: '東京 太郎') ?></div>
  <div class="title"><?= htmlspecialchars($title ?: 'SENIOR ENGINEER') ?></div>
  <div class="info">
    Email: <?= htmlspecialchars($email ?: 'tokyo@example.com') ?><br>
    Web: <?= htmlspecialchars($web ?: 'https://tokyo.com') ?><br>
    Tel: <?= htmlspecialchars($tel ?: '090-0000-0000') ?>
  </div>
</div>