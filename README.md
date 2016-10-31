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
## User/
###index.php
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


### add.php
  將index.php 的表單傳進資料庫 manage 的資料表 unviewed。  
  此頁面需求:
  
 - 接收表單變數
  - $_POST['webSite']    網址
  - $_POST['fileName']   檔名
  - $_POST['startDate']  開始日期  
  - $_POST['endDate']    結束日期  
  - $_POST['appearTime'] 呈現時段
 - 傳至資料庫 manage 的資料表 unviewed等待管理員審核
  
  
## Manage/
----------
### unviewed/index.php

   此頁面接收資料庫 manage 的資料表 unviewed 的資料
   此頁面需求為:  
  - 連線db:manage 取出unviewed的欄位
  - 檢視圖片或網址(超連結檢視)
  - 合格送至 viewed_pass 資料表
  - 不合格送至 viewed_passNot 資料表
  - 取的欄位ID進行分派資料工作(pass.php、passNot.php)
  
### unviewed/pass.php

   此頁面是抓取 index.php 傳來的ID 用$_GET['ID']接收
   此頁面需求為:
  - 抓取資料庫 manage 資料表 unviewed 的ID = $_GET['ID'] 的欄位
  - 將此來欄位傳進 資料庫 manage 的資料表 viewed_pass
  - 刪除資料庫 manage 資料表 unviewed 的ID = $_GET['ID'] 的欄位
  - 跳轉回 index.php

