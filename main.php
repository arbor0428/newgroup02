<?
	$n_url = "./";
	include "./array.php";
?>
<title>아이웹-그룹웨어</title>

<script language='javascript'>
function premier(n) {
    for(var i = 1; i <= 5; i++) {
        obj = document.getElementById('premier'+i);
        if ( n == i ) {
            obj.style.display = "block";
        } else {
            obj.style.display = "none";
        }
    }
}

function jobtb(n) {
    for(var i = 1; i < 3; i++) {
        obj = document.getElementById('job0'+i);
        img = document.getElementById('job_button'+i);
        if ( n == i ) {
            obj.style.display = "block";
			img.height = 18;
            img.src = "./img/main/jbtnon"+i+".gif";    
        } else {
            obj.style.display = "none";
			img.height = 18;
            img.src = "./img/main/jbtnoff"+i+".gif";
        }
    }
}
</script>

<!-- 
<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td>
		<?
			$str_Root = './';
			//include './menu2.php';
		?>
		</td>
	</tr>
</table><td>-->
<style>
	.content {
	width: 100%;
	display:flex;
	}
</style>

<div class="member_util">
	<span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #000; font-size: 30px;">작업!!</span>
	<? if ($time_mod == 'out') { ?>
		<a style="color: #A10136;" class="btn_primary03" href="javascript:time_chk('<?= $time_mod ?>');">퇴근체크
	<? } else { ?>
		<a style="color: #91cc6d;" class="btn_primary03" href="javascript:time_chk('<?= $time_mod ?>');">출근체크
	<? } ?>
		</a>
	<?
	if ($GBL_USERID) {
	?>
		<a href="/logout_proc.php" class="btn_primary03" style="color:#313131;">로그아웃</a>
	<?
	}
	?>
</div>
<div class="content">
	<?
			$str_Root = './';
		//include './menu.php';
			include './header2.php';
		?>
		<style>
			.main_top_wrap {
				width: 100%; 
				display: flex;
				justify-content: space-between;
				gap: 10px;
			}
			.main_tab_wrap {
				width: 33.33%			
			}
			.main_tabs {
				width: 100%;
				display: flex;
			}
			.main_tab {
				width: 20%;
				display: flex;
				align-items: center;
				justify-content: center;
				padding: 10px;
				background-color: #ddd;
				font-size: 13px;
				color: #333;
				border-left: 1px solid #b9b9b9;
			}
			.main_tab:first-child{
				border-left: none;
			}
		.main_tab:hover {
			background-color: #313131;
			color: #fff;
		}
		.tab_content{		
			min-height: 157px;
			border-top: 2px solid #b7b7b7;
		}
		</style>
<div class="sub_content">
	<div class="main_top_wrap">
		<!-- 공지-->
		<div class="main_tab_wrap">
			<div class="main_tabs">
				<a href='./notice/up_index.php' class='main_tab' onmouseover='premier(1);'>공지사항</a> 
				<a href='./room/up_index.php' class='main_tab' onmouseover='premier(2);'>산업공지</a> 
				<a href='./qna/up_index.php' class='main_tab' onmouseover='premier(3);'>기술관련</a> 
				<a href='./data01/up_index.php' class='main_tab' onmouseover='premier(4);'>자료실</a> 
				<a href='./edu/up_index.php' class='main_tab' onmouseover='premier(5);'>교육관련</a> 
			</div>
			<div class="tab_content">
				<div id='premier1'>
						<?
							include 'main_notice.php';
						?>
				</div>

				<div id='premier2' style="display: none;">
						<?
							include 'main_room.php';
						?>
				</div>

				<div id='premier3'  style="display: none;">
						<?
							include 'main_qna.php';
						?>
				</div>

				<div id='premier4'  style="display: none;">
						<?
							include 'main_data01.php';
						?>
				</div>

				<div id='premier5'  style="display: none;">
						<?
							include 'main_edu.php';
						?>
				</div>
			</div>
		</div>
		<!-- //공지-->

		<!-- 계좌-->
	
			<?
				include 'account.php';
			?>
		
	</div>

	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0px 0px 0px;' valign='top'>
				<table cellpadding='0' cellspacing='0' border='0'  width="100%">
					<tr valign="top" height='200'>
					<!-- * 공지사항 * -->
					<!-- 	<td width="420" valign='top'>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-bottom:3px;">
										<a href='./notice/up_index.php' class='small cbtn black' onmouseover='premier(1);'>공지사항</a> 
										<a href='./room/up_index.php' class='small cbtn black' onmouseover='premier(2);'>산업공지</a> 
										<a href='./qna/up_index.php' class='small cbtn black' onmouseover='premier(3);'>기술관련</a> 
										<a href='./data01/up_index.php' class='small cbtn black' onmouseover='premier(4);'>자료실</a> 
										<a href='./edu/up_index.php' class='small cbtn black' onmouseover='premier(5);'>교육관련</a> 
									</td>
								</tr>
								<tr>
									<td height="2" bgcolor="dab467" colspan="3"></td>
								</tr>			  
							</table>
							
							<span id='premier1'>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<?
										include 'main_notice.php';
									?>
									</td>
								</tr>
							</table>
							</span>
						
							<span id='premier2' style='display:none;'>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<?
										include 'main_room.php';
									?>
									</td>
								</tr>
							</table>
							</span>
							
							<span id='premier3' style='display:none;'>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<?
										include 'main_qna.php';
									?>
									</td>
								</tr>
							</table>
							</span>
						
							<span id='premier4' style='display:none;'>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<?
										include 'main_data01.php';
									?>
									</td>
								</tr>
							</table>
							</span>
						
							<span id='premier5' style='display:none;'>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<?
										include 'main_edu.php';
									?>
									</td>
								</tr>
							</table>
							</span>
							
						</td> -->
					<!-- * 공지사항 * -->
						<td width="30"></td>
					<!-- * 계좌번호&고객센터 * -->
						<td width="560">

						<?
								//include 'account.php';
							?>

						</td>
						<!-- * 계좌번호&고객센터 * -->
					</tr>
					<tr valign="top">
						<td colspan="3" style="padding-top:30px">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">			  
							<!-- * 나의업무현황 * -->
								<tr valign="top">
									<td>
										<table border="0" cellspacing="0" cellpadding="0" width='100%'>
											<tr valign="top">
												<td width='56' valign='bottom'><a href='./job/up_index.php'><img src='./img/main/jbtnon1.gif' onmouseover='jobtb(1);' id='job_button1' alt='업무현황'></a></td>
												<td width='56' valign='bottom'><a href='./job/up_index.php'><img src='./img/main/jbtnoff2.gif' onmouseover='jobtb(2);' id='job_button2' alt='요청업무'></a></td>
												<td align='right'>
												<?
													if($tmpUser == false){
												?>
													<input type='button' name='btn01' value='도메인만료 리스트' class='inp01' onclick="location.href='./ing02/up_index.php?field=domain_date&play_sort=전체'" style='cursor:hand;'>
													<input type='button' name='btn02' value='호스팅만료 리스트' class='inp01' onclick="location.href='./ing02/up_index.php?field=host_date&play_sort=전체'" style='cursor:hand;'>
												<?
													}
												?>
												</td>
											</tr>
											<tr>
												<td height="1" colspan='3'></td>
											</tr>
										</table>

										<span id='job01'>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td>
												<?
													include 'job01.php';
												?>
												</td>
											</tr>
										</table>
										</span>

										<span id='job02' style='display:none;'>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td>
												<?
													include 'job02.php';
												?>
												</td>
											</tr>
										</table>
										</span>


									</td>
								</tr>
							<!-- * 나의업무현황 * -->		  
							

							</table>
						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	</div>
	<!-- sub_content-->

</div>
<!-- content-->
</body>


<!--
<iframe name='push_ifra01' src='push.php?alarm=<?=$alarm?>' width='0' height='0' frameborder='0' scrolling='no'></iframe>
-->