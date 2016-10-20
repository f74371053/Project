<!DOCTYPE html>
<html>
  <head>
    <?php include("../method/script/dateTime.html");?>
    <script>//時段細節設定
     $( function() {
        $( "#startDate" ).datepicker();
        $( "#endDate" ).datepicker();
        $("#appearTime").timepicker({
              minTime:'09',
               interval: 60,
               dynamic: false,
              maxTime:'6:00pm',
              startTime:'09:00',
              defaultTime:'09'
           });
        } );
    </script>
    <script type="text/javascript">//上傳檢查
      function check() {
             var startDate = add.startDate.value;
             var endDate = add.endDate.value;
             var webSite = add.webSite.value;
                       if ($('[name = file]').val() == "" && webSite == "" ) {
               //  $('[name = file ]').val() ==''    JQuery　打法
                        alert("沒有上傳任何東西");
            }else if (startDate =="" ||  endDate == "") {
                                  alert("沒有填日期");
                                }
             else if(startDate > endDate){
                                  alert('開始時間: '+startDate+'  結束時間:'+endDate+' 時間錯誤');
            }else {
                 add.submit();
           }
      }
      // if ($('[name = file]').val() =='' ) {
      //   //  $('[name = file ]').val() ==''    JQuery　打法
      //            alert("沒有上傳任何東西");
      //      }
    </script>
    <meta charset="utf-8">
    <title>主頁</title>
  </head>
  <body>
    <form name="add" action="../method/add.php" method="post" enctype="multipart/form-data">
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
