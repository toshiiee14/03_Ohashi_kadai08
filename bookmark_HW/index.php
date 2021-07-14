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
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_view.php">All Articles - edit</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_viewonly.php">All Articles - view only</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="login.php">Login</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="logout.php">Logout (you will be sent to login form after automatically logged out)</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="user_index.php">Sign Up</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php" enctype="multipart/form-data">
  <div class="contents">
   <fieldset>
    <legend>POST NEW ARTICLE (Required to Login)</legend>
     <label>Title：<input type="text" name="name"></label><br>
     <label>Texts：<br>
     <textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <p>Upload your photo</p>
                <!-- multipart/form-dataという形式を指定しあげる必要有 / png, ipegのみ等指定可能-->
                <input type="file" name="upfile">
     <input type="submit" value="POST">
   </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
