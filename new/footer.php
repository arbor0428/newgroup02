<!-- 알림 메세지 -->
<a id="GblNotice_open" class="GblNotice_open"></a>

<div id="GblNotice" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali" id="alertCloseBtn"><button class="GblNotice_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="http://i-web.kr/skins/program_gbl/sms/img/ico_notice.gif"></div><div class="pop_ttl0">알림</div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it"><span id="alertTxt" class="txt_bold"></span></div>
		<div class="btn_ali_pop2" id="alertBtn"><input type="button" class="btn_notice_reg GblNotice_close" value="확인" /></div>
	</div>
</div>

<!-- confirm창 -->
<a id="conFirm_open" class="conFirm_open"></a>
<div id="conFirm" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali"><button class="conFirm_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="http://i-web.kr/skins/program_gbl/sms/img/ico_notice.gif"></div><div class="pop_ttl0">확인</div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it"><span id="confirmTxt" class="txt_bold"></span></div>
		<a class="conFirm_close" href="#">
			<div class="btn2_wrap">
				<div class="btn_ali_pop3"><input type="button" class="btn_notice_reg_cancel" value="취소" /></div>
				<div class="btn_ali_pop3" id="confirmBtn"><input type="button" class="btn_notice_reg_add" value="확인"></div>
			</div>
		</a>
	</div>
</div>

<!-- 멀티팝업 -->
<a id="multiBox_open" class="multiBox_open"></a>
<div id="multiBox" class="popup_background" style="min-width:250px;display:none;">
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="http://i-web.kr/skins/program_gbl/sms/img/ico_notice.gif"></div><div class="pop_ttl0" id='multi_ttl'>팝업제목</div><div class="cls_buttonali2"><button class="multiBox_close close_button_pop"></button></div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it">
			<div id='multiFrame' style="background:#fff;overflow:hidden;position:relative;"></div>
		</div>
	</div>
</div>

<!-- pg팝업 -->
<a id="pgBox_open" class="pgBox_open"></a>
<a id="pgBox_close" class="pgBox_close"></a>
<div id="pgBox" class="popup_background" style="min-width:250px;display:none;">
	<div class="popup_notice">
		<div class="write_it">
			<div id='pgFrame' style="background:#fff;overflow:hidden;position:relative;"></div>
		</div>
	</div>
</div>



<script>
$(document).ready(function() {
	//팝업 스크립트
	$('#GblNotice,#conFirm,#multiBox,#pgBox').popup({
		transition: 'all 0.3s',
		blur: false,
		escape:false,
		scrolllock: false
	});
});
</script>



<iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>

	</body>
</html>