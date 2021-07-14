<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
loginCheck();
$user_name = $_SESSION['name'];

//insert.phpの処理を持ってくる
///1. POSTデータ取得
$name   = $_POST["name"];
$comment    = $_POST["comment"];
$id = $_POST["id"];

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

//３．データ登録SQL作成

$stmt = $pdo->prepare( "UPDATE gs_bm_table SET name = :name, comment = :comment, indate = sysdate(), img=:img WHERE id = :id;" );
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':img', $file_name, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行
// 6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
  }else{
    //５．index.phpへリダイレクト
    redirect ("bm_list_view.php");
  }
  }}}; 

?>