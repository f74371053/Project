<?php
      ini_set('display_errors', 'On');
      include("connectMySQL.php");

      $select = $connect -> prepare("SELECT * FROM selecttime");
      $select -> execute();

      foreach (($select -> fetchall(PDO::FETCH_ASSOC)) as  $result ) {?>
        <table border="2">
          <tr  width = '200px'><td>網址:</td>
            <td  width = '300px'>
              <?php
              echo "<a  target ='_blank'  href=http://to22.com/osite.php?url=".$result['webSite'].">網址</a>";?>
              <!-- to22.com 是掃毒網址 -->
               </td></tr>
          <tr><td>檔名:</td>
              <td>
                <?php echo "<a target='_blank' href=./picture/".$result['fileName'].">圖片</a>";?>
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
                           <a href="reviewedPass.php?ID=<?php echo $result['ID'];?>">通過</a>
                          <a href="reviewedNot.php?ID=<?php echo $result['ID'];?>">未通過</a>
                         </td></tr>
        </table>
      <?php  }



 ?>
