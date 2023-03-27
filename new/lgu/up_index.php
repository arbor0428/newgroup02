<?
		$n_url = "./";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

	if(!$type)	$type = 'list';

	$subtit = 'LGU+';


	$statusArr = Array('신규','번호이동','일시정지','해지','재연장','보류');
	$serviceArr = Array('대표번호','기업070','오피스넷','지능형CCTV','웹팩스','소호인터넷');

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