<?php
     ini_set("display_errors","On");
     include("../../method/connectManage.php");
     include("../../method/connectAppear.php");
     $id = $_GET["ID"];

     $select = $connectManage -> prepare("SELECT * FROM viewed_pass WHERE ID = :id ");
     $select -> execute(array(':id' => $id ));

     $result = $select -> fetch(PDO:: FETCH_ASSOC);

    //  $connectManage = NULL;//關閉連線

      $timeList = array('1' =>"09:00:00",
                                          '2' =>"10:00:00",
                                          '3' =>"11:00:00",
                                          '4' =>"12:00:00",
                                          '5' =>"13:00:00",
                                          '6' =>"14:00:00",
                                          '7' =>"15:00:00",
                                          '8' =>"16:00:00",
                                          '9' =>"17:00:00",
                                          '10' =>"18:00:00");
      $timeTable = array('1' =>"time_9",
                                              '2' =>"time_10",
                                              '3' =>"time_11",
                                              '4' =>"time_12",
                                              '5' =>"time_13",
                                              '6' =>"time_14",
                                              '7' =>"time_15",
                                              '8' =>"time_16",
                                              '9' =>"time_17",
                                              '10' =>"time_18");

      $i = 1;
      while ($i <= 10) {
        if($result['appearTime'] == $timeList[$i]){
             $insert = $connectAppear -> prepare("INSERT INTO $timeTable[$i] (
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
                                                     $result['appearTime']));
             $connectAppear = NULL;


             $select = $connectManage -> prepare("SELECT * FROM viewed_pass WHERE ID = :id ");
             $select -> execute(array(':id' => $id ));

             $delete = $connectManage -> prepare("DELETE FROM viewed_pass WHERE ID = :id");
             $delete -> execute(array(':id' => $id));
              header("location:./index.php");
        }
        $i++;
      }


    //
 ?>
