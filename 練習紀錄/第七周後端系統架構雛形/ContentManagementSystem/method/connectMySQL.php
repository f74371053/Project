<?php

     $link = array(
                               'host' => "localhost",
                               'account' => "root",
                               'password' => "root",
                               'dbname' => "board"
                              );

     $dbconnect =  'mysql:host='.$link['host'].';dbname='.$link['dbname'];

      // try 判斷是否連上 否:顯示訊息
      try {
        $connect=new PDO($dbconnect,$link['account'],$link['password']);
        $connect-> query("SET NAMES 'utf8'");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (Exception $e) {
            echo "Connection failed: ".$e->getMessage();
      }
      
?>
