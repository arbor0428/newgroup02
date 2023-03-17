<?
	$n_url = "./";

	include "./header.php";

    $mainTitle =  '홈';
?>

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
$(document).ready(function () {
	$('.notice_tab li').on("click",function(event){
		event.preventDefault();

        let tabNumber = $(this).index();

        $(".notice_tab li").removeClass("active");
        $(this).addClass("active");

        $(".table_wrap .premier").stop().hide();
        $(".table_wrap .premier").eq(tabNumber).stop().fadeIn(500);
	});

});
</script>

				 
				
				
<div class="main">
	<?
		include "./top_header.php";
	?>

	<div class="mobile_col_wrap">
		<div class="content_wrap">  

			<div class="main_content_left">

				<!-- main_calendar-->
				<div class="calendar_wrap">
					<?
						include '../timechk/calendar.php';
					?>
				</div>
				<!-- //main_calendar-->   

				<!--즐겨찾기 사이트 -->
				<?
					include 'sitesbox.php';
				?>

				<!--//대표번호 -->
				<?
					include 'phonebox.php';
				?>

			</div>
			
			<div class="main_content_mid">
					<!--//모바일용 profile 화면 -->
					<div class="m_profile_wrap">
						<!--profile_wrap -->
						<div class="profile_box">
							<div class="profile_wrap">
								<div class="profile_img" style="background-images: url('')"></div>
								<div class="profile_info_wrap">
									<?
										$sql = "select * from wo_member where userid='$GBL_USERID'";
										$result = mysql_query($sql);
										$row = mysql_fetch_array($result);

										$name = $row['name'];	//이름
										$team = $row['team'];	//팀
										$affil = $row['affil'];	//직급
									?>
									<div class="profile_info">
										<p><?=$name?></p>
										<div class="m_pro_flex">
											<p><?=$affil?> / <?=$team?></p>
											<p>사번</p>
										</div>
									</div>
								</div>
							</div>
							<div class="dayoff_wrap">
								<?
									include 'userDayOff.php';
								?>
							</div>
							<div class="commute_wrap">
								<? if ($time_mod == 'out') { ?>
								<a style="color: #fff;" class="btn_primary02" href="javascript:time_chk('<?= $time_mod ?>');">퇴근체크
								<? } else { ?>
								<a style="color: #fff;" class="btn_primary02" href="javascript:time_chk('<?= $time_mod ?>');">출근체크
								<? } ?>
								</a>
							</div>
						</div>
						<!--//profile_wrap -->
					</div>
					<!--//모바일용 profile 화면 -->
					<!-- 업무현황-->
					<div class="work_now_wrap">
						<?
							include './job01.php';
						?>
					</div>
					<!-- //업무현황-->
					<!-- main_notice-->
					<div class="notice_wrap">
						<div class="notice_tab_wrap dp_sb dp_c">
							<ul class="notice_tab">
								<li class="active">
									<a href='./notice/up_index.php' >공지사항</a>
								</li>
								<li>
									<a href='./room/up_index.php'>산업공지</a>
								</li>
								<li>
									<a href='./qna/up_index.php'>기술관련</a>
								</li>
								<li>
									<a href='./data01/up_index.php'>자료실</a> 
								</li>
								<li>
									<a href='./edu/up_index.php'>교육관련</a> 
								</li>
							</ul>
						</div>

						<div class="table_wrap" style="position: relative;">            
							<div class="premier">
								<a class="register_btn" href="/notice/up_index.php?type=write" title="등록">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_notice.php';
								?>
							</div>

							<div class="premier" style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="등록">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_room.php';
								?>
							</div>

							<div  class="premier" style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="등록">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_qna.php';
								?>
							</div>

							<div  class="premier"  style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="등록">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_data01.php';
								?>
							</div>

							<div class="premier"  style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="등록">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_edu.php';
								?>
							</div>		
						</div>
					</div>
					<!-- //main_notice-->

			</div>

			<?
				include './rightContent.php';
			?>
			
		</div>
		<!-- // content_wrap -->


	</div>
</div>

