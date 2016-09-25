<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>留言板</title>
  </head>
  <body>
     <a href="view.php">觀看留言</a>
     <form  action="add.php" method="post">
       姓名:<input type="text" name="name"><br>
       郵件:<input type="text" name="mail"><br>
       主題:<input type="text" name="subject"><br>
       內容:<textarea name="content" rows="7" cols="40"></textarea><br>
       <input type="submit" name="Submit" value="送出">
       <input type="reset" name="Reset" value="重新填寫">
     </form>
  </body>
</html>
