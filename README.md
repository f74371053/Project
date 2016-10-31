# 數位看版系統
==========================
## 簡介:

###了解校園互動多媒體看板的概念:
####一開始的的想法是發現校園的公布欄貼滿了很多活動海報，但我卻發現我並不會對這些海報有所興趣，我不想去看這些東西，因為就我的視野上我只看到一堆凌亂的圖文呈現在我面前。所以我從此思考，也許學校需要一種管理海報的系統，有條理的適時呈現內容，使海報在呈現不會顯得凌亂而且反而能吸引注目，因此我在專題上選擇做一個校園的數位看板。

###基礎架構:

####架構分為四大類:
ContentManagementSystem/
----------------------------
- 1.使用者:使用者上傳海報、影片及填寫想呈現的時段、選擇何時開始何時結束。
  - 1.1 User/
  -----------
    - index.php
    - add.php

- 2.管理者:管理者要審核使用者上傳的物件，將可以播放的物件放進播放清單，並可隨時管理播放內容，不適播放的物件可以刪除。審核完後須通知使用者是否上傳成功，並通知日期或不通過原因。
  -	 Manage/
  ----------------
     -  unviewed/
     
        - index.php
        - pass.php
        - passNot.php
     -  viewed_pass/
        - index.php
        - passToAppear.php
        - passToNot.php
     -  viewed_passNot/
        - index.php
        - passNotToDelete.php
        - passNotToPass.php
     -  appear/
        - index.php
        - move.php

- 3.顯示頁:照時段換不同時段的播放列表，可用紅外線、Leap Motion等感應器簡單的切換想看的頁面。
  - picture/
    - 圖片jpg
    - ...
  - appearList/
  ---------------
    - css/
    - javascript/
    - index.html

- 4.函式資料夾:如連線資料庫的一些重複性的函式都會記錄在這裡，並用引入的方式載入程式碼。
  - method/
  --------------
    -  script/
      - dateTime.html
    - connectManage.php
    - connectAppear.php
    
###基本上所有的操作都會在ContentManagementSystem/ 的資料夾內運行，如將接收表單、傳上資料庫、管理員審核分類...等等。

## ContentManagementSystem/
-----------------------------------------------
###User/index.php
 此介面有幾項需求:
 
 - 填入影片網址或上傳海報(圖片)
 
 - 選擇播放開始時間及結束播放時間
   * 使用javaScript插件  
 - 選擇呈現的時段(ex: 09:00)
   * 使用javaScript插件
 - 防呆機制
    - 結束時間不能早於開始時間(ex:開始時間 10/31,結束時間 10/21)
    - 如果沒有影片及圖片不得上傳
    - 檢查檔案格式(jpg、png)
```php
<!DOCTYPE html>
<html>
  <head>
    <?php include("../method/script/dateTime.html");?>
    <script>//時段細節設定
     $( function() {
        $( "#startDate" ).datepicker();
        $( "#endDate" ).datepicker();
        $("#appearTime").timepicker({
              timeFormat: 'H:mm',//24小時
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
    </script>
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
```

### add.php
  將index.php 的表單傳進資料庫 manage 的資料表 unviewed。  
  此頁面需求:
  
 - 接收表單變數
  - $_POST['webSite']    網址
  - $_POST['fileName']   檔名
  - $_POST['startDate']  開始日期  
  - $_POST['endDate']    結束日期  
  - $_POST['appearTime'] 呈現時段
  
  
```php
   <?php
      ini_set("display_errors",'On');
      $webSite   = $_POST["webSite"];
      $fileName  = $_FILES['file']['name'];
      //檔案記得表單需加(enctype='multipart/form-data')
      $startDate = $_POST["startDate"];
      $endDate =   $_POST["endDate"];
      $appearTime = $_POST["appearTime"];
      if($_FILES["file"]["error"]==0){
          move_uploaded_file($_FILES["file"]["tmp_name"],
          iconv("UTF-8", "big5", "../picture/".$_FILES["file"]["name"] ));//防止中文檔名亂碼
      }else {
          echo"fileErrorCode:".$_FILES["file"]["error"];
      }
      include("../method/connectManage.php");
      $insert = $connectManage -> prepare( "INSERT INTO
                          unviewed (
                                  webSite,
                                  fileName,
                                  startDate,
                                  endDate,
                                  appearTime
                                ) VALUES (
                                  ?,?,?,?,?
                                )");
      $insert -> execute(
              array( $webSite,
                           $fileName,
                           $startDate,
                           $endDate,
                           $appearTime
                         ));
      header("location:http://localhost/ContentManagementSystem/manage/unviewed/index.php");
 ?>
```

