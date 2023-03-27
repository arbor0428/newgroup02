<?
	$n_url = "./";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

	//팀장급(mtype = S)인 경우 본인 팀원 목록만설정
	$teamChk = true;


	$today_y = date('Y');
	$today_m = date('m');
	$today_d = date('d');
	

	if(!$s_name){
		//연구소직원
		if(array_key_exists($GBL_USERID,$laborUarr))	$s_name = 'cho3771';
		else															$s_name = $GBL_USERID;
	}

	$subtit = '업무일지';

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

<!-- <link type='text/css' rel='stylesheet' href='/css/style.css'> -->
<link type='text/css' rel='stylesheet' href='/css/button.css'>


<?	
	//include '../menu.php';
?>


<div class="main">
	<?
		include "../top_header.php";
	?>

	<div class="mobile_col_wrap">
		<div class="content_wrap mobile_sub_wrap">  

			<div class="main_content_left_sub mobile_sub">

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

				<div class="subPage_tit_wrap dp_sb dp_c">
					<p class="subPage_tit"><?=$subtit?></p>
					<div class="dp_f dp_c">
						<a href="javascript:onWriteForm('1');" class="btn_primary02" style="margin-right: 10px;">등록</a>
						<?
							if($GBL_MTYPE == 'A' || $GBL_MTYPE == 'S'){	//관리자
						?>
							<select name='s_name' onchange='user_sel();'>
							<?
								for($i=0; $i<count($arr_member); $i++){
									if(!array_key_exists($arr_userid[$i],$laborUarr)){
							?>
								<option value='<?=$arr_userid[$i]?>' <?if($s_name==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
							<?
									}
								}
							?>
							</select>
							<?
								}
							?>
					</div>
				</div>


					<?
						//업무등록
						include 'log_write.php';
					?>


					<?
						//등록된 업무일지
						include 'day_log.php';
					?>


					<?
						//달력
						include 'calendar.php';
					?>

				</form>

			</div>

					
			<?
				include '../rightContent.php';
			?>
			
		</div>
		<!-- // content_wrap -->


	</div>
</div>



<!-- 				<table border="0" cellspacing="0" cellpadding="0" align='center'  style="width: 100%;">



						<tr>
							<td style='padding-top:10px;padding-bottom:10px;'>
								<table cellpadding='0' cellspacing='0' border='0' width='100%'>
									<tr>
										<td width='50%'><span style='font-size:20px;font-weight:800;'><?=$subtit?></td>
										<td width='50%' align='right' valign='bottom'>
											<table cellpadding='0' cellspacing='0' border='0'>
												<tr>
													<td><a href="javascript:onWriteForm('1');"><img src="/img/board/register.gif" border=0></a></td>
											<?
												if($GBL_MTYPE == 'A' || $GBL_MTYPE == 'S'){	//관리자
											?>
													<td width='10'></td>
													<td>
														<select name='s_name' onchange='user_sel();'>
														<?
															for($i=0; $i<count($arr_member); $i++){
																if(!array_key_exists($arr_userid[$i],$laborUarr)){
														?>
															<option value='<?=$arr_userid[$i]?>' <?if($s_name==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
														<?
																}
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
 -->