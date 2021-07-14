<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['name'];
$kanri_flg = $_SESSION['kanri_flg'];


// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$name = $_POST ['name'];
$comment = $_POST ['comment'];

if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
//imageupload
    //ファイル名を取得
    $file_name = $_FILES["upfile"]["name"];
    
    //一時保存パス tmp_name = temporary name
    $tmp_path = $_FILES["upfile"]["tmp_name"];

    //拡張子取得 extensions = 拡張子
    $extensions = pathinfo($file_name, PATHINFO_EXTENSION);

    //ユニークなファイル名を生成 同じ名前のファイルがdb上に保存されている状態を防ぐ
    $file_name = date("YmdHis").md5(session_id()).".".$extensions;

    // FileUpload [--Start--]
    $img="";//空の変数
    $file_dir_path = "upload/".$file_name;//ファイル移動先とファイル名

//ここまで
if ( is_uploaded_file( $tmp_path ) ) {
  if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
    // 2. DB接続します 基本このワンパターンしか無い
    //Password:MAMP='root',XAMPP=''
    chmod( $file_dir_path, 0644 );//ファイルの権限を設定 webからアップロード出来る様にする為のおまじない
    
    $pdo = db_conn();
// ３．SQL文を用意(データ登録：INSERT) 一度":XX"で変数を用意し、バインド変数で同期する
    $stmt = $pdo->prepare(
    "INSERT INTO gs_bm_table ( id, name, comment, indate, img)
      VALUES( NULL, :name, :comment, sysdate(), :img )"
    );

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', $file_name, PDO::PARAM_STR); 

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト

  $img = '<img src="'.$file_dir_path.'">';
    // header ('Location: index.php');
}
}}}; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アップロード画面サンプル</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <main>
    <!-- ヘッダー -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="index.php">トップページへ</a></div>
            </div>
        </nav>
    </header>
    <!-- ヘッダー -->
    タイトル: <br> <?php echo $name; ?> <br>
    本文: <br> <?php echo $comment; ?> <br>
    写真: <br> <?php echo $img; ?>
</main>
</body>
</html>