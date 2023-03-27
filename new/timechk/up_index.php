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
		<div class="content_wrap mobile_sub_wrap">  

			<div class="main_content_left_sub mobile_sub">
				<div class="subPage_tit_wrap">
					<p class="subPage_tit">근태현황</p>	
				</div>

				<div class="subPage_tbl_wrap">

					<?
						if($GBL_MTYPE == 'A' || $GBL_USERID == 'psw2222')		include 'list.php';
						else								include 'list_user.php';
					?>
				</div>

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