<script language='javascript'>

function reg_view(uid){
	form = document.frm_job;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '../job/index.php';
	form.submit();
}

</script>

<form name='frm_job' method='post' action='<?=$PHP_SELF?>'>
	<input type="text" style="display: none;">  <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='f_search' value=''>
	<input type='hidden' name='uid' value=''>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
</form>
<div class="box_tit dp_c dp_sb">
	<p class="dp_f dp_c">
		<span class="material-symbols-outlined">folder_open</span>
		���� ���� ��û ��Ȳ
	</p>
	<a href="/job/up_index.php?type=write" title="���">
		<span class="material-symbols-outlined">
		add
		</span>
	</a>
</div>
<div class="tbl">
	<div class="tbl_tr tbl_tit_tr board_flex">
		<div class="tbl_th board_title" >���� </div>
		<div class="tbl_th m_none board_title" >�۾�������Ʈ </div>
		<div class="tbl_th m_none board_title" >�߿䵵 </div>
		<div class="tbl_th board_title" >��û�� </div>
		<div class="tbl_th board_title" >������� </div>
		<div class="tbl_th board_title" >��û���� </div>
	</div>





<?
		if(!$f_state01 && !$f_state02 && !$f_state03 && !$f_state04 && !$f_state05){
		$f_state01 = '��û';
		$f_state02 = '����';
		$f_state03 = '����';
		$f_state04 = 'ó�����';
		$f_state05 = '';
	}


	$record_count = 7;  //�� �������� ��µǴ� ���ڵ��

	$link_count = 5; //�� �������� ��µǴ� ������ ��ũ��

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	$query_ment = "where uid > 0";



	$query_ment .= " and ((re_name='$GBL_NAME' and (state!='ó�����' and state!='�Ϸ�')) or (userid='$GBL_USERID' and state='ó�����'))";
	$query_ment .= " and userid='$GBL_USERID'";

	if($f_project)	$query_ment .= " and project like '%$f_project%'";

	if($f_title)	$query_ment .= " and title like '%$f_title%'";

	if($f_ment)	$query_ment .= " and ment like '%$f_ment%'";

	if($f_re_name)	$query_ment .= " and re_name='$f_re_name'";

	if($f_name)	$query_ment .= " and name='$f_name'";

	$query_ment .= " and (state='$f_state01' || state='$f_state02' || state='$f_state03' || state='$f_state04' || state='$f_state05')";




	$sort_ment = "order by uid desc";

	$query = "select * from wo_job $query_ment $sort_ment";


	$result = mysql_query($query) or die("�������");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_job $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

	if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$project = $row["project"];
		$name = $row["name"];
		$re_name = $row["re_name"];
		$status = $row["status"];
		$state = $row["state"];
		$title = $row["title"];
		$reg_date = $row["reg_date"];
		$reg_date = date('Y-m-d',$reg_date);

		$end_date = $row["end_date"];

		if($end_date)	$end_date = date('Y-m-d',$end_date);
		else	$end_date = '';


		$date_diff = Util::dateDiff($SYSTEM_DATE,$reg_date);

		if($date_diff < 3)	 $new_icon = "<img src='/images/common/new_file.gif'>";
		else	$new_icon = '';

		if($state == '��û'){
			$Color = '#de712e';

		}elseif($state == '����'){
			$Color = '#52809a';

		}elseif($state == '����'){
			$Color = '#4ead04';

		}elseif($state == 'ó�����'){
			$Color = '#af238c';
			$title = '<b>'.$title.'</b>';

		}else{
			$Color = '#777777';
			$title = '<strike>'.$title.'</strike>';
			$new_icon = '';
		}

		$java_link = 'reg_view';

?>

		<div class="tbl_tr board_flex">
			<div class="tbl_td ellipsis" onclick="<?=$java_link?>('<?=$uid?>','����');"><?=$title?> <?=$new_icon?></div>
			<div class="tbl_td m_none" onclick="<?=$java_link?>('<?=$uid?>','����');"><?=$project?></div>
			<div class="tbl_td m_none" onclick="<?=$java_link?>('<?=$uid?>','����');"><?=$status?></div>					
			<div class="tbl_td" onclick="<?=$java_link?>('<?=$uid?>','����');"><?=$name?></div>
			<div class="tbl_td" onclick="<?=$java_link?>('<?=$uid?>','����');"><span class='<?=$stateArr[$state]?>'><?=$state?></span></div>
			<div class="tbl_td" onclick="<?=$java_link?>('<?=$uid?>','����');"><?=$reg_date?></div>
		</div>

<?
	}
}else{
	echo ("<div class='tbl_tr'><div class='tbl_td' style='width: 100%; text-align: center;'>������ ������ �����ϴ�.</div></div>");
}
?>

<?
	$fName = 'frm_job';

	include '../new/pageNum.php';
?>
<style>
.pageNum {
	padding: 45px 0 20px;
}
@media (max-width:786px)  {
	.pageNum {
		padding: 20px 0;
	}
}
</style>
</div>