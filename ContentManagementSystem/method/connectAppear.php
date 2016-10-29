<?php

    $link = array(
                               'host' => "localhost",
                               'account' => "root",
                               'password' => "root",
                               'dbname' => "appear"
                             );

    $dbconnect = 'mysql:host ='.$link['host'].';dbname='.$link['dbname'];

    try {
      $connectAppear=new PDO($dbconnect,$link['account'],$link['password']);
      $connectAppear-> query("SET NAMES 'utf8'");
      $connectAppear->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
          echo "Connection failed: ".$e->getMessage();
           exit();
    }


 ?>
