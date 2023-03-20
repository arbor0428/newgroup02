<?

	if($uid){

		$sql = "select * from wo_notice where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$title = $row["title"];
		$ment = $row["ment"];

	}


	if(!$name)	$name = $GBL_NAME;
	if(!$userid)	$userid = $GBL_USERID;




?>


<script language='javascript' src='/html_editor/languages/euc-kr/java.lang.js'></script>
<script language='javascript' src='/html_editor/newEditor.js'></script>

<script language='javascript'>
var _editor_url = "/html_editor";
var _contentValue = "ment";
var _contentName = "FRM";
var _i_uploaded = "";
var _m_uploaded = "";


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;	
	if(isFrmEmpty(form.name,"작성자를 입력해 주십시오"))	return;	
	form.ment.value = SubmitHTML();
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
	
	if(confirm('해당글을 삭제하시겠습니까?')){
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




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="2"></td>
				</tr>

				<tr> 
					<td width="17%" class='tab_tit30'>작성자</td>
					<td width="83%" class='tab'><input type='text' name='name' style='width:150px' value='<?=$name?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>제목</td>
					<td class='tab'><input type='text' name='title' style='width:100%' value='<?=$title?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>내용</td>
					<td class='tab'>

			<!-- html_editor -->
			<table border='0' cellpadding='1' cellspacing='1' width='100%'>

				<tr>
					<td>
					<?
						include '../../html_editor/btn_tool.php';
					?>			
					</td>
				</tr>

				<tr>
					<td>
						<table border='1' width='100%' cellspacing='0' bordercolor='#EFEFEF' bordercolordark='white' bordercolorlight='#DBDBDB'>
							<tr>
								<td>
								<iframe id='gmEditor' width='100%' height='500' scrolling='auto' border='0' frameborder='0' framespacing='0' hspace='0' marginheight='0' marginwidth='0' vspace='0'></iframe>
								<textarea cols=0 rows=0 style='display:none;' wrap='physical' name='ment'><?=$ment?></textarea>
								<input type='hidden' name='editor_url' id='editor_url' value='/html_editor'>
								<input type='hidden' name='editor_stom' id='editor_stom' value='euc-kr'>
								<script language='javascript' src='/html_editor/gmEditor.js'></script>
								</td>
							</td>
						</table>
					</td>
				</tr>
			</table>
			<!-- html_editor -->

					</td>
				</tr>


			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>


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
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>
					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>






</form>

