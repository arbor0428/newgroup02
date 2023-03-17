<div class="modal_wrap memo_set_modal">
	<div class="pop_content">
		<div class="pop_inner">
			<div class="dp_sb dp_c">
				<p class="box_tit">메모 추가 및 삭제</p>
				<div class="book_mark_head book_mark_head_modify">
					<span class="material-symbols-outlined modal_close">close</span>
				</div>
			</div>
			<div class="site_set_wrap">
				
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