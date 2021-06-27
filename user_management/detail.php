<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id;");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
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
                <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="user_update_view.php">
        <div class="jumbotron">

        <fieldset>
            <legend>新規登録</legend>
            <label>名前：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
            <label>ユーザーID：<input type="text" name="lid" value="<?= $result['lid'] ?>"></label><br>
            <label>パスワード：<input type="text" name="lpw" value="<?= $result['lpw'] ?>"></label><br>
            <label>管理者区分：<select name="kanri_flg" id="" value="<?= $result['kanri_flg'] ?>">
                <option value="0">管理者</option>
                <option value="1">スーパー管理者</option>
            </select></label><br>
            <label>入退社区分：<select name="life_flg" id="" value="<?= $result['life_flg'] ?>">
                <option value="0">退社</option>
                <option value="1">入社</option>
            </select></label><br>
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <input type="submit" value="送信">
        </fieldset>

        </div>
    </form>
</body>

</html>