<?php
     ini_set('display_errors', 'On');
     include("../../method/connectManage.php");

     $id = $_GET["ID"];

     $select = $connectManage -> prepare("SELECT * FROM viewed_pass WHERE ID = :id");
     $select -> execute( array(':id' =>$id));

     $result = $select -> fetch(PDO::FETCH_ASSOC);//將一筆資料存進$result
      //插入資料進未通過資料表
     $insert = $connectManage -> prepare("INSERT INTO
                                                    viewed_passnot (
                                                    webSite,
                                                    fileName,
                                                    startDate,
                                                    endDate,
                                                    appearTime
                                                  )VALUES(
                                                    ?,?,?,?,?
                                                  )");
     $insert -> execute(array(
                   $result['webSite'],
                   $result['fileName'],
                   $result['startDate'],
                   $result['endDate'],
                   $result['appearTime']
            ));

      //刪除未審核內資料 因為已經審核過了
      $delete = $connectManage -> prepare("DELETE  FROM viewed_pass WHERE ID = :id");
      $delete -> execute(array(':id' => $id));

    //跳轉至管理介面
    header("location: ./index.php");
 ?>
