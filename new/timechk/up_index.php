<?
	$n_url = "./";
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";	

	include '../header.php';

	//�����(mtype = S)�� ��� ���� ���� ��ϸ�����
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
					<p class="subPage_tit">������Ȳ</p>	
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