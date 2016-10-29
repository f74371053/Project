<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>未通過列表</title>
  </head>
  <body>
     <?php
        ini_set("display_errors","On");
        include("../../method/connectManage.php");

        $select = $connectManage -> prepare("SELECT * FROM viewed_passnot");
        $select -> execute();
        //fetchall 所有資料 fetch 一筆資料
        ?>
        <a href="../unviewed/index.php">未審核列表</a>
        <a href="../viewed_pass/index.php">已通過列表</a>
        <a href="../viewed_passNot/index.php">未通過列表</a>
        <a href="../appear/index.php">顯示列表</a>
        <?php
        foreach (($select -> fetchall(PDO::FETCH_ASSOC)) as $result ) {?>
          <table border="1">
            <tr width = 200px ><td>網址</td>
              <td width = 300px >
                <?php echo  "<a  target = '_blank' href = http://to22.com/osite.php?url=".$result['webSite'].">網址</a>"; ?>
              </td></tr>
              <tr><td>圖片</td>
                <td>
                  <?php echo  "<a  target = '_blank' href = ../../picture/".$result['fileName'].">圖片</a>"; ?>
                </td></tr>
              <tr><td>開始日期:</td>
                    <td>
                      <?php echo $result['startDate']; ?>
                    </td></tr>
              <tr><td>結束日期:</td>
                      <td>
                        <?php echo $result['endDate']; ?>
                      </td></tr>
              <tr><td>顯示時段:</td>
                            <td>
                              <?php echo $result['appearTime']; ?>
                            </td></tr>
             <tr><td>管理:</td>
                        <td>
                             <a href="./passNotToDelete.php?ID=<?php echo $result['ID'];?>">
                               刪除</a>
                             <a href="./passNotToPass.php?ID=<?php echo $result['ID']; ?>">
                               復原</a>
                            </td></tr>
          </table>
    <?php
        }
    ?>

  </body>
</html>
