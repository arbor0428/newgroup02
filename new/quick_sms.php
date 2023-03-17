<?
	include '../module/class/class.DbCon.php';
	$sql = "select * from wo_setup order by uid desc limit 1";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);

		$phone = $row["phone"];
		$fax = $row["fax"];
		$bank01 = $row["bank01"];
		$actxt01 = $row["actxt01"];
		$account01 = $row["account01"];
		$bank02 = $row["bank02"];
		$actxt02 = $row["actxt02"];
		$account02 = $row["account02"];

		if($bank01)	 $bimg01 = $bankimg_list[$bank01];
		if($bank02)	 $bimg02 = $bankimg_list[$bank02];
	}


	unset($dbconn);
	mysql_close();



	include "./module/class/class.DbConSms.php";

	//남은 sms전송건수 계산하기
	$total_sms = '13403';

	$ndate = date('Ym');

	//이번달 사용건수
	$table = 'em_log_'.$ndate;

	//테이블 생성확인
	if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'",$dbconn))==1){
		$sql = "select count(*) from $table";
		$result = mysql_query($sql);
		$ntot = mysql_result($result,0,0);
	}


	//총계테이블에서 이번달 사용건수를 확인한다.
	$sql = "select * from em_total where em_date='$ndate'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){	//이번달 사용정보가 있는 경우 새로운 데이터로 업데이트...
		$sql = "update em_total set tot='$ntot' where em_date='$ndate'";
		$result = mysql_query($sql);

	}else{	//이번달 사용정보가 없는 경우 총계테이블에 추가한다....
		$sql = "insert into em_total (em_date,tot) values ('$ndate','$ntot')";
		$result = mysql_query($sql);
	}



	//총사용건수를 가져온다.
	$sql = "select sum(tot) from em_total";
	$result = mysql_query($sql);
	$utot = mysql_result($result,0,0);

	


	$smsnum = $total_sms - $utot;





?>
<script language="javascript" src="/module/js/common.js" type="text/JavaScript"></script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

<script language='javascript'>
function cutMsg(str){
     var ret='';
   var i;
   var msglen=0;

   for(i=0;i<str.length;i++){
         var ch=str.charAt(i);

      if(escape(ch).length >4){
      msglen += 2;
      }else{
      msglen++;
      }
            if(msglen > 80) break;
      ret += ch;
   }
   return ret;
 }

 function reCount(str){
  var i;
  var msglen=0;
 
  for(i=0;i<str.length;i++){
      var ch=str.charAt(i);
 
   if(escape(ch).length >4){
       msglen += 2;
   }else{
    msglen++;
   }
   }
      return msglen;
 }

function byteCheck(){
  var FormInput=document.frm_sms;
  var text = FormInput.msg.value;
  var msglen=0;
 
  msglen = reCount(text);
  document.getElementById("bytenum").innerText = msglen+'/500Byte';
          
  if(msglen > 500){
	  rem = msglen - 500;
	  alert('입력하신 문장의 총길이는 ' + msglen + '바이트입니다.\n초과되는 ' + rem + '바이트는 삭제됩니다.');
	  document.getElementById("bytenum").innerText = msglen-rem+'/500Byte';
	  FormInput.msg.value = cutMsg(text);

  }

}

function onlyNumber(){
	event.returnValue=false;

	if (event.keyCode == 8) event.returnValue=true;             // 백스페이스일 경우 허가
    
    if(event.keyCode >= 48 && event.keyCode <= 57){
		event.returnValue=true;
	}else{
		alert("숫자만 입력 가능합니다");
		event.returnValue=false;
	}
}

function check_msg(){
	form = document.frm_sms;

	smsbody = form.msg.value;

	if(isFrmEmpty(form.msg,"문자내용을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.callback01,"연락처를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.callback02,"연락처를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.callback03,"연락처를 입력해 주십시오"))	return;

	var notEucKR = notEucKR_Check(smsbody);	// 문자내용중 철자틀린글자 확인
	var msgAlert = '다음 사항을 확인하세요!\n\n';

	if(notEucKR != null){
		msgAlert += '+ 사용불가능한 문자가 포함되어 있습니다: '+ notEucKR +'\n\n';
		alert(msgAlert);

	}else{
		form.action = 'quick_sms_proc.php';
		form.submit();

	}
}


function getNum(c01,c02,c03){
	form = document.frm_sms;
	form.callback01.value = c01;
	form.callback02.value = c02;
	form.callback03.value = c03;

	form.msg.focus();
}

function msg_set(id){
	var idxs = document.getElementsByName("clip[]");
	msg = idxs[id].value;

	form = document.frm_sms;
	form.msg.value = msg;
	form.callback01.focus();

	byteCheck();
}
</script>


<style type='text/css'>
* {    font-family: "Noto Sans KR", "Roboto", sans-serif !important;}

/*sms*/
.sms_wrap {
  width: 100%;
  background-color: #fff;
	padding: 20px 15px;
	box-sizing: border-box;
	border-radius: 4px;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
  overflow: hidden;
}
.sms_content {
	position: relative;
	margin: 10px 0 0 0;
	width: 100%;
	height: 135px; 
	box-sizing:border-box;
	background-color: #e0eaff;
}
.sms_content textarea {
	width: 100%;
	height: 105px; 
	border: none;
	background-color: transparent;
	border-radius: 4px;
	resize: none;
}

#bytenum {
	position: absolute;
	right: 5px;
	bottom: 5px;
	font-size:11px;
}
.link01 {
	position: absolute;
	left: 5px;
	bottom: 5px;
	padding: 2px 10px;
	border-radius: 4px;
	font-size:11px;
	background-color:#003081 ;
	color: #fff !important;
	font-weight: 400;
}
.sms_head {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.box_tit {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}
.phone_input_wrap {
	margin: 10px 0;
	display: flex;
    align-items: center;
}
.phone_input_wrap .to_phone {
	width: 20%;
	font-size: 0.875rem;
	color: #333;
}
.phone_input_box {
	width: 80%; 
	display: flex; 
	align-items: center;  
	gap:5px;
}
.m_send {
    display: flex;
	justify-content: center;
	align-items: center;
    width: 100%;
    line-height: 40px;
    color: #003081 !important;
    border: 1px solid #ddd;
    text-align: center;
    font-weight: 600;
    box-sizing: border-box;
	border-radius: 0 0 4px 4px;
    padding-bottom: 3px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
}
.m_send .material-symbols-outlined {
	margin-right: 5px;
}
  .m_send:hover {
    border: 1px solid #49597a;
	color: #fff !important;
	background-color: #49597a;
  }
    .m_send:hover .m_send .material-symbols-outlined {
		color:#fff !important;
	}

@media (max-width:1400px){
	.phone_input_wrap .to_phone {
		font-size: 0.75rem;
	}
}
</style>


<form name='frm_sms' method='post'>
	<input type='hidden' name='userid' value='<?=$userid?>'>
	<input type="hidden" id="clip[]" name="clip[]" value='<?=$actxt01?>(<?=$bank01?>) <?=$account01?>'>
	<input type="hidden" id="clip[]" name="clip[]" value='국민은행(김상현) 011202-04-196286'>

	<div class="sms_wrap">
		<div style="margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
			<p class="box_tit">문자보내기</p>
			<input type='text' name='callback' style='ime-mode:disabled; border:none; border-radius: 4px; width: 50%; text-align: right; font-weight: 700; color:#333;' value='1661-2327'>
		</div>


		<div class="sms_content">
			<textarea name="msg" onKeyDown='javascript:byteCheck();' onKeyup='javascript:byteCheck();'></textarea>
			<a href="javascript:msg_set(0);" class='link01'>법인계좌 넣기</a>
			<div colspan='2' align='center' id='bytenum' height='14'>0/500Byte</div>
		</div>
		<div class="sms_footer">
			<div class="phone_input_wrap">
				<span class="to_phone">받는이 : </span>
				<div class="phone_input_box">
					<input type='text' name='callback01' style='width:28%; ime-mode:disabled; border-radius: 4px; border:1px solid #ddd; padding: 5px;' onkeypress='onlyNumber();' onKeyUp="return autoTab(this, 3, event);" maxlength='3'>
					<span>-</span>
					<input type='text' name='callback02' style='width: 28%; padding: 5px; border-radius: 4px;ime-mode:disabled;border:1px solid #ddd;' onkeypress='onlyNumber();' onKeyUp="return autoTab(this, 4, event);" maxlength='4'>
					<span>-</span>
					<input type='text' name='callback03' style='width: 28%; padding: 5px; border-radius: 4px;ime-mode:disabled;border:1px solid #ddd;' onkeypress='onlyNumber();' maxlength='4'>
				</div>
			</div>
		</div>

		<a href="javascript:check_msg();" class="m_send" ><span class="material-symbols-outlined">outgoing_mail</span>전송</a>
		
	</div>

<!-- <a href="javascript:msg_set(1);" class='link01'>.</a> -->
		

</form>
