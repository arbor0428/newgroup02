<?
	$userid = $_SESSION['ses_id'];
	$sql = "select * from main_phone where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

?>
<form name="frm02"  id="frm02" method='POST'>
	<input type="hidden" name='userid' value="<?=$_SESSION['ses_id']?>"/>
	<input type="hidden" name='type' value="<?=$type?>"/>
	<input type="hidden" name='uid' value="<?=$uid?>"/>

	<div class="modal_wrap num_set_modal">
		<div class="pop_content">
			<div class="pop_inner">
				<div class="dp_sb dp_c">
					<p class="box_tit">대표번호</p>
					<div class="book_mark_head book_mark_head_modify">
						<span class="material-symbols-outlined modal_close">close</span>
					</div>
				</div>
				<div class="num_set_wrap">
					<div class="list_tbl">
						<div class="row dp_f dp_c">
							<div class="row_tit dp_f dp_c dp_cc">번호 이름</div>
							<div class="row_tit dp_f dp_c dp_cc">번호</div>
						</div>

						<?
						while($row = mysql_fetch_array($result)){
								$uid = $row['uid'];
								$phoneName= $row['phoneName'];	
								$phoneNum= $row['phoneNum'];	

						?>
						<div class="row dp_f dp_c">
							<div class="row_det dp_f dp_c dp_cc">
								<?=$phoneName?>
							</div>
							<div class="row_det dp_f dp_c dp_cc">
								<?=$phoneNum?>
							</div>
							<a class="row_delete" href="javascript:reg_del02(<?=$uid?>)" title="삭제">
								<span class="material-symbols-outlined">
								close
								</span>
							</a>
						</div>

						<?
							}
						?>
					</div>

					<p class="pop_sub_tit">추가하기</p>
					<div class="write_tbl">
						<div class="row dp_f dp_c">
							<div class="row_tit dp_f dp_c dp_cc">번호 이름</div>
							<div class="row_det dp_f dp_c dp_cc"><input type="text" name="phoneName"></div>
						</div>
						<div class="row dp_f dp_c">
							<div class="row_tit dp_f dp_c dp_cc">번호</div>
							<div class="row_det dp_f dp_c dp_cc"><input type="text" name="phoneNum"></div>
						</div>
					</div>

					<a class="btn_primary02" style="margin: 30px auto 10px;" onclick="chkBookMark3();">수정 하기</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
		$(".numbers_setting").click(function(event) {
			$('.num_set_modal').fadeIn();
			$("html, body").addClass("not_scroll");
		});
		$(".num_set_modal .modal_close").click(function(event) {
			$('.num_set_modal').fadeOut();
			$("html, body").removeClass("not_scroll");
		});


		function chkBookMark3() {
			$('#frm02 [name=type]').val('write');
			$("#frm02").attr("action","./numbers_proc.php").submit();
		}

		function reg_del02(uid){

			let result = confirm('삭제하시겠습니까?');

			if(result == true){
				$('#frm02 [name=type]').val('del');
				$('#frm02 [name=uid]').val(uid);
				$("#frm02").attr("action","./numbers_proc.php").submit();
			} else {
			alert('취소');
			}
			
		}

</script>