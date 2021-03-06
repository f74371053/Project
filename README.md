# 校園互動多媒體看板系統
-----------------------------------
## 簡介:

####了解校園互動多媒體看板的概念:
##### 一開始的的想法是發現校園的公布欄貼滿了很多活動海報，但我卻發現我並不會對這些海報有所興趣，我不想去看這些東西，因為就我的視野上我只看到一堆凌亂的圖文呈現在我面前。所以我從此思考，也許學校需要一種管理海報的系統，有條理的適時呈現內容，使海報在呈現不會顯得凌亂而且反而能吸引注目，因此我在專題上選擇做一個校園的數位看板。

##基礎架構:

####架構分為四大類:
ContentManagementSystem/
----------------------------
- 1.使用者:使用者上傳海報、影片及填寫想呈現的時段、選擇何時開始何時結束。
 - [1.1 User/](#1)
    - index.php
    - add.php

- 2.管理者:管理者要審核使用者上傳的物件，將可以播放的物件放進播放清單，並可隨時管理播放內容，不適播放的物件可以刪除。審核完後須通知使用者是否上傳成功，並通知日期或不通過原因。
  -	 [2.1 Manage/](#2)

     - [2.1.1 unviewed/](#2.1)
         - index.php
         - pass.php
         - passNot.php
     - [2.1.2 viewed_pass/](#2.2)
         - index.php
         - passToAppear.php
         - passToNot.php
     -  [2.1.3 viewed_passNot/](#2.3)
         - index.php
         - passNotToDelete.php
         - passNotToPass.php
     -  [2.1.4 appear/](#2.4)
         - index.php
         - move.php

- 3.顯示頁:照時段換不同時段的播放列表，可用紅外線、Leap Motion等感應器簡單的切換想看的頁面。
  - [3.1 picture/](#3.1)

    - 圖片jpg
    - ...
  - [3.2 appearList/](#3.2)

    - css/
    - javascript/
    - index.html

- 4.函式資料夾:如連線資料庫的一些重複性的函式都會記錄在這裡，並用引入的方式載入程式碼。
  - [4.1 method/](#4.1)

    -  script/
      - dateTime.html
    - connectManage.php
    - connectAppear.php
    
####基本上所有的操作都會在ContentManagementSystem/ 的資料夾內運行，如將接收表單、傳上資料庫、管理員審核分類...等等。

## ContentManagementSystem/
-----------------------------------------------
<h2 id='1'>User/</h2>
### -index.php
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


### - add.php
  將index.php 的表單傳進資料庫 manage 的資料表 unviewed。
  此頁面需求:
 - 接收表單變數
  - $_POST['webSite']    網址
  - $_POST['fileName']   檔名
  - $_POST['startDate']  開始日期  
  - $_POST['endDate']    結束日期  
  - $_POST['appearTime'] 呈現時段
 - 傳至資料庫 manage 的資料表 unviewed等待管理員審核
  
  
<h2 id='2'> Manage/</h2>
<h3 id='2.1'>unviewed/</h3>
 
#### - index.php

此頁面接收資料庫 manage 的資料表 unviewed 的資料，管理員由此頁面進行初步審核。
此頁面需求為:
 - 連線db:manage 取出unviewed的欄位
 - 檢視圖片或網址(超連結檢視)
 - 合格送至 viewed_pass 資料表 
 - 不合格送至 viewed_passNot 資料表
 - 取的欄位ID進行分派資料工作(pass.php、passNot.php)
  
#### - pass.php

此頁面是抓取 index.php 傳來的ID。用$_GET['ID']接收。

此頁面需求為:
 - 抓取資料庫 manage 資料表 unviewed 的ID = $_GET['ID'] 的欄位
 - 將此來欄位傳進 資料庫 manage 的資料表 viewed_pass
 - 刪除資料庫 manage 資料表 unviewed 的ID = $_GET['ID'] 的欄位
 - 跳轉回 index.php
 
#### - passNot.php

此頁面是抓取 index.php 傳來的ID。用$_GET['ID']接收。

此頁面需求為:
 - 抓取db:manage table:unviewed 的ID = $_GET['ID'] 的欄位
 - 將此來欄位傳進 db:manage table:viewed_passNot
 - 刪除db:manage table:unviewed 的ID = $_GET['ID'] 的欄位
 - 跳轉回 index.php
 
 

<h3 id='2.2'>viewed_pass/</h3>

#### - index.php

此頁面是抓取db:manage table:viewed_pass 的欄位，如果沒有審核錯誤將傳至播放時段分類，如果有審核錯誤可傳至viewed_passNot。

此頁面需求為:

  - 連線db:manage table:viewed_pass
  - 取出資料表 viewed_pass 中的欄位
  - 審核通過:
   - 抓取db:manage table:viewed_pass 的ID = $_GET['ID']
   - 將資料與ID傳至 db:appear table:'依欄位[appearTime]的時間分類'
  - 審核不通過:
   - 抓取db:manage table:viewed_pass 的ID = $_GET['ID']
   - 將資料與ID傳至 db:manage table:viewed_passNot

#### - passToAppear.php

此頁面是抓取index.php所傳來的 $_GET['ID']，抓取資料庫 manage 資料表viewed_pass 的ID = $_GET['ID']的欄位，取的欄位['appearTime']分類進儲存各時段的資料表。 

此頁面需求為:

  - 連線db:manage talbe:viewed_pass
  - 抓取id= $_GET['ID']的欄位 並取出欄位:['appearTime']
  - 創立時段陣列[0900~1800]、及資料表名稱[time_9~time_18]
  - 連線db:appear
  - 假設欄位:['appearTime'] == [0900~1800] 就送到 db:appear table:[time_9~time_18]
  - 送入後關閉連線 db:appear
  - 刪除db:manage table:viewed_pass ,id= $_GET['ID']的欄位
  - 跳轉回index.php

#### - passToNot.php
此頁面是抓取index.php所傳的值$_GET['ID'],抓取 db:manage table:viewed_pass 的ID = $_GET['ID'] 的欄位,將此欄位送至 db:manage table:viewed_passnot 

此頁面需求為:
  - 連線db:manage;table:viewed_pass
  - 抓取 ['ID']= $_GET['ID'] 的欄位 
  - 將此欄位插入 db:manage table:viewed_passnot
  - 刪除 db:manage table:viewed_pass ['ID']= $_GET['ID']的欄位
  - 跳轉回index.php

<h3 id='2.3'> viewed_passnot/</h3>

#### - index.php
此頁面接收資料庫 manage 的資料表 viewed_passnot 的資料，管理員由此頁面進行刪除物件擊回傳誤判物件至 db:manage table: viewed_pass。

此頁面需求為:
 - 連線db:manage table:viewed_passnot
 - 顯示viewed_passnot 所有欄位
 - 檢視圖片或網址(超連結檢視)
 - 取得欄位ID進行分派資料工作(passNotToDelete.php、passNotToPass.php)
 - 管理
  - 刪除:將欄位ID傳至passNotToDelete.php
  - 誤審:將欄位ID傳至passNotToPass.php

#### - passNotToDelete.php
此頁面是抓取 index.php 傳來的ID。用$_GET['ID']接收。

此頁面需求為:
 - 抓取db:manage table:viewed_passnot 的ID = $_GET['ID'] 的欄位
 - 抓取欄位['fileName']以便刪刪除站內暫存圖片(海報)
 - 用欄位['fileName']判斷圖片是否存在
   - 圖檔存在:
     - 刪除站內圖檔
     - 刪除db:manage table:viewd_passnot 的ID = $_GET['ID'] 的欄位
     - 跳轉回 index.php
   - 圖檔不存在:
      - 刪除db:manage table:viewd_passnot 的ID = $_GET['ID'] 的欄位
      - 跳轉回 index.php

#### - passNotToPass.php
此頁面是抓取 index.php 傳來的ID。用$_GET['ID']接收。

此頁面需求為:
  - 抓取db:manage table:viewed_passnot 的ID = $_GET['ID'] 的欄位
  - 將此欄位傳進 db:manage table:viewed_pass
  - 刪除db:manage table:viewed_passNot 的ID = $_GET['ID'] 的欄位
  - 跳轉回 index.php

<h3 id='2.4'> appear/</h3>

#### - index.php
此頁面是依照當天日期抓取 db:appear table:array[time_9~time_18]的欄位 即時控管已經上架的播放列表
此頁面需求為:
 - 連線db:appear table:array[time_9~time_18]
 - 取得今日日期
 - 顯示播放日期包含於今天的播放列表(ex:10/21~10/31,今日10/29)
 - 假設有問題可下架某播放物件
 - 下架:連結->取得欄位ID傳至move.php
 
#### - move.php
此頁面是抓取index.php所傳的值$_GET['ID'],抓取 db:appear table:[time_9~time_18] 的ID = $_GET['ID'] 的欄位,將此欄位刪除
此頁面需求為:
  - 連線db:appear;table:[time_9~time_18]
  - 抓取 ['ID']= $_GET['ID'] 的欄位 
  - 刪除db:appear;table:[time_9~time_18],['ID']= $_GET['ID']的欄位
  - 跳轉回index.php
