<?

	if($uid){

		$sql = "select * from wo_searchad where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = $row['name'];
		$phone01 = $row['phone01'];
		$phone02 = $row['phone02'];
		$phone03 = $row['phone03'];
		$email = $row['email'];
		$homepage = $row["homepage"];
		$naverID = $row['naverID'];
		$naverPW = $row['naverPW'];
		$daumID = $row['daumID'];
		$daumPW = $row['daumPW'];
		$manager = $row['manager'];
		$staff = $row['staff'];
		$ment = $row['ment'];	
		$rDate = $row['rDate'];

	}else{
		$rDate = date('Y-m-d');
	}


	if(!$userid)	$userid = $GBL_USERID;
?>

<style type='text/css'>
input::-webkit-input-placeholder { font-size: 12px;color:#ccc; }
input::-moz-placeholder { font-size: 12px;color:#ccc; }
input:-ms-input-placeholder { font-size: 12px;color:#ccc; }
input:-moz-placeholder { font-size: 12px;color:#ccc; }
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>

function check_form(){
	form = document.FRM;
	
	if(isFrmEmpty(form.name,"고객명 입력해 주십시오"))	return;	

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = 'proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('해당 데이터를 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_site' value='<?=$f_site?>'>
<input type='hidden' name='f_naverID' value='<?=$f_naverID?>'>
<input type='hidden' name='f_daumID' value='<?=$f_daumID?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>
<!-- /검색관련 -->


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">고객명(회사명)</th>
		<td width="83%"><input type='text' name='name' style='width:180px;' value='<?=$name?>'></td>
	</tr>

	<tr> 
		<th>연락처</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='phone01' style='width:50px;' value='<?=$phone01?>' maxlength='4'> - <input type='text' name='phone02' style='width:50px;' value='<?=$phone02?>' maxlength='4'>- <input type='text' name='phone03' style='width:50px;' value='<?=$phone03?>' maxlength='4'></td>
					<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.phone01.value,FRM.phone02.value,FRM.phone03.value);"><img src='../img/ico_phone.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>이메일</th>
		<td><input type='text' name='email' style='width:180px;' value='<?=$email?>'></td>
	</tr>

	<tr> 
		<th>홈페이지</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='homepage' style='width:180px;' value="<?=$homepage?>"></td>
		<?
			if($homepage){
				$link_domain = str_replace('http://','',$homepage);
		?>
					<td style='padding-left:10px;'><a href='http://<?=$link_domain?>' target='_blank'><img src='../img/ico_home.gif' valign='bottom'></a></td>
		<?
			}
		?>
				</tr>
			</table>
		</td>
	</tr>

	<tr> 
		<th>네이버</th>
		<td>
			<input type='text' name='naverID' style='width:180px;' value='<?=$naverID?>' placeholder='아이디'> / 
			<input type='text' name='naverPW' style='width:180px;' value='<?=$naverPW?>' placeholder='비밀번호'>
		</td>
	</tr>

	<tr> 
		<th>다음</th>
		<td>
			<input type='text' name='daumID' style='width:180px;' value='<?=$daumID?>' placeholder='아이디'> / 
			<input type='text' name='daumPW' style='width:180px;' value='<?=$daumPW?>' placeholder='비밀번호'>
		</td>
	</tr>

	<tr>
		<th>담당자</th>
		<td><input type='text' name='manager' style='width:180px;' value='<?=$manager?>'></td>
	</tr>

	<tr>
		<th>아이웹 담당자</th>
		<td>
			<select name='staff'>
				<option value=''>===</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_member[$i]?>' <?if($staff==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>	
		</td>
	</tr>

	<tr> 
		<th>등록일자</th>
		<td><input type='text' name='rDate' id='fpicker1' style='width:100px;' value='<?=$rDate?>'></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style='padding:3px 0px 0px 0px;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
	</tr>

	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>				

					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>&nbsp;

					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>






</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>