<?

	if(!$f_state01 && !$f_state02 && !$f_state03 && !$f_state04 && !$f_state05){
		$f_state01 = '��û';
		$f_state02 = '����';
		$f_state03 = '����';
		$f_state04 = 'ó�����';
		$f_state05 = '';
	}


	$record_count = 8;  //�� �������� ��µǴ� ���ڵ��

	$link_count = 5; //�� �������� ��µǴ� ������ ��ũ��

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	$query_ment = "where uid > 0";



	if($f_search == '����')		$query_ment .= " and ((re_name='$GBL_NAME' and (state!='ó�����' and state!='�Ϸ�')) or (userid='$GBL_USERID' and state='ó�����'))";
	elseif($f_search == '��û')	$query_ment .= " and userid='$GBL_USERID'";

	if($f_project)	$query_ment .= " and project like '%$f_project%'";

	if($f_title)	$query_ment .= " and title like '%$f_title%'";

	if($f_ment)	$query_ment .= " and ment like '%$f_ment%'";

	if($f_re_name)	$query_ment .= " and re_name='$f_re_name'";

	if($f_name)	$query_ment .= " and name='$f_name'";

	$query_ment .= " and (state='$f_state01' || state='$f_state02' || state='$f_state03' || state='$f_state04' || state='$f_state05')";




	$sort_ment = "order by uid desc";

	$query = "select * from wo_job $query_ment $sort_ment";


	$result = mysql_query($query) or die("�������");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_job $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>



<script language='javascript'>

function reg_view(uid){
	form = document.form1;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_write(uid){
	form = document.form1;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_search(){
	form = document.form1;
	form.record_start.value = '';
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_reset(){
	form = document.form1;

	chk = document.getElementById('f_search');

	for(i=0; i<chk.length; i++){
		form.f_search[i].checked = false;
	}

	form.f_project.value = '';
	form.f_title.value = '';
	form.f_ment.value = '';

	form.f_re_name[0].selected = true;
	form.f_name[0].selected = true;

	form.f_state01.checked = true;
	form.f_state02.checked = true;
	form.f_state03.checked = true;
	form.f_state04.checked = false;

	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_tab(no){

	form = document.form1;

	for(i=1; i<4; i++){
		k = i - 1;
		tab = document.getElementById('tab0'+i);

		if(no == i){
			tab.style.backgroundColor='#efefef';
			form.f_search[k].checked = true;
		}else{
			tab.style.backgroundColor='#ffffff';
			form.f_search[k].checked = false;
		}
	}

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function is_Key(){
	if(event.keyCode==13)	set_search();
}

function chkEnd(){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('�Ϸ�ó���� ������ ������ �ֽʽÿ�');
		return;
	}

	form = document.form1;
	form.type.value = 'chk_end';
	form.action = 'proc.php';
	form.submit();
}
</script>



<!-- �˻� -->
<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr>
		<th>��������</th>
		<td colspan='3'>
			<input type='radio' name='f_search' value='����' <?if($f_search=='' || $f_search=='����') echo 'checked';?> onclick="set_tab('1');">���� ������Ȳ&nbsp;&nbsp;
			<input type='radio' name='f_search' value='��û' <?if($f_search=='��û') echo 'checked';?> onclick="set_tab('2');">������û�� ����&nbsp;&nbsp;
			<input type='radio' name='f_search' value='��ü' <?if($f_search=='��ü') echo 'checked';?> onclick="set_tab('3');">��ü ������Ȳ
		</td>
	</tr>
	<tr> 
		<th width="17%">������Ʈ��</th>
		<td width="33%"><input type='text' name='f_project' style='width:75%' value='<?=$f_project?>' onkeypress='is_Key();'></td>
		<th width="17%">����</th>
		<td width="33%"><input type='text' name='f_title' style='width:75%' value='<?=$f_title?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>����</th>
		<td colspan='3'><input type='text' name='f_ment' style='width:75%' value='<?=$f_ment?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>�����</th>
		<td>
			<select name='f_re_name'>
				<option value=''>===</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_member[$i]?>' <?if($f_re_name==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
		</td>
		<th>��û��</th>
		<td>
			<select name='f_name'>
				<option value=''>===</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_member[$i]?>' <?if($f_name==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
		</td>
	</tr>
	<tr> 
		<th>�������</th>
		<td colspan='3'>


			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
				<?
					$f=1;
					foreach($stateArr as $k => $v){
						$stateTxt = $k;
						$cName = $v;

						if($f == 1)	$pStyle = "";
						else			$pStyle = "style='padding:0 0 0 10px;'";

						$fTxt = 'f_state'.sprintf('%02d',$f);


				?>
					<td <?=$pStyle?>>
						<div class="squaredThree">
							<input type="checkbox" value="<?=$stateTxt?>" id="pT<?=$f?>" name="<?=$fTxt?>" <?if(${$fTxt} == $stateTxt){echo 'checked';}?>>
							<label for="pT<?=$f?>"></label>
						</div>
						<p style='margin:3px 0 0 25px;'><span class='<?=$cName?>'><?=$stateTxt?></span></p>
					</td>
				<?
						$f++;
					}
				?>
				</tr>
			</table>
		</td>
	</tr>
</table>


<!-- �˻���ư���� -->
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' colspan='4' align='center'>
			<a href="javascript:set_search();"><img src='/images/common/search.gif'></a>
			&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a>
		</td>
	</tr>
</table>





<div class="list_btn_wrap dp_c dp_sb">
	<div><a href="javascript:chkEnd();" class="small cbtn black">�Ϸ�ó��</a></div>
	<div class="work_btn_wrap dp_c dp_sb">
		<div style='padding:0 15px;cursor:pointer;border:1px solid #ccc;' align='center' id='tab01' <?if($f_search=='����'){echo "bgcolor='#efefef'";}else{echo "onclick=set_tab('1');";}?>>���� ������Ȳ</div>
		<div style='padding:0 15px;cursor:pointer;border:1px solid #ccc;' align='center' id='tab02' <?if($f_search=='��û'){echo "bgcolor='#efefef'";}else{echo "onclick=set_tab('2');";}?>>������û�� ����</div>
		<div style='padding:0 15px;cursor:pointer;border:1px solid #ccc;' align='center' id='tab03' <?if($f_search=='��ü'){echo "bgcolor='#efefef'";}else{echo "onclick=set_tab('3');";}?>>��ü ������Ȳ</div>
	</div>
</div>

<div class="work_now_wrap work_now_wrap_modify">
	<div class="tbl">
		<div class="tbl_tr tbl_tit_tr board_flex">
			<div class="tbl_th board_title" >
				<input type="checkbox" value="" id="all_chk" name="all_chk" onclick="All_chk('all_chk','chk[]');">
				<label for="all_chk"></label>
			</div>
			<div class="tbl_th board_title" >��ȣ</div>
			<div class="tbl_th board_title" >����</div>
			<div class="tbl_th board_title" >�۾�������Ʈ</div>
			<?
				if($f_search != '����'){
			?>
			<div class="tbl_th board_title" >�����</div>
			<?
					}
				?>
				<?
				if($f_search != '��û'){
				?>
				<div class="tbl_th board_title" >��û��</div>
				<?
					}
				?>
			<div class="tbl_th board_title" >�߿䵵</div>
			<div class="tbl_th board_title" >�������</div>
			<div class="tbl_th board_title" >��û����</div>
			<div class="tbl_th board_title" >�Ϸ�����</div>
		</div>



			<?
			if($total_record != '0'){
				$i = $total_record - ($current_page - 1) * $record_count;

				$line_num = 0;

				while($row = mysql_fetch_array($result)){

					$uid = $row["uid"];
					$userid = $row["userid"];
					$project = $row["project"];
					$name = $row["name"];
					$re_name = $row["re_name"];
					$status = $row["status"];
					$state = $row["state"];
					$title = $row["title"];
					$reg_date = $row["reg_date"];
					$reg_date = date('Y-m-d',$reg_date);

					$end_date = $row["end_date"];

					if($end_date)	$end_date = date('Y-m-d',$end_date);
					else	$end_date = '';


					$date_diff = Util::dateDiff($SYSTEM_DATE,$reg_date);

					if($date_diff < 3)	 $new_icon = "<img src='/images/common/new_file.gif'>";
					else	$new_icon = '';

					if($state == '��û'){
						$Color = '#de712e';

					}elseif($state == '����'){
						$Color = '#52809a';

					}elseif($state == '����'){
						$Color = '#4ead04';

					}elseif($state == 'ó�����'){
						$Color = '#af238c';
						$title = '<b>'.$title.'</b>';

					}else{
						$Color = '#777777';
						$title = '<strike>'.$title.'</strike>';
						$new_icon = '';
					}



					if($GBL_USERID == $userid)	$java_link = 'reg_write';
					else	$java_link = 'reg_view';


					
			?>

		<div class="tbl_tr board_flex">
			<div class="tbl_td">
				<input type="checkbox" value="<?=$uid?>" id="chkBox<?=$uid?>" name="chk[]">
				<label for="chkBox<?=$uid?>"></label>
			</div>
			<div class="tbl_td"onclick="<?=$java_link?>('<?=$uid?>');"><?=$i?></div>
			<div class="tbl_td ellipsis" onclick="<?=$java_link?>('<?=$uid?>');"><?=$title?> <?=$new_icon?></div>
			<div class="tbl_td m_none" onclick="<?=$java_link?>('<?=$uid?>');"><?=$project?></div>
			<?
				if($f_search != '����'){
			?>
			<div class="tbl_td"  onclick="<?=$java_link?>('<?=$uid?>');"><?=$re_name?></div>
			<?
				}
			?>
			<?
				if($f_search != '��û'){
			?>
			<div class="tbl_td m_none" onclick="<?=$java_link?>('<?=$uid?>');"><?=$name?></div>	
			<?
				}
			?>

			<div class="tbl_td m_none" onclick="<?=$java_link?>('<?=$uid?>');"><?=$status?></div>					
			<div class="tbl_td" onclick="<?=$java_link?>('<?=$uid?>');"><span class='<?=$stateArr[$state]?>'><?=$state?></span></div>
			<div class="tbl_td" onclick="<?=$java_link?>('<?=$uid?>');"><?=$reg_date?></div>
			<div class="tbl_td"  onclick="<?=$java_link?>('<?=$uid?>');"><?=$end_date?></div>
		</div>



		<?
				$line_num++;
				$i--;
			}
		}else{
		?>
			<div class='tbl_tr'>
				<div class='tbl_td' style='width: 100%; text-align: center;'>������ ������ �����ϴ�.</div>
			</div>
		<?
		}
		?>
		</div>
	</div>
</form>

<?
	$fName = 'form1';
	include '../pageNum.php';
?>