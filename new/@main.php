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
	$('.notice_tab li').hover(function () {
		for( let i = 1 ; i<=5 ; i ++) {
			if(	$('#premier'+i).css('display') == 'block') {
				$('.notice_tab li:nth-child('+i+')').addClass('active');
			}else{
				$(this).siblings().removeClass('active');
			}
		}

	});
});
</script>

				 
				
				
<div class="main">


  <div class="content_wrap">  
		<div class="main_content_left">

			<!-- main_calendar-->
			<div class="calendar_wrap">
				<?
					include '../timechk/calendar.php';
				?>
			</div>
			<!-- //main_calendar-->   

			<!--주차 -->
			<div class="parking_wrap">
				<a class="parking_link" href="https://parking.sba.seoul.kr" target='_blank'>주차확인 사이트
					<span class="material-symbols-outlined">open_in_new</span>
				</a>

				<div><span>ID : 아이웹 </span> <span>PWD : 2327</span></div>
			</div>
			<!--//주차 -->


	
		</div>
		
		<div class="main_content_mid">
				<!-- 업무현황-->
				<div class="work_now_wrap">
					<?
						include 'job01.php';
					?>
				</div>
				<!-- //업무현황-->
				<!-- main_notice-->
				<div class="notice_wrap">
					<div class="notice_tab_wrap">
						<ul class="notice_tab">
							<li>
									<a href='./notice/up_index.php' class='' onmouseover='premier(1);'>공지사항</a>
							</li>
							<li>
								<a href='./room/up_index.php' class='' onmouseover='premier(2);'>산업공지</a>
							</li>
							<li>
								<a href='./qna/up_index.php' class='' onmouseover='premier(3);'>기술관련</a>
							</li>
							<li>
								<a href='./data01/up_index.php' class='' onmouseover='premier(4);'>자료실</a> 
							</li>
							<li>
								<a href='./edu/up_index.php' class='' onmouseover='premier(5);'>교육관련</a> 
							</li>
						</ul>
					</div>

					<div class="table_wrap">            
						<div id='premier1'>
							<?
								include './main_notice.php';
							?>
						</div>

						<div id='premier2' style="display: none;">
							<?
								include './main_room.php';
							?>
						</div>

						<div id='premier3'  style="display: none;">
							<?
								include './main_qna.php';
							?>
						</div>

						<div id='premier4'  style="display: none;">
							<?
								include './main_data01.php';
							?>
						</div>

						<div id='premier5'  style="display: none;">
							<?
								include './main_edu.php';
							?>
						</div>		
					</div>
				</div>
				<!-- //main_notice-->

		</div>
		<div class="main_content_right_wrap" style="width: 320px;">
			 <div class="main_content_right">
			 <!-- book_mark_container-->
				<div class="book_mark_container">
					<div class="quick_bookmark">
						<p class="box_tit">BOOK MARK</p>
						<span class="material-symbols-outlined book_mark_setting">settings</span>
					</div>
					
				 <div class="book_mark_wrap">
					<?
					/*
						$menu = array(
							"<img src='/new/images/book01.png'><p>업무요청</p>" => 'job/up_index.php?type=write', 
							"<img src='/new/images/book01.png'><p>업무현황</p>" => 'job/index.php', 
							"<img src='/new/images/book02.png'><p>근태현황</p>" =>'timechk/up_index.php',
							"<img src='/new/images/book03.png'><p>업무일지</p>" =>'daylog/up_index.php',
							"<img src='/new/images/book04.png'><p>인사관리</p>" =>'member/up_index.php',	

							"<img src='/new/images/book05.png'><p>영업현황</p>" =>'ing01/up_index.php',
							"<img src='/new/images/book06.png'><p>에이전시</p>" =>'ing02/up_index.php',
							"<img src='/new/images/book07.png'><p>결재청구</p>" =>'ing02/up_index02.php',
							"<img src='/new/images/book08.png'><p>부분제작</p>" =>'ing02/up_index.php?f_status=부분제작',
							"<img src='/new/images/book09.png'><p>거래처관리</p>" =>'bus01/up_index.php',
							"<img src='/new/images/book10.png'><p>참고업체</p>" =>'bus02/up_index.php',
							"<img src='/new/images/book11.png'><p>광고관리</p>" =>'searchad/up_index.php',
							"<img src='/new/images/book12.png'><p>LGU</p>" =>'lgu/up_index.php',

							"<img src='/new/images/book13.png'><p>전자결재</p>" =>'approval/up_index.php',
						);
						*/
						
						
						$sql = "select * from book_mark where userid = '$GBL_USERID' ";
						$result = mysql_query($sql);
						$num = mysql_num_rows($result);

						if($num) {
							for($i=0; $i<$num; $i++){
								$row = mysql_fetch_array($result);
								$bookmark01 = $row['book_mark01'];
								$bookmark02 = $row['book_mark02'];
								$bookmark03 = $row['book_mark03'];
								$bookmark04 = $row['book_mark04'];
								$bookmark05 = $row['book_mark05'];
								$bookmark06 = $row['book_mark06'];
								$bookmark07 = $row['book_mark07'];
								$bookmark08 = $row['book_mark08'];


							
					?>
					<a href="/<?=$bookmark01?>" class="book_mark_box"><?echo array_search($bookmark01, $menu);?></a>
					<a href="/<?=$bookmark02?>" class="book_mark_box"><?echo array_search($bookmark02, $menu);?></a>
					<a href="/<?=$bookmark03?>" class="book_mark_box"><?echo array_search($bookmark03, $menu);?></a>
					<a href="/<?=$bookmark04?>" class="book_mark_box"><?echo array_search($bookmark04, $menu);?></a>
					<a href="/<?=$bookmark05?>" class="book_mark_box"><?echo array_search($bookmark05, $menu);?></a>
					<a href="/<?=$bookmark06?>" class="book_mark_box"><?echo array_search($bookmark06, $menu);?></a>
					<a href="/<?=$bookmark07?>" class="book_mark_box"><?echo array_search($bookmark07, $menu);?></a>
					<a href="/<?=$bookmark08?>" class="book_mark_box"><?echo array_search($bookmark08, $menu);?></a>
					<?
							}	
						}else{
					?>
						<p style="width: 100%; text-align: center;">즐겨찾기를 등록해 보세요!</p>
					<?}?>
					</div>
				</div>
						
					<?
						include 'bookMarkSet.php';
					?>

				<!--//book_mark_container -->
					<?
						include 'memo.php';
					?>
					<?
						include 'quick.php'
					?>
			 </div>
			 <!-- // main_content_right -->
		</div>
		
  </div>
	<!-- // content_wrap -->


</div>

