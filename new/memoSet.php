<div class="modal_wrap memo_set_modal">
	<div class="pop_content">
		<div class="pop_inner">
			<div class="dp_sb dp_c">
				<p class="box_tit">�޸� Ÿ��Ʋ ����</p>
				<div class="book_mark_head book_mark_head_modify">
					<span class="material-symbols-outlined modal_close">close</span>
				</div>
			</div>
			<div class="site_set_wrap">
				<div class="memo_tit_edit_tbl">
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">���� �� �̸�</div>
						<div class="row_tit dp_f dp_c dp_cc">���� �� �̸�</div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_det dp_f dp_c dp_cc">�޸�1</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" name="" id=""></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_det dp_f dp_c dp_cc">�޸�2</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" name="" id=""></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_det dp_f dp_c dp_cc">�޸�3</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" name="" id=""></div>
					</div>
				</div>

				<a class="btn_primary02" style="margin: 30px auto 10px;" onclick="">���� �ϱ�</a>
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