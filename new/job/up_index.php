<?
	$n_url = "./";
	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

	if(!$type)	$type = 'list';

	

	if(!$f_search)	$f_search = '업무';

	if($f_search == '업무')	$subtit = '업무현황';
	elseif($f_search == '요청')	$subtit = '요청업무';
	elseif($f_search == '전체')	$subtit = '전체업무';

if(!$state){
	$state='요청';
}

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



<?

?>



<div class="main">
	<?
		include "../top_header.php";
	?>

	<div class="mobile_col_wrap">
		<div class="content_wrap mobile_sub_wrap">  

			<div class="main_content_left_sub mobile_sub">
					<div class="subPage_tit_wrap dp_sb dp_c">
						<div class="sub_title" ><?=$subtit?></div>
						<?if($type=='list'){?><a href='up_index.php?type=write' class="btn_primary02">등록</a><?}?>
					</div>					
					

					<div class="subPage_tbl_wrap">

						<?
							switch($type){									
								case 'list' :
													include 'list.php';
													break;

								case 'view' :
													include 'view.php';
													break;

								case 'write' :
								case 'edit' :
													include 'write.php';
													break;

							}
						?>
					</div>
				<!--//테이블 끝 -->

			</div>
					
			<?
				include '../rightContent.php';
			?>
			
		</div>
		<!-- // content_wrap -->


	</div>
</div>

