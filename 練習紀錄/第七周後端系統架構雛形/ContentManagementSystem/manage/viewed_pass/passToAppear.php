<?php
     ini_set("display_errors","On");
     include("../../method/connectMySQL.php");
     $id = $_GET["ID"];

     $select = $connect -> prepare("SELECT * FROM viewed_pass WHERE ID = :id ");
     $select -> execute(array(':id' => $id ));

     $result = $select -> fetch(PDO:: FETCH_ASSOC);

     $insert = $connect -> prepare("INSERT INTO appear (
                                                                        webSite,
                                                                        fileName,
                                                                        startDate,
                                                                        endDate,
                                                                        appearTime
                                                                      )VALUES(
                                                                        ?,?,?,?,?
                                                                      )");
    $insert -> execute(array($result['webSite'],
                                                      $result['fileName'],
                                                      $result['startDate'],
                                                      $result['endDate'],
                                                      $result['appearTime'] ));

    $delete = $connect -> prepare("DELETE FROM viewed_pass WHERE ID = :id");
    $delete -> execute(array(':id' => $id));

    header("location:./index.php");
 ?>
