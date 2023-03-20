<div class="modal_wrap memo_set_modal">
	<div class="pop_content">
		<div class="pop_inner">
			<div class="dp_sb dp_c">
				<p class="box_tit">메모 타이틀 수정</p>
				<div class="book_mark_head book_mark_head_modify">
					<span class="material-symbols-outlined modal_close">close</span>
				</div>
			</div>
			<div class="site_set_wrap">
				<div class="memo_tit_edit_tbl">
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">변경 전 이름</div>
						<div class="row_tit dp_f dp_c dp_cc">변경 후 이름</div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_det dp_f dp_c dp_cc">메모1</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" name="" id=""></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_det dp_f dp_c dp_cc">메모2</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" name="" id=""></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_det dp_f dp_c dp_cc">메모3</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" name="" id=""></div>
					</div>
				</div>

				<a class="btn_primary02" style="margin: 30px auto 10px;" onclick="">변경 하기</a>
			</div>
		</div>
	</div>
</div>

<script>
		$(".memo_mark_setting").click(function(event) {
			$('.memo_set_modal').fadeIn();
			 $("html, body").addClass("not_scroll");
		});
		$(".memo_set_modal .modal_close").click(function(event) {
			$('.memo_set_modal').fadeOut();
			 $("html, body").removeClass("not_scroll");
		});

</script>