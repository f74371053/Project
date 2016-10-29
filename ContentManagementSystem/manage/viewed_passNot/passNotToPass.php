<?php
      ini_set('display_errors', 'On');
      include("../../method/connectManage.php");

      $id = $_GET["ID"];

      $select = $connectManage -> prepare("SELECT * FROM viewed_passnot WHERE ID = :id");
      $select -> execute( array(':id' =>$id));

      $result = $select -> fetch(PDO::FETCH_ASSOC);//將一筆資料存進$result
      //插入資料進已通過資料表
      $insert = $connectManage -> prepare("INSERT INTO
                                                          viewed_pass (
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


      $delete = $connectManage -> prepare("DELETE  FROM viewed_passnot WHERE ID = :id");
      $delete -> execute(array(':id' => $id));

      //跳轉至管理介面
      header("location:./index.php");
 ?>
