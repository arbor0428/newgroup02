<script language='javascript'>
function set_search(){
	form = document.form1;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_reset(){
	form = document.form1;

	form.f_mtype.selectedIndex = 0;
	form.f_status.selectedIndex = 0;

	form.f_name.value = '';
	form.f_ceo.value = '';

	form.f_staff.selectedIndex = 0;
	form.f_sname.value = '';
	form.f_ment.value = '';
	form.f_pnum.value = '';

	form.f_sy.value = '';
	form.f_sm.value = '';
	form.f_sd.value = '';
	form.f_ey.value = '';
	form.f_em.value = '';
	form.f_ed.value = '';

	form.type.value = ''
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function is_Key(){
	if(event.keyCode==13)	set_search();
}
</script>


<div class="search_container">
	<div class="search_wrap">
		<div class="search_row">
			<div class="search_th">����</div>
			<div class="search_td">
				<select name='f_mtype'>
					<option value=''>===</option>
					<option value='����' <?if($f_mtype=='����'){echo 'selected';}?>>����</option>
					<option value='���λ����' <?if($f_mtype=='���λ����'){echo 'selected';}?>>���λ����</option>
					<option value='����' <?if($f_mtype=='����'){echo 'selected';}?>>����</option>
				</select>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">����</div>
			<div class="search_td">
				<select name='f_status'>
					<option value=''>===</option>
				<?
					for($i=0; $i<count($statusArr); $i++){
						$sTxt = $statusArr[$i];
						if($sTxt == $f_status)	$chk = 'checked';
						else							$chk = '';

						echo ("<option value='$sTxt' $chk>$sTxt</option>");
					}
				?>
				</select>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">����(ȸ���)</div>
			<div class="search_td">
				<input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">��ǥ�ڸ�</div>
			<div class="search_td">
				<input type='text' name='f_ceo' style='width:75%' value='<?=$f_ceo?>' onkeypress='is_Key();'>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">�����</div>
			<div class="search_td">
				<div class="dp_f dp_c">
					<select name='f_staff'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($f_staff==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
					</select>
					<div class="dp_f dp_c">
						�����Է� : 
						<input type='text' name='f_sname' style='width:90px;' value='<?=$f_sname?>' onkeypress='is_Key();'>
					</div>
				</div>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">�̿��ǰ</div>
			<div class="search_td dp_f dp_c dp_wrap">
				<div class="dp_f dp_c">
					<input type='checkbox' name='f_service01' value='1' <?if($f_service01){echo 'checked';}?>>��ǥ��ȣ
				</div>
				<div class="dp_f dp_c">
					<input type='checkbox' name='f_service02' value='1' <?if($f_service02){echo 'checked';}?>>���070
				</div>
				<div class="dp_f dp_c">
					<input type='checkbox' name='f_service03' value='1' <?if($f_service03){echo 'checked';}?>>���ǽ���
				</div>
				<div class="dp_f dp_c">
					<input type='checkbox' name='f_service04' value='1' <?if($f_service04){echo 'checked';}?>>������CCTV
				</div>
				<div class="dp_f dp_c">
					<input type='checkbox' name='f_service05' value='1' <?if($f_service05){echo 'checked';}?>>���ѽ�
				</div>
				<div class="dp_f dp_c">
					<input type='checkbox' name='f_service06' value='1' <?if($f_service06){echo 'checked';}?>>��ȣ���ͳ�
				</div>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">�ΰ�����</div>
			<div class="search_td">
				<input type='text' name='f_ment' style='width:235px;' value='<?=$f_ment?>' onkeypress='is_Key();'>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">��ǥ��ȣ</div>
			<div class="search_td">
				<input type='text' name='f_pnum' style='width:235px;' value='<?=$f_pnum?>' onkeypress='is_Key();'> 
			</div>
		</div>
		<div class="search_row sel50" style="width: 100%;">
			<div class="search_th wid15">������</div>
			<div class="search_td">
				<?
					//��¥�� �˻� ��ũ��Ʈ
					$SearchDateForm = 'form1';
					include $_SERVER["DOCUMENT_ROOT"].'/module/SearchDate.php';
				?>
			</div>
		</div>


	</div>
</div>

<div class="serach_btn-wrap dp_f dp_c dp_cc">
	<a href="javascript:set_search();"  class="btn_primary03">�˻�</a>
	<a href="javascript:set_reset();"  class="btn_primary03">�ʱ�ȭ</a>
</div>