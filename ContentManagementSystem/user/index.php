<!DOCTYPE html>
<html>
  <head>
    <?php include("../method/script/dateTime.html");?>
    <?php include("../method/script/appearTimeAdjust.html");?>
    <?php include("../method/script/uploadNullCheck.html");?>
    <meta charset="utf-8">
    <title>主頁</title>
  </head>
  <body>
    <form name="add" action="./add.php" method="post" enctype="multipart/form-data">
      <table>
        <tr>
         <td>網址:</td>
         <td><input type="text" name="webSite">
         </td></tr>
        <tr>
          <td>圖片:</td>
          <td><input type="file" name="file">
          </td></tr>
        <tr>
         <td>開始日期:</td>
         <td>
           <input type="text" id="startDate" name="startDate">
         </td></tr>
        <tr>
          <td>結束時間:</td>
          <td>
            <input type="text" id="endDate" name="endDate">
          </td></tr>
        <tr>
          <td>選擇時段:</td>
          <td>
            <input type="text" name="appearTime" id="appearTime">
          </td></tr>
        <tr>
          <td>
           <input type="button"  value="送出" onclick="check()">
        </td> </tr>
      </table>
    </form>
  </body>
</html>
