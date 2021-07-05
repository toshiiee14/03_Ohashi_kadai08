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
$url = $_POST ['url'];
$comment = $_POST ['comment'];

// 2. DB接続します 基本このワンパターンしか無い
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = db_conn();
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }
  


// ３．SQL文を用意(データ登録：INSERT) 一度":XX"で変数を用意し、バインド変数で同期する
$stmt = $pdo->prepare(
  "INSERT INTO gs_bm_table ( id, name, url, comment, indate)
  VALUES( NULL, :name, :url, :comment, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header ('Location: index.php');
}
?>