	<div class="book_mark_container">
		<div class="quick_bookmark">
			<p class="box_tit">BOOK MARK</p>
			<span class="material-symbols-outlined book_mark_setting" style="cursor:pointer;">settings</span>
		</div>
		<div class="mobile_scroll">
	 <div class="book_mark_wrap">
		<?
			$menu = array(
				"<img src='/new/images/book14.png'><p>������û</p>" => 'job/up_index.php?type=write', 
				"<img src='/new/images/book01.png'><p>������Ȳ</p>" => 'job/index.php', 
				"<img src='/new/images/book02.png'><p>������Ȳ</p>" =>'timechk/up_index.php',
				"<img src='/new/images/book03.png'><p>��������</p>" =>'daylog/up_index.php',
				"<img src='/new/images/book04.png'><p>�λ����</p>" =>'member/up_index.php',	

				"<img src='/new/images/book05.png'><p>������Ȳ</p>" =>'ing01/up_index.php',
				"<img src='/new/images/book06.png'><p>��������</p>" =>'ing02/up_index.php',
				"<img src='/new/images/book07.png'><p>����û��</p>" =>'ing02/up_index02.php',
				"<img src='/new/images/book08.png'><p>�κ�����</p>" =>'ing02/up_index.php?f_status=�κ�����',
				"<img src='/new/images/book09.png'><p>�ŷ�ó����</p>" =>'bus01/up_index.php',
				"<img src='/new/images/book10.png'><p>�����ü</p>" =>'bus02/up_index.php',
				"<img src='/new/images/book11.png'><p>�������</p>" =>'searchad/up_index.php',
				"<img src='/new/images/book12.png'><p>LGU</p>" =>'lgu/up_index.php',

				"<img src='/new/images/book13.png'><p>���ڰ���</p>" =>'approval/up_index.php',
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
			<p style="width: 100%; text-align: center;">���ã�⸦ ����� ������!</p>
		<?}?>
		</div>
		</div>
	</div>
			
		<?
			include 'bookMarkSet.php';
		?>
