<?php
// 1. POSTデータ取得
$name = $_POST ['name'];
$lid = $_POST ['lid'];
$lpw = $_POST ['lpw'];
$kanri_flg = $_POST ['kanri_flg'];
$life_flg = $_POST ['life_flg'];

// 2. DB接続します 基本このワンパターンしか無い
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }
  
// ３．SQL文を用意(データ登録：INSERT) 一度":XX"で変数を用意し、バインド変数で同期する
$stmt = $pdo->prepare(
  "INSERT INTO gs_user_table (id, name, lid, lpw, kanri_flg, life_flg)
  VALUES( NULL, :name, :lid, :lpw, :kanri_flg, :life_flg)"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); 
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT); 

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