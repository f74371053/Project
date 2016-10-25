<?php
    ini_set("display_errors","On");
    include("../method/connectMySQL.php");
    $id = $_GET["ID"];

    $select = $connect -> prepare("SELECT * FROM appear WHERE ID = :id");
    $select -> execute(array(':id' => $id));

    $result = $select -> fetch(PDO::FETCH_ASSOC);

    if (file_exists("../../picture/".$result['fileName'])) {
                unlink("../../picture/".$result['fileName']);
                $delete = $connect -> prepare("DELETE  FROM appear WHERE ID = :id");
                $delete -> execute(array(':id' => $id));
                header("location:./index.php");
    }else {
               $delete = $connect -> prepare("DELETE  FROM appear WHERE ID = :id");
               $delete -> execute(array(':id' => $id));

               header("location:./index.php");
    }
    header("location:./index.php");
