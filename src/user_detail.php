<?php
// 仮の店舗データ
$store = [
  'store_id' => '001',
  'store_name' => '九段製麺 九産大前店',
  'address' => '〒813-0004 福岡市東区松香台２丁目２−４',
  'tel' => '092-000-0000',
  'hours' => '11:00〜22:00',
  'holiday' => '不定休',
  'url' => 'https://www.example.com',
  'payment' => '現金・電子マネー・クレジットカード',
  'photo' => 'photo_sample.jpg',
  'review_avg' => '4.2',
  'review_count' => '128'
];

// 仮の口コミデータ
$reviews = [
  [
    'genre' => 'ラーメン',
    'account_name' => '社員A',
    'rating' => 4,
    'comment' => 'スープが濃厚で美味しい！',
    'photo' => 'ramen.jpg'
  ],
  [
    'genre' => 'チャーハン',
    'account_name' => '社員B',
    'rating' => 5,
    'comment' => 'パラパラで最高でした！',
    'photo' => 'fried_rice.jpg'
  ],
  [
    'genre' => '餃子',
    'account_name' => '社員C',
    'rating' => 3,
    'comment' => '皮が少し厚めでしたがジューシー。',
    'photo' => ''
  ]
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>店舗詳細 - Lunch Hunter</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .container { max-width: 900px; margin: auto; }
    .info, .review, .form_area { margin-bottom: 30px; }
    label { font-weight: bold; display: block; margin-top: 10px; }
    img { max-width: 100%; height: auto; margin-top: 10px; }
    .nav_buttons button { margin-right: 10px; }
    .review_card { border: 1px solid #ccc; padding: 10px; margin-top: 10px; border-radius: 5px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Lunch Hunter</h1>
    <div class="nav_buttons">
      <button onclick="location.href='logout.php'">ログアウト</button>
      <button onclick="location.href='mypage.php'">マイページ</button>
      <button onclick="location.href='store_edit.php?store_id=<?= $store['store_id'] ?>'">編集</button>
      <button onclick="location.href='store_list.php'">店舗一覧</button>
    </div>

    <h2>店舗詳細</h2>
    <div class="info">
      <label>店舗名</label>
      <p><?= $store['store_name'] ?></p>

      <label>住所</label>
      <p><?= $store['address'] ?></p>

      <label>電話番号</label>
      <p><?= $store['tel'] ?></p>

      <label>営業時間</label>
      <p><?= $store['hours'] ?></p>

      <label>店休日</label>
      <p><?= $store['holiday'] ?></p>

      <label>URL</label>
      <a href="<?= $store['url'] ?>" target="_blank">公式サイト</a>

      <label>支払方法</label>
      <p><?= $store['payment'] ?></p>

      <label>外観写真</label>
      <img src="<?= $store['photo'] ?>" alt="店舗外観">

      <label>総合評価</label>
      <p><?= $store['review_avg'] ?> / 5（<?= $store['review_count'] ?>人）</p>
    </div>

    <div class="form_area">
      <h3>評価投稿</h3>
      <form method="post" enctype="multipart/form-data">
        <label for="review_title">タイトル</label>
        <input type="text" id="review_title" name="review_title">

        <label for="review_comment">コメント（250文字以内）</label>
        <textarea id="review_comment" name="review_comment" maxlength="250"></textarea>

        <label for="review_rating">評価（1〜5）</label>
        <select id="review_rating" name="review_rating">
          <option value="1">★☆☆☆☆</option>
          <option value="2">★★☆☆☆</option>
          <option value="3">★★★☆☆</option>
          <option value="4">★★★★☆</option>
          <option value="5">★★★★★</option>
        </select>

        <label for="review_photo">写真（任意）</label>
        <input type="file" id="review_photo" name="review_photo">

        <button type="submit" name="submit_review">評価する</button>
      </form>
    </div>

    <div class="review">
      <h3>口コミ一覧</h3>
      <?php foreach ($reviews as $r): ?>
        <div class="review_card">
          <p><strong>ジャンル：</strong><?= $r['genre'] ?></p>
          <p><strong>アカウント：</strong><?= $r['account_name'] ?></p>
          <p><strong>評価：</strong> <?= str_repeat('★', $r['rating']) ?><?= str_repeat('☆', 5 - $r['rating']) ?></p>
          <p><strong>コメント：</strong><?= $r['comment'] ?></p>
          <?php if (!empty($r['photo'])): ?>
            <img src="<?= $r['photo'] ?>" alt="料理写真">
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>