<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_viewonly.php">All Articles - view only</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="login.php">Login</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="logout.php">Logout</a></div><!-- ここを追記 -->
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>Sign Up</legend>
     <label>name：<input type="text" name="name"></label><br>
     <label>Id：<input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>
     <label>Authority：<select name="kanri_flg" id="">
     <option value="0">user</option>
     <option value="1">owner</option>
     </select></label><br>
     <input type="submit" value="SEND">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->



</body>
</html>