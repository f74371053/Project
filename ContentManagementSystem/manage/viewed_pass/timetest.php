<?php
    ini_set("display_errors","On");
    include("../../method/connectManage.php");

    $select = $connectManage -> prepare("SELECT * FROM viewed_pass WHERE appearTime = '09:00:00' ");
    $select -> execute();


    foreach (($select -> fetchall(PDO::FETCH_ASSOC)) as $result ) {
       var_dump($result['appearTime']);
    }
    $select = $connectManage -> prepare("SELECT * FROM viewed_pass WHERE appearTime = '18:00:00' ");
    $select -> execute();
    foreach (($select -> fetchall(PDO::FETCH_ASSOC)) as $result ) {
       var_dump($result['appearTime']);
    }
 ?>
