<?php
require_once('model.php');
$user = new User();
$rst = new Restaurant();
$review = new Review();

//userのセッションを確認
$user_id = $_SESSION['user_id'];

//userのデータを取得
$mydata = $user->get_UserDetail(['user_id' => $user_id]);
$favorites = $user->get_favorite($user_id);
//print_r($mydata);

?>
<div class="main">
    <div class="row" style="display: flex; align-items: center;">
        <div class="col-xs-6">
            <h2 style="margin: 0;">マイページ</h2>
        </div>
        <div class="col-xs-6 text-right">
            <button type="button" class="btn btn-default" onclick="location.href='?do=user_myedit'">
                ユーザ情報編集
            </button>
        </div>
    </div>
</div>





<div class="info-area">
    <!--アカウント情報-->
    <div class="info">
        <div>
            <div class="item1">社員番号ID:</div>
            <div><?php echo $mydata['user_id'] ?></div><br>
        </div>
        <div>
            <div class="item1">氏名:</div>
            <div><?php echo $mydata['username'] ?></div><br>
        </div>
    </div>
    <div class="info1">
        <div>
            <div class="item1">アカウント名:</div>
            <div><?php echo $mydata['user_account'] ?></div><br>
        </div>
        <div>
            <div class="item1">フリガナ:</div>
            <div><?php echo $mydata['userkana'] ?></div><br>
        </div>
    </div>
</div>
<!--投稿店舗-->
<div class="shop">
    <?php foreach ($favorites as $shop) : ?>
        <a href="?do=rst_detail&rst_id=<?= intval($shop['rst_id']) ?>" class="item-link">
            <div class="item">
                <div class="shopi">
                    <h4>店舗名:
                        <?php
                        echo $shop['rst_name']
                        ?>
                    </h4>
                    <div class="rating mb-2">
                        <?php
                        $review_data = $review->getList("rst_id = " . intval($shop['rst_id']));
                        $rating = 0;
                        $count = 0;

                        if (!empty($review_data)) {
                            foreach ($review_data as $r) {
                                // rev_state が true のものだけ計算に含める
                                if ($r['rev_state']) {
                                    $rating += intval($r['eval_point']);
                                    $count++;
                                }
                            }
                            if ($count > 0) {
                                $rating = $rating / $count;
                            } else {
                                $rating = 0; // 表示用に評価がない場合は 0
                            }
                        }

                        $stars = round($rating);
                        ?>
                        <?= str_repeat('★', $stars) ?><?= str_repeat('☆', 5 - $stars) ?> <?= $stars ?>
                    </div>
                    <div>ジャンル:
                        <br>
                        <?php
                        if (!empty($shop['rst_genre'])) {
                            $genre_names = array_map(fn ($g) => $g['genre'], $shop['rst_genre']);
                            echo implode(', ', $genre_names);
                        } else {
                            echo 'なし';
                        }
                        ?>
                    </div>

                    <div><?php echo $shop['discount_label'] ?></div>
                </div>
                <div class="phot">
                    <img class="img" src="<?= !empty($shop['photo1']) ? htmlspecialchars($shop['photo1']) : '/path/to/default_image.jpg' ?>" alt="<?= !empty($shop['photo1']) ? '店舗写真' : '未登録' ?>">
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>