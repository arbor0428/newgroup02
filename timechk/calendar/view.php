<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Msg.php';

	$userid = $HTTP_POST_VARS['userid'];

	if($userid == ''){
		Msg::alert('���ٿ���');
		exit;
	}


	if($year && $month && $day){
		$yoil = date('w',strtotime($year.'-'.$month.'-'.$day));

		if($yoil == 0)	$yoiltxt = '(�Ͽ���)';
		elseif($yoil == 1)	$yoiltxt = '(������)';
		elseif($yoil == 2)	$yoiltxt = '(ȭ����)';
		elseif($yoil == 3)	$yoiltxt = '(������)';
		elseif($yoil == 4)	$yoiltxt = '(�����)';
		elseif($yoil == 5)	$yoiltxt = '(�ݿ���)';
		elseif($yoil == 6)	$yoiltxt = '(�����)';
	}



	$sql = "select * from ks_board_list where table_id='$table_id' and data01='$year' and data02='$month' and data03='$day' order by uid";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

?>

<title>���������</title>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="/module/js/common.js" type="text/JavaScript"></script>
<style type='text/css'>
body{
	margin:10px;
	scrollbar-face-color:#F7F7F7;
	scrollbar-shadow-color:#a1a1a1;
	scrollbar-highlight-color: #FFFFFF;
	scrollbar-3dlight-color: #a1a1a1;
	scrollbar-darkshadow-color: #999;
	scrollbar-track-color: #efefef;
	scrollbar-arrow-color: #a1a1a1;
}

</style>




<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides" class='s'>
	<tr height='30'> 
		<td class='tab_titc'><?=$year?>�� <?=$month?>�� <?=$day?>�� <?=$yoiltxt?></td>
	</tr>

	<tr height='30'> 
		<td class='tab_tit'>
			<table cellpadding='0' cellspacing='0' border='0'>
<?
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$title = $row['title'];
		$ment = $row['ment'];
?>
				<tr height='30'>
					<td><img src='./img/default.png'></td>
					<td style='padding:3 0 0 2;'><b><?=$title?></b></td>
				</tr>
				<tr height='50'>
					<td></td>
					<td style='padding:3 0 30 0;'><?=$ment?></td>
				</tr>
<?
	}
?>

		</td>
	</tr>
</table>


