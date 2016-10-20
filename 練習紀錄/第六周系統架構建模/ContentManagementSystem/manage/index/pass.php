<?php
      ini_set('display_errors', 'On');
      include("../../method/connectMySQL.php");

      $id = $_GET["ID"];

      $select = $connect -> prepare("SELECT * FROM selecttime WHERE ID = :id");
      $select -> execute( array(':id' =>$id));

      $result = $select -> fetch(PDO::FETCH_ASSOC);//將一筆資料存進$result
      //插入資料進已通過資料表
      $insert = $connect -> prepare("INSERT INTO
                                                        pass (
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
      $delete = $connect -> prepare("DELETE  FROM selecttime WHERE ID = :id");
      $delete -> execute(array(':id' => $id));

      //跳轉至管理介面
      header("location:./index.php");
 ?>
