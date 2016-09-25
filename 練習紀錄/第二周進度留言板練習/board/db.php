<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>討論區</title>
  </head>
  <body>
    <?php
      $Administrator= array(
        "Host"=>"localhost" ,
        "User"=>"root",
        "Password"=>"root",
        "DataBase"=>"board");
      $connect=mysql_connect(
       $Administrator["Host"],
       $Administrator["User"],
       $Administrator["Password"]);
       mysql_query('SET NAMES UTF8');
       mysql_select_db($Administrator["DataBase"]);
      // if(!$connect){
      //   die("連結失敗");
      // }
      // else {
      //         echo " 連結成功了";
      // }
         ?>
  </body>
</html>
