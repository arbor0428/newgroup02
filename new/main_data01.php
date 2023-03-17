<?
$sql = "select * from wo_data01 order by uid desc limit 5";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
?>

<script language='javascript'>
function board_data01(uid,mode){	
	location.href = './data01/up_index.php?type='+mode+'&uid='+uid;
}
</script>

<div class="tbl">
  <?
  if($num){
    for($i=0; $i<$num; $i++){
      $row = mysql_fetch_array($result);
      $uid = $row["uid"];
      $userid = $row["userid"];
      $name = $row["name"];
      $reg_date = $row["reg_date"];
      $reg_date = date('Y-m-d',$reg_date);

      $date_diff = Util::dateDiff($SYSTEM_DATE,$reg_date);

      if($date_diff < 3){
        $new_icon = "<span class='new_icon'>N</span>";
        $str_len = 34;
      }else{
        $new_icon = '';
        $str_len = 38;
      }

      $title = Util::Shorten_String($row["title"],$str_len,'..');

      if($GBL_USERID == $userid)	$mode = 'edit';
      else	$mode = 'view';

      if($i > 0)	 echo ("");
    ?>
				<div class="tbl_tr board_flex" style="cursor: pointer;">					
				  <div class="tbl_td board_title" onclick="board_data01('<?=$uid?>','<?=$mode?>');"><?=$title?> <?=$new_icon?></div>
					<div class="tbl_flex board_date" >
           <div class="tbl_td" onclick="board_data01('<?=$uid?>','<?=$mode?>');" align='center'><?=$name?></div>
           <div class="tbl_td" onclick="board_data01('<?=$uid?>','<?=$mode?>');" align='center'><?=$reg_date?></div>
          </div>
				</div>

    <?
      }
    }else{
    ?>

      <div class="tbl_tr">
        <div class="tbl_td no_board">등록된 자료가 없습니다</div>
      </div>

    <?
      }
    ?>

</div>