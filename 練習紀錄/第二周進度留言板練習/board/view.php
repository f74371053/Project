<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>列出所有留言</title>
  </head>
  <body>
    <a href="index.php">寫寫留言</a><br>
    <?php
      include("db.php");
     $data=mysql_query("select * from guest")or die(" 查詢失敗: " . mysql_error());
     for($i=1;$i<=mysql_num_rows($data);$i++){
     $rs=mysql_fetch_row($data);
     ?>
      <tr>
        <td>編號:</td><td><?php echo $rs[0]?></td><br>
        <td> 姓名:</td><td><?php echo $rs[1]?></td><br>
        <td>Emal</td> <td><?php echo $rs[2]?></td><br>
        <td>主題:</td><td><?php echo $rs[3]?></td><br>
        <td>內容:</td><td><?php echo $rs[4]?></td><br>
      </tr>
      <br>
     <?php
     }
     ?>
  </body>
</html>
