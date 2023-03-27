<?
		include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

	if(!$type)	$type = 'list';
	if(!$play_sort)	$play_sort = '진행중';

	if($f_status)	 $subtit = $f_status;
	else	$subtit = '에이젼시현황';

	$next_url='up_index.php';




?>

<link type='text/css' rel='stylesheet' href='/css/button.css'>

<div class="main">
	<?
		include "../top_header.php";
	?>

	<div class="mobile_col_wrap">
		<div class="content_wrap mobile_sub_wrap">  

			<div class="main_content_left_sub mobile_sub">

					<div class="subPage_tit_wrap">
						<p class="subPage_tit"><?=$subtit?></p>
					</div>
					<div class="subPage_tbl_wrap">
						<?
							switch($type){
								case 'list' :
													include 'list.php';
													break;


								case 'write' :
								case 'edit' :

						//							include 'write.php';
													include 'write2.php';
													break;
							}
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

