<?
	$n_url = "./";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";
	if(!$type)	$type = 'list';

	$subtit = '거래처관리';

?>

<!-- <link type='text/css' rel='stylesheet' href='/css/style.css'> -->
<link type='text/css' rel='stylesheet' href='/css/button.css'>

<div class="main">
	<?
		include "../top_header.php";
	?>

	<div class="mobile_col_wrap">
		<div class="content_wrap mobile_sub_wrap">  

			<div class="main_content_left_sub mobile_sub">

					<div class="subPage_tit_wrap dp_sb dp_c">
						<p class="subPage_tit"><?=$subtit?></p>			
												
						<?if($type=='list'){?>
							<a href='up_index.php?type=write' class="btn_primary02">
								등록
							</a>
						<?}?>
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
			</div>

					
			<?
				include '../rightContent.php';
			?>
			
		</div>
		<!-- // content_wrap -->


	</div>
</div>