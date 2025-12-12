<?php
require_once 'model.php';
$review_save = new Review();
//オーダー内容によって処理を分岐
$order = $_POST['order'];
if($order == 1){
    //登録
    function readBlob($key) {
        if (!empty($_FILES['img']['tmp_name'][$key])) {
            return file_get_contents($_FILES['img']['tmp_name'][$key]);  // バイナリ取得
        }
        return null;
    }

    $data =[
        'eval_point'=> $_POST['point']
        ,'review_comment'=> $_POST['comment'] ?? null
        ,'rst_id'=> $_POST['rst_id']
        ,'user_id'=> $_POST['user_id']
        ,'photo1'=> readBlob(0)
        ,'photo2'=> readBlob(1)
        ,'photo3'=> readBlob(2)
        ,'rev_state'=> true
    ];
    //print_r($_FILES);
    //print_r($data);
    $review_save->insert($data);
}elseif($order == 2){
    //編集
    //レビューidを受け取る
    $review_id = $_POST['review_id'];

    function readBlob($key) {
        if (!empty($_FILES['img']['tmp_name'][$key])) {
            return file_get_contents($_FILES['img']['tmp_name'][$key]);  // バイナリ取得
        }
        return null;
    }

    $data =[
        'eval_point'=> $_POST['point']
        ,'review_comment'=> $_POST['comment'] ?? null
        ,'rst_id'=> $_POST['rst_id']
        ,'user_id'=> $_POST['user_id']
        ,'photo1'=> readBlob(0)
        ,'photo2'=> readBlob(1)
        ,'photo3'=> readBlob(2)
        ,'rev_state'=> true
    ];
    //print_r($_FILES);
    //print_r($data);
    $review_save->update($data,'review_id='.$review_id);
}elseif($order == 3){
    //非表示
    $review_id = $_POST['review_id'];
    $data = $review_save -> getDetail("review_id =". $review_id);
    $state['rev_state']= 0;
    $review_save -> update($state,'review_id='.$review_id);
}elseif($order == 4){
    //削除

}
header('Location:?do=rst_detail&rst_id='.$data['rst_id']);
?>