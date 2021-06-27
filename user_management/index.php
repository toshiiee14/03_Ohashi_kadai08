<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link rel="stylesheet" href="./style.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="contents">
   <fieldset>
    <legend>新規登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ユーザーID：<input type="text" name="lid"></label><br>
     <label>パスワード：<input type="text" name="lpw"></label><br>
     <label>管理者区分：<select name="kanri_flg" id="">
        <option value="0">管理者</option>
        <option value="1">スーパー管理者</option>
     </select></label><br>
     <label>入退社区分：<select name="life_flg" id="">
        <option value="0">退社</option>
        <option value="1">入社</option>
     </select></label><br>
     <input type="submit" value="送信">
   </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
