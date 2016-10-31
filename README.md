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
    - 1.1.1 User/index.php
    - 1.1.2 User/add.php

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

