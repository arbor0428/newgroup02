	<div class="book_mark_container">
		<div class="quick_bookmark">
			<p class="box_tit">BOOK MARK</p>
			<span class="material-symbols-outlined book_mark_setting" style="cursor:pointer;">settings</span>
		</div>
		<div class="mobile_scroll">
	 <div class="book_mark_wrap">
		<?
			$menu = array(
				"<img src='/new/images/book14.png'><p>업무요청</p>" => 'job/up_index.php?type=write', 
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
	</div>
			
		<?
			include 'bookMarkSet.php';
		?>
