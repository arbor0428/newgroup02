<?
	include '../head.php';
	include "../module/class/class.Msg.php";
	include "../module/class/class.DbCon.php";

	//팀장급(mtype = S)인 경우 본인 팀원 목록만설정
	$teamChk = true;
	include "../array.php";


	$today_y = date('Y');
	$today_m = date('m');
	$today_d = date('d');
	

	if(!$s_name){
		//연구소직원
		if(!array_key_exists($GBL_USERID,$laborUarr))	$s_name = 'korea';
		else															$s_name = $GBL_USERID;
	}

	$subtit = '연구소일지';

?>

<script language='javascript'>
function onWriteForm(num){
	var Form_tr = document.getElementById("wr" + num);
	Form_tr.style.display='';
}

function user_sel(){
	form = document.frm_day;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>




<?	
//	include '../menu.php';
?>

<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>


<form name='frm_day' method='post' action='./proc.php'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='name' value='<?=$GBL_NAME?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='s_year' value=''>
<input type='hidden' name='s_month' value=''>
<input type='hidden' name='s_day' value=''>
<input type='hidden' name='cur_y' value='<?=$cur_y?>'>
<input type='hidden' name='cur_m' value='<?=$cur_m?>'>
<input type='hidden' name='cur_d' value='<?=$cur_d?>'>

	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='50%'><a href='/'><img src='../img/home.gif'></a>&nbsp;&nbsp;<span style='font-size:20px;font-weight:800;'><?=$subtit?></td>
					<td width='50%' align='right' valign='bottom'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><a href="javascript:onWriteForm('1');"><img src="../img/board/register.gif" border=0></a></td>
						<?
							if($GBL_MTYPE == 'A' || $GBL_MTYPE == 'S'){	//관리자
						?>
								<td width='10'></td>
								<td>
									<select name='s_name' onchange='user_sel();'>
									<?
										foreach($laborUarr as $k => $v){
									?>
										<option value='<?=$k?>' <?if($s_name==$k) echo 'selected';?>><?=$v?></option>
									<?
										}
									?>
									</select>
								</td>
						<?
							}
						?>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td>
		<?
			//업무등록
			include 'log_write.php';
		?>
		</td>
	</tr>

	<tr>
		<td>
		<?
			//등록된 업무일지
			include 'day_log.php';
		?>
		</td>
	</tr>

	<tr>
		<td align='center'>
		<?
			//달력
			include 'calendar.php';
		?>
		</td>
	</tr>

</table>

</form>