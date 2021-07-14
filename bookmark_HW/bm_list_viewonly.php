<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = db_conn();
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
//3. 実行
$status = $stmt->execute();


//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる while文 fetch:文字を取り出す
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<p>';
    $view .= '<a href="detail_viewonly.php?id=' . $result['id'] . '">';
    $view .= $result["indate"] . "：" . $result["name"];
    $view .= '</a>';
    $view .= '</a>';//追記
    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>記事一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Top Page</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
    <a href="detail.php"></a>
            
</div>
<!-- Main[End] -->

</body>
</html>
