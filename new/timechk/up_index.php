<?
	$n_url = "./";
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";	

	include '../header.php';

	//팀장급(mtype = S)인 경우 본인 팀원 목록만설정
	$teamChk = true;

?>

<!-- <link type='text/css' rel='stylesheet' href='/css/style.css'> -->
<link type='text/css' rel='stylesheet' href='/css/button.css'>

<script language='javascript'>
function job_search(job){
	form01 = document.form1;
	form01.f_search.value = job;
	form01.record_start.value = '';
	
	form02 = document.frm01;
	form02.submit();
}
</script>

<div class="main">
	<?
		include "../top_header.php";
	?>

	<div class="mobile_col_wrap">
		<div class="content_wrap">  

			<div class="main_content_left_sub">
				<table border="0" cellspacing="0" cellpadding="0" align='center' style="width: 100%;">
					<tr>
						<td style='padding-top:10px;padding-bottom:10px;'>
							<table cellpadding='0' cellspacing='0' border='0' width='100%'>
								<tr>
									<td width='50%'><span style='font-size:20px;font-weight:800;'>근태현황</td>
									<td width='50%' align='right' valign='bottom'></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<?
								if($GBL_MTYPE == 'A' || $GBL_USERID == 'psw2222')		include 'list.php';
								else								include 'list_user.php';
							?>
						</td>
					</tr>					
				</table>

			</div>



			<?
				include '../rightContent.php';
			?>
			
		</div>
		<!-- // content_wrap -->


	</div>
</div>


<?
	include '../foot.php';
?>