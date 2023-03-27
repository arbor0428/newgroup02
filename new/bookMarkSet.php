<?
	$userid = $_SESSION['ses_id'];
	$sql = "select * from book_mark where userid = '$userid' ";
	$result = mysql_query($sql);
	//$num = mysql_num_rows($result);
	
	$row = mysql_fetch_array($result);
	
	$bookmark01= $row['book_mark01'];	
	$bookmark02= $row['book_mark02'];	
	$bookmark03= $row['book_mark03'];	
	$bookmark04= $row['book_mark04'];	
	$bookmark05= $row['book_mark05'];	
	$bookmark06= $row['book_mark06'];	
	$bookmark07= $row['book_mark07'];	
	$bookmark08= $row['book_mark08'];	


?>
<form name="frm"  method='POST'>
	<input type="hidden" name='userid' value="<?=$_SESSION['ses_id']?>"/>
	<input type="hidden" name='bookmark01' id="bookmark01" value="<?=$bookmark01?>"/>
	<input type="hidden" name='bookmark02' id="bookmark02" value="<?=$bookmark02?>"/>
	<input type="hidden" name='bookmark03' id="bookmark03" value="<?=$bookmark03?>"/>
	<input type="hidden" name='bookmark04' id="bookmark04" value="<?=$bookmark04?>"/>

	<input type="hidden" name='bookmark05' id="bookmark05" value="<?=$bookmark05?>"/>
	<input type="hidden" name='bookmark06' id="bookmark06" value="<?=$bookmark06?>"/>
	<input type="hidden" name='bookmark07' id="bookmark07" value="<?=$bookmark07?>"/>
	<input type="hidden" name='bookmark08' id="bookmark08" value="<?=$bookmark08?>"/>

	<div class="modal_wrap book_mark_modal">
		<div class="pop_content">
			<div class="pop_inner">
			<div class="dp_sb dp_c">
				<p class="box_tit">BOOK MARK</p>
				<div class="book_mark_head book_mark_head_modify">
					<span class="material-symbols-outlined modal_close">close</span>
				</div>
			</div>
				
				<div class="book_mark_wrap">
					<?
		
					foreach($menu as $key => $value){							
						if($value == $bookmark01 || $value == $bookmark02 || $value == $bookmark03 || $value == $bookmark04 || $value == $bookmark05 || $value == $bookmark06 || $value == $bookmark07 || $value == $bookmark08){
						?>							
						<div class='book_mark_box pop select'> <?=$key?> <input type='hidden' value=<?=$value?> /></div>					
						<?
							}else {
						?>
							<div class='book_mark_box pop'> <?=$key?> <input type='hidden' value=<?=$value?> /></div>					
						<?}?>
						





					<?
					}
					?>
					
				</div>
				<a href="javascript:chkBookMark();" class="btn_primary02" style="margin: 30px auto 10px;">»Æ¿Œ</a>
			</div>			
		</div>	
	</div>
</form>

<script>
		$('.book_mark_setting').click(function(event) {
			$('.book_mark_modal').fadeIn();
			$("html, body").addClass("not_scroll");
		});
		$('.book_mark_modal .modal_close').click(function(event) {
			$('.book_mark_modal').fadeOut();
			$("html, body").removeClass("not_scroll");
		})
		$('.book_mark_box').each(function () {
			$(this).click(function () {
				if($('.book_mark_box.select').length > 7){
					
					if($(this).hasClass('select')){
						$(this).removeClass('select');						
					}
				}else {
					if($(this).hasClass('select')){
						$(this).removeClass('select');
					}else {
						$(this).addClass('select');
					}
				}
				
			});
		});

	function chkBookMark() {
		const frm = document.frm;
		let bookmark01 =$('#bookmark01');
		let bookmark02 =$('#bookmark02');
		let bookmark03 =$('#bookmark03');
		let bookmark04 =$('#bookmark04');

		let bookmark05 =$('#bookmark05');
		let bookmark06 =$('#bookmark06');
		let bookmark07 =$('#bookmark07');
		let bookmark08 =$('#bookmark08');

		let arrMenu = [];
		$('.book_mark_box.select').each(function () {
			var wht =$(this).children('input').val();
			arrMenu.push(wht);
		});
	
		bookmark01.attr('value', arrMenu[0]);
		bookmark02.attr('value', arrMenu[1]);
		bookmark03.attr('value', arrMenu[2]);
		bookmark04.attr('value', arrMenu[3]);

		bookmark05.attr('value', arrMenu[4]);
		bookmark06.attr('value', arrMenu[5]);
		bookmark07.attr('value', arrMenu[6]);
		bookmark08.attr('value', arrMenu[7]);


		
		frm.action = '/new/bookmark_proc.php';
		frm.submit();
	}
</script>