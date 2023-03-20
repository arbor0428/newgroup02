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
		<div class="content_wrap">  

			<div class="main_content_left_sub">
				<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>

					<tr>
						<td style='padding-top:10px;padding-bottom:10px;'>
							<table cellpadding='0' cellspacing='0' border='0' width='100%'>
								<tr>
									<td width='50%'><a href='/'><img src='/img/home.gif'></a>&nbsp;&nbsp;<span style='font-size:20px;font-weight:800;'><?=$subtit?></td>
									<td width='50%' align='right' valign='bottom'><?if($type=='list'){?><a href='up_index.php?type=write'><img src="/img/board/register.gif" border=0></a><?}?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>

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