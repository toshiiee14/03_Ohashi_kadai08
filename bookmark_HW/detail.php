<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id;");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch(PDO::FETCH_BOTH);
    $viewimg .= '<img src = "upload/'.$result["img"].'"></p>';
    };

?>


<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>データ登録</title>
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="bm_list_view.php">記事一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="bm_update_view.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
            <legend>記事詳細</legend>
                <label>タイトル：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>本文: <br><textarea name="comment" rows="4" cols="40"><?= $result['comment'] ?></textarea></label><br>
                <div class="container-fluid">
                <div id="photarea">
                <?= $viewimg ?>
                </div>
                </div>
               
                <p>写真を変更</p>
            
                <!-- multipart/form-dataという形式を指定しあげる必要有 / png, ipegのみ等指定可能-->
                <input type="file" name="upfile" > 
                <input type="hidden" name="id" value="<?= $result['id'] ?>">

                <input type="submit" value="更新">
            </fieldset>
        </div>
        <div class="container-fluid">
                <div id="photarea">
                <?= $view ?>
                </div>
                </div>
                </form>
</body>

</html>