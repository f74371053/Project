<?php
     ini_set("display_errors","On");
     include("../../method/connectManage.php");
     $id = $_GET['ID'];

     $select = $connectManage ->prepare("SELECT * FROM viewed_passnot WHERE ID = :id");
     $select -> execute(array(':id' => $id));

     $result = $select -> fetch(PDO:: FETCH_ASSOC);

     if (file_exists("../../picture/".$result['fileName'])) {
                 unlink("../../picture/".$result['fileName']);
                 $delete = $connectManage -> prepare("DELETE  FROM viewed_passnot WHERE ID = :id");
                 $delete -> execute(array(':id' => $id));
                 header("location:./index.php");
     }else {
                $delete = $connectManage -> prepare("DELETE  FROM viewed_passnot WHERE ID = :id");
                $delete -> execute(array(':id' => $id));

                header("location:./index.php");
     }
?>
