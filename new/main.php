<?
	$n_url = "./";

	include "./header.php";

    $mainTitle =  'Ȩ';


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

				<!--���ã�� ����Ʈ -->
				<?
					include 'sitesbox.php';
				?>

				<!--//��ǥ��ȣ -->
				<?
					include 'phonebox.php';
				?>

			</div>

					
			<div class="main_content_mid">
					<!--//����Ͽ� profile ȭ�� -->
					<div class="search_box m_search_box">
						<input type="text" placeholder="Search...">
						<button type="button" onclick="">
							<span class="material-symbols-outlined">
							search
							</span>
						</button>
					</div>
					<div class="m_profile_wrap">
						<?

							include 'profile.php';
						?>
					</div>
					<!--//����Ͽ� profile ȭ�� -->
					
					<!-- ������Ȳ-->
					<div class="work_now_wrap">
						<?
							include './job01.php';
						?>
					</div>
					<!-- //������Ȳ-->
					<!-- main_notice-->
					<div class="notice_wrap">
						<div class="notice_tab_wrap dp_sb dp_c">
							<ul class="notice_tab">
								<li class="active">
									<a href='./notice/up_index.php' >��������</a>
								</li>
								<li>
									<a href='./room/up_index.php'>�������</a>
								</li>
								<li>
									<a href='./qna/up_index.php'>�������</a>
								</li>
								<li>
									<a href='./data01/up_index.php'>�ڷ��</a> 
								</li>
								<li>
									<a href='./edu/up_index.php'>��������</a> 
								</li>
							</ul>
						</div>

						<div class="table_wrap" style="position: relative;">            
							<div class="premier">
								<a class="register_btn" href="/notice/up_index.php?type=write" title="���">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_notice.php';
								?>
							</div>

							<div class="premier" style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="���">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_room.php';
								?>
							</div>

							<div  class="premier" style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="���">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_qna.php';
								?>
							</div>

							<div  class="premier"  style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="���">
									<span class="material-symbols-outlined">
									add
									</span>
								</a>
								<?
									include './main_data01.php';
								?>
							</div>

							<div class="premier"  style="display: none;">
								<a class="register_btn" href="/notice/up_index.php?type=write" style="margin-right: 20px;" title="���">
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

