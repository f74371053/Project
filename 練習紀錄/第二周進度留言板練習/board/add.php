<?php
      header('Content-type: text/html; charset=utf-8');//注意編碼 中文會亂碼
      header("location:view.php");//轉至view.php
       include("db.php");
       $name=$_POST["name"];
       $mail=$_POST["mail"];
       $subject=$_POST["subject"];
       $content=$_POST["content"];
       $time=date("Y-m-d H:i:s",time()+28800);//有時差 要加時間
       if(isset($name)&&$name!=null){
          $WriteIntoSQL=
          "insert into  guest(Name,Email,Subject,Content,Time)
            value('$name','$mail','$subject','$content','$time')";
           mysql_query($WriteIntoSQL);
      }
 ?>
