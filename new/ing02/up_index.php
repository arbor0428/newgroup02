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

<link type='text/css' rel='stylesheet' href='/css/style.css'>
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
							<form name='frm_list' method='post'>
								<tr>
									<td width='50%'><a href='/'><img src='/img/home.gif'></a>&nbsp;&nbsp;<span style='font-size:20px;font-weight:800;'><?=$subtit?></td>
									<td width='50%' align='right' valign='bottom'>
									<?
										if($type=='list'){
									?>
										<a href='up_index.php?type=write'><img src="/img/board/register.gif" border=0></a>
									<?
										}
									?>
									</td>
								</tr>
							</form>
							</table>
						</td>
					</tr>
					<tr>
						<td style="word-break:break-all;">

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