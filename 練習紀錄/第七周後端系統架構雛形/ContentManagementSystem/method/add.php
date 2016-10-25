<?php
      ini_set("display_errors",'On');

      $webSite   = $_POST["webSite"];
      $fileName  = $_FILES['file']['name'];
      //檔案記得表單需加(enctype='multipart/form-data')
      $startDate = $_POST["startDate"];
      $endDate =   $_POST["endDate"];
      $appearTime = $_POST["appearTime"];

      if($_FILES["file"]["error"]==0){
          move_uploaded_file($_FILES["file"]["tmp_name"],"../picture/".$_FILES["file"]["name"]);
      }else {
          echo"fileErrorCode:".$_FILES["file"]["error"];
      }

      include("./connectMySQL.php");

      $insert = $connect -> prepare( "INSERT INTO
                          unviewed (
                                  webSite,
                                  fileName,
                                  startDate,
                                  endDate,
                                  appearTime
                                ) VALUES (
                                  ?,?,?,?,?
                                )");
      $insert -> execute(
              array( $webSite,
                           $fileName,
                           $startDate,
                           $endDate,
                           $appearTime
                         ));
      header("location:http://localhost/ContentManagementSystem/manage/unviewed/index.php");
 ?>
