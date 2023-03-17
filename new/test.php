<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Util.php";

if ($_SERVER['REMOTE_ADDR'] == '106.246.92.237') {
  $sql =  "desc book_mark ";
  $result = mysql_query($sql);
  $num = mysql_num_rows($result);
 
  echo $num . '/<br><br><br><br>';

  while ($row = mysql_fetch_array($result)) {

    for ($i = 0; $i < 50; $i++) {
      echo $row[$i] . '/';
    }
    echo '<br>';
  }
}
