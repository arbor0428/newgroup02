<?

		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$phone = $row["phone"]; // ȸ�� ��ǥ��ȣ
		$fax = $row["fax"]; // ȸ�� �ѽ���ȣ
		$bank01 = $row["bank01"]; // ���ΰ��� ����
		$actxt01 = $row["actxt01"]; // ȸ���
		$account01 = $row["account01"]; // ���ΰ��¹�ȣ
		$cmp_num = $row["cmp_num"]; // ����� ��ȣ
		$cmp_adr = $row["cmp_adr"]; // ������
		$ceo_nm = $row["ceo_nm"]; // ��ǥ�̻� ����
		$i_mail = $row["i_mail"]; // �̸���
		$i_hpage = $row["i_hpage"]; // Ȩ������
		$i_ppage = $row["i_ppage"]; // ī����� ����Ʈ

		$rDate = date('Y'); // ���糯¥ ��
		$rDate2 = date('m'); // ���糯¥ ��
		$rDate3 = date('d'); // ���糯¥ ��

		if($type == 'edit' && $uid){

			$sql = "select * from wo_proof where uid='$uid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$userid = $row['userid'];

		}


/*
		if($f_userid){
			$sql = "select * from wo_member where userid='$f_userid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$name = $row["name"]; // ����
			$securi = $row["securi"]; // �ֹε�Ϲ�ȣ ���ڸ�
			$securi2 = $row["securi2"]; // �ֹε�Ϲ�ȣ ���ڸ�
			$team = $row["team"]; // �Ҽ�
			$mname = $row["mname"]; // ����
			$idate01 = $row["idate01"]; // �Ի糯¥ ��
			$idate02 = $row["idate02"]; // �Ի糯¥ ��
			$idate03 = $row["idate03"]; // �Ի糯¥ ��
			$zipcode = $row["zipcode"]; // �����ȣ
			$addr01 = $row["addr01"]; // �ּ�1
			$addr02 = $row["addr02"]; // �ּ�2
		}
*/

?>

<style type='text/css'>
	input::-webkit-input-placeholder { font-size: 12px;color:#ccc; }
	input::-moz-placeholder { font-size: 12px;color:#ccc; }
	input:-ms-input-placeholder { font-size: 12px;color:#ccc; }
	input:-moz-placeholder { font-size: 12px;color:#ccc; }

	.gTable2 input {background-color:#eee;}
	.r_date_wrap input {width:50px;}
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>

<script language='javascript'>

function check_form(){

	form = document.FRM;
	
	if(isFrmEmpty(form.userid,"������ �Է��� �ֽʽÿ�"))	return;
	if(isFrmEmpty(form.puse,"���뵵�� ������ �ֽʽÿ�"))	return;

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
	
	if(confirm('�ش� �����͸� �����Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'del';
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}
}

	//�з»���
	function optAdd(no){

		var num = parseInt($('#num').val()); //���ڸ� ���ڷ� �ٲ㼭 ���� �����´�
		num++;						

		if(num>4) {
			
			alert('5�������� �����մϴ�.');
			return false;

		}

		$('#num').val(num); // ���̵� num�� ���� �����´�.

		//�߰��� html �ҽ����� ����ִ´�
		text='<tr class = "form" id = "bill'+num+'">';
		text+='<th>��ǰ��</th>';
		text+='<td>';
		text+='<select name='prd[]'>';
		text+='<option value=''>::��ǰ����::</option>';
		text+='<option value='������'<? if($record_count=='0') echo 'selected';?>>������ Ȩ������ ����</option>';
		text+='<option value='�˶���'<? echo $prd1 =='�˶��� Ȩ������ ����' ? 'selected':''?>>�˶��� Ȩ������ ����</option>';
		text+='<option value='������'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>';
		text+='<option value='������'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>';
		text+='<option value='������'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>';
		text+='<option value='������'<? echo $prd1 =='������(Ȩ������ �ּ�) 1��' ? 'selected':''?>>������(Ȩ������ �ּ�) 1��</option>';
		text+='<option value='SSL'<? echo $prd1 =='SSL ���ȼ��� 1��' ? 'selected':''?>>SSL ���ȼ��� 1��</option>';
		text+='<option value='���ڰ���'<? echo $prd1 =='���ڰ��� ���Ժ��' ? 'selected':''?>>���ڰ��� ���Ժ��</option>';
		text+='<option value='100MB'<? echo $prd1 =='���뷮 100MB ��Ʈ���� 400MB' ? 'selected':''?>>���뷮 100MB / ��Ʈ���� 400MB</option>';
		text+='<option value='500MB'<? echo $prd1 =='���뷮 500MB ��Ʈ���� 2GB' ? 'sel ected':''?>>���뷮 500MB / ��Ʈ���� 2GB</option>';
		text+='<option value='1GB'<? echo $prd1 =='���뷮 1GB ��Ʈ���� 5GB' ? 'selected':''?>>���뷮 1GB / ��Ʈ���� 5GB</option>';
		text+='<option value='2GB'<? echo $prd1 =='���뷮 2GB ��Ʈ���� 10GB' ? 'selected':''?>>���뷮 2GB / ��Ʈ���� 10GB</option>';
		text+='<option value='3GB'<? echo $prd1 =='���뷮 3GB ��Ʈ���� 15GB' ? 'selected':''?>>���뷮 3GB / ��Ʈ���� 15GB</option>';
		text+='<option value='5GB'<? echo $prd1 =='���뷮 5GB ��Ʈ���� 25GB' ? 'selected':''?>>���뷮 5GB / ��Ʈ���� 25GB</option>';
		text+='<option value='7GB'<? echo $prd1 =='���뷮 7GB ��Ʈ���� 35GB' ? 'selected':''?>>���뷮 7GB / ��Ʈ���� 35GB</option>';
		text+='<option value='10GB'<? echo $prd1 =='���뷮 10GB ��Ʈ���� 50GB' ? 'selected':''?>>���뷮 10GB / ��Ʈ���� 50GB</option>';
		text+='<option value='20GB'<? echo $prd1 =='���뷮 20GB ��Ʈ���� ������' ? 'selected':''?>>���뷮 20GB / ��Ʈ���� ������</option>';
		text+='<option value='30GB'<? echo $prd1 =='���뷮 30GB ��Ʈ���� ������' ? 'selected':''?>>���뷮 30GB / ��Ʈ���� ������</option>';
		text+='<option value='�˶���+1P�κ�����'<? echo $prd1 =='�˶���+1P�κ�����' ? 'selected':''?>>�˶���+1P�κ�����</option>';
		text+='<option value='1P�κ�����'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>';
		text+='<option value='�ٱ���������'<? echo $prd1 =='�ٱ���������' ? 'selected':''?>>�ٱ���������</option>';
		text+='</select>';
		text+='<select name='prd1[]'>';
		text+='<option value=''>::��������::</option>';
		text+='<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>';
		text+='<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>';
		text+='<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>';
		text+='<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>';
		text+='<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>';
		text+='<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>';
		text+='<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>';
		text+='<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>';
		text+='<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>';
		text+='<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>';
		text+='<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>';
		text+='<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>';
		text+='<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>';
		text+='<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>';
		text+='<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>';
		text+='<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>';
		text+='<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>';
		text+='<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>';
		text+='<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>';
		text+='<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>';
		text+='<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>';
		text+='<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>';
		text+='<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>';
		text+='<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>';
		text+='</select>';
		text+='</td>';
		text+='<td>';
		//text+='<input type="text" name="yangta" id="yangta" value="<?=$reTotalPrice?>" class='numberOnly' onkeyup='totalPrice()'>';
		text+='</td>';
		text+='</tr>';
		
		//html�ҽ��� Ŭ���� �Ǵ� ���̵� �÷��� �÷��� �Ѵ�
		$('.f-wrap').append(text);
		
		console.log(num);
	}

function setUserID() {
	
	userid = $("#userid option:selected").val(); // userid�� select������ �ۿ�

//	$('#name').val(''); // ���� input value id�� name�� �� �����ͼ� �ʱ�ȭ ��Ű�� ���� ('') null�� ��Ƽ� ������ �ʱ�ȭ ��Ų��
	$('#securi').val(''); // �ֹε�Ϲ�ȣ ���ڸ�
	$('#securi2').val(''); // �ֹε�Ϲ�ȣ ���ڸ�
	$('#zipcode').val(''); // �����ȣ
	$('#addr01').val(''); // �ּ�1
	$('#addr02').val(''); // �ּ�2
	$('#team').val(''); // �Ҽ�
	$('#affil').val(''); // ����
	$('#idate01').val(''); // �����Ⱓ ��
	$('#idate02').val(''); // �����Ⱓ ��
	$('#idate03').val(''); // �����Ⱓ ��

	if(userid){
		$.post('./jsonUser.php',{'userid':userid}, function(req){ // json ������� �����Ͽ� ���ϰ� �ޱ�.
			
			parData = JSON.parse(req); // ���ڿ� ���� �м�, ��ü����
			
//			name = parData['name']; // name�̶�� ��ü�� ����
			securi = parData['securi'];
			securi2 = parData['securi2'];
			zipcode = parData['zipcode'];
			addr01 = parData['addr01'];
			addr02 = parData['addr02'];
			team = parData['team'];
			affil = parData['affil'];
			idate01 = parData['idate01'];
			idate02 = parData['idate02'];
			idate03 = parData['idate03'];
			pdate01 = parData['pdate01'];
			pdate02 = parData['pdate02'];
			pdate03 = parData['pdate03'];

//			$('#name').val(name); // ���� �ٽ� name�̶�� ������ ��´�.
			$('#securi').val(securi); // �ֹε�Ϲ�ȣ ���ڸ�
			$('#securi2').val(securi2); // �ֹε�Ϲ�ȣ ���ڸ�
			$('#zipcode').val(zipcode); // �����ȣ
			$('#addr01').val(addr01); // �ּ�1
			$('#addr02').val(addr02); // �ּ�2
			$('#team').val(team); // �Ҽ�
			$('#affil').val(affil); // ����
			$('#idate01').val(idate01); // �����Ⱓ ��
			$('#idate02').val(idate02); // �����Ⱓ ��
			$('#idate03').val(idate03); // �����Ⱓ ��
			$('#pdate01').val(pdate01); // �����Ⱓ ��
			$('#pdate02').val(pdate02); // �����Ⱓ ��
			$('#pdate03').val(pdate03); // �����Ⱓ ��

//			req = urldecode(req); // ������ ���ڵ� ��ü�� ����ؼ� URL�� ���ڵ��� ���ڿ��� ���ڵ��� ���ڿ��� ��ȯ �̰Ŵ� ANSI UTF8��ȯ
		});
	}
}

/*
function setUserID(){
	form = document.FRM;
	form.action = "<?=$_SERVER['PHP_SELFT']?>";
	form.submit();
}
*/
/*
//�޸��� ���� ������ ���, ������ �� ������ �ٽ� �޸��� ���̴� ��������.
	reTotal = $('#reTotal').val();
	reTotal = reTotal.replace(/,/g, '');

	tPrice = $('#tPrice').val();
	tPrice = tPrice.replace(/,/g, '');

	suPrice = $('#suPrice').val();
	suPrice = suPrice.replace(/,/g, '');

	suPrice2 = $('#suPrice2').val();
	suPrice2 = suPrice2.replace(/,/g, '');

	renPrice = $('#renPrice').val();
	renPrice = renPrice.replace(/,/g, '');

	renPrice2 = $('#renPrice2').val();
	renPrice2 = renPrice2.replace(/,/g, '');

	renPrice3 = $('#renPrice3').val();
	renPrice3 = renPrice3.replace(/,/g, '');

//���ϱ� 1�� ���� ������ ��������
	reTotalPrice = reTotal*1 - tPrice*1 - suPrice*1 - suPrice2*1 - renPrice*1 - renPrice2*1 - renPrice3*1;
	reTotalPrice = comma(uncomma(reTotalPrice))
	$('#reTotalPrice').val(reTotalPrice);

	function inputNumberFormat(obj) {
	     obj.value = comma(uncomma(obj.value));
	 }
	function comma(str) {
	   str = String(str);
	   return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
	}

	//�޸�Ǯ��
	function uncomma(str) {
	   str = String(str);
	   return str.replace(/[^\d]+/g, '');
	}

	$(function() {
	//�����Է� ��ǲ�ڽ� �������� �����ִٰ�
	$("#selboxDirect").hide();
	$("#selbox").change(function() {
		//�����Է��� ���� �� ��Ÿ��
		if($("#selbox").val() == "direct") {
			$("#selboxDirect").show();?
		}	else {
				$("#selboxDirect").hide();
			}
		})
	});
*/
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
	<input type='hidden' name='mtype' value='<?=$mtype?>'>
	<input type='hidden' name='uid' value='<?=$uid?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
	<input type='hidden' name='type' value='<?=$type?>'>

	<!-- html �߰��߰� �Ҷ� �ʿ��� hidden�� ���� num id�� �� 3 -->
	<input type='hidden' name='num' id='num' value="0">

	<!-- �˻����� -->
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

<!-- /�˻����� -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">�����</th>
		<td>
			<select name='userid' id="userid" onchange="setUserID()">
				<option value=''>::�������::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
		</td>
	</tr>    
           
	<tr class = 'form' id = "bill1">
		<th>��ǰ��1</th>
		<td class = "f-wrap">

			<!--�߰��Ǵ� select-->
			<select name='prd[]'>
				<option value=''>::��ǰ����::</option>
				<option value='������'<? if($record_count=='0') echo 'selected';?>>������ Ȩ������ ����</option>
				<option value='�˶���'<? echo $prd1 =='�˶��� Ȩ������ ����' ? 'selected':''?>>�˶��� Ȩ������ ����</option>
				<option value='������'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd1 =='������(Ȩ������ �ּ�) 1��' ? 'selected':''?>>������(Ȩ������ �ּ�) 1��</option>
				<option value='SSL'<? echo $prd1 =='SSL ���ȼ��� 1��' ? 'selected':''?>>SSL ���ȼ��� 1��</option>
				<option value='���ڰ���'<? echo $prd1 =='���ڰ��� ���Ժ��' ? 'selected':''?>>���ڰ��� ���Ժ��</option>
				<option value='100MB'<? echo $prd1 =='���뷮 100MB / ��Ʈ���� 400MB' ? 'selected':''?>>���뷮 100MB / ��Ʈ���� 400MB</option>
				<option value='500MB'<? echo $prd1 =='���뷮 500MB / ��Ʈ���� 2GB' ? 'selected':''?>>���뷮 500MB / ��Ʈ���� 2GB</option>
				<option value='1GB'<? echo $prd1 =='���뷮 1GB / ��Ʈ���� 5GB' ? 'selected':''?>>���뷮 1GB / ��Ʈ���� 5GB</option>
				<option value='2GB'<? echo $prd1 =='���뷮 2GB / ��Ʈ���� 10GB' ? 'selected':''?>>���뷮 2GB / ��Ʈ���� 10GB</option>
				<option value='3GB'<? echo $prd1 =='���뷮 3GB / ��Ʈ���� 15GB' ? 'selected':''?>>���뷮 3GB / ��Ʈ���� 15GB</option>
				<option value='5GB'<? echo $prd1 =='���뷮 5GB / ��Ʈ���� 25GB' ? 'selected':''?>>���뷮 5GB / ��Ʈ���� 25GB</option>
				<option value='7GB'<? echo $prd1 =='���뷮 7GB / ��Ʈ���� 35GB' ? 'selected':''?>>���뷮 7GB / ��Ʈ���� 35GB</option>
				<option value='10GB'<? echo $prd1 =='���뷮 10GB / ��Ʈ���� 50GB' ? 'selected':''?>>���뷮 10GB / ��Ʈ���� 50GB</option>
				<option value='20GB'<? echo $prd1 =='���뷮 20GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 20GB / ��Ʈ���� ������</option>
				<option value='30GB'<? echo $prd1 =='���뷮 30GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 30GB / ��Ʈ���� ������</option>
				<option value='�˶���+1P�κ�����'<? echo $prd1 =='�˶���+1P�κ�����' ? 'selected':''?>>�˶���+1P�κ�����</option>
				<option value='1P�κ�����'<? echo $prd1 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�ٱ���������'<? echo $prd1 =='�ٱ���������' ? 'selected':''?>>�ٱ���������</option>
				<!-- <option value="direct">�����Է�</option> -->
			</select>

			<select name='prd1[]'>
				<option value=''>::��������::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<!-- <input type = "text" value = "<? echo $record_count * $prd2 ?>"> -->
			<!-- onkeyup�� �ϰ� �Ǹ� input�� ���ڰ� �ö󰥶� �ٷ� ����� �ȴ� -->
			<!-- <input type="text" name="yangta" id="yangta" value="<?=$reTotalPrice?>" class='numberOnly' onkeyup='totalPrice()'> -->
			<a href="javascript:optAdd('<?=$uid?>')" class='small cbtn black'>+�߰�</a>
		</td>
	</tr>

	<!-- <tr>
		<th>��ǰ��2</th>
		<td>
			<select name='prd2'>
				<option value=''>::��ǰ����::</option>
				<option value='������'<? echo $prd2 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�˶���'<? echo $prd2 =='�˶��� Ȩ������ ����' ? 'selected':''?>>�˶��� Ȩ������ ����</option>
				<option value='������'<? echo $prd2 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd2 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd2 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd2 =='������(Ȩ������ �ּ�) 1��' ? 'selected':''?>>������(Ȩ������ �ּ�) 1��</option>
				<option value='SSL'<? echo $prd2 =='SSL ���ȼ��� 1��' ? 'selected':''?>>SSL ���ȼ��� 1��</option>
				<option value='���ڰ���'<? echo $prd2 =='���ڰ��� ���Ժ��' ? 'selected':''?>>���ڰ��� ���Ժ��</option>
				<option value='100MB'<? echo $prd2 =='���뷮 100MB / ��Ʈ���� 400MB' ? 'selected':''?>>���뷮 100MB / ��Ʈ���� 400MB</option>
				<option value='500MB'<? echo $prd2 =='���뷮 500MB / ��Ʈ���� 2GB' ? 'selected':''?>>���뷮 500MB / ��Ʈ���� 2GB</option>
				<option value='1GB'<? echo $prd2 =='���뷮 1GB / ��Ʈ���� 5GB' ? 'selected':''?>>���뷮 1GB / ��Ʈ���� 5GB</option>
				<option value='2GB'<? echo $prd2 =='���뷮 2GB / ��Ʈ���� 10GB' ? 'selected':''?>>���뷮 2GB / ��Ʈ���� 10GB</option>
				<option value='3GB'<? echo $prd2 =='���뷮 3GB / ��Ʈ���� 15GB' ? 'selected':''?>>���뷮 3GB / ��Ʈ���� 15GB</option>
				<option value='5GB'<? echo $prd2 =='���뷮 5GB / ��Ʈ���� 25GB' ? 'selected':''?>>���뷮 5GB / ��Ʈ���� 25GB</option>
				<option value='7GB'<? echo $prd2 =='���뷮 7GB / ��Ʈ���� 35GB' ? 'selected':''?>>���뷮 7GB / ��Ʈ���� 35GB</option>
				<option value='10GB'<? echo $prd2 =='���뷮 10GB / ��Ʈ���� 50GB' ? 'selected':''?>>���뷮 10GB / ��Ʈ���� 50GB</option>
				<option value='20GB'<? echo $prd2 =='���뷮 20GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 20GB / ��Ʈ���� ������</option>
				<option value='30GB'<? echo $prd2 =='���뷮 30GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 30GB / ��Ʈ���� ������</option>
				<option value='�˶���+1P�κ�����'<? echo $prd2 =='�˶���+1P�κ�����' ? 'selected':''?>>�˶���+1P�κ�����</option>
				<option value='1P�κ�����'<? echo $prd2 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�ٱ���������'<? echo $prd2 =='�ٱ���������' ? 'selected':''?>>�ٱ���������</option>
			</select>
			<select name='prd2'>
				<option value=''>::��������::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr>
	
	<tr>
		<th>��ǰ��3</th>
		<td>
			<select name='prd3'>
				<option value=''>::��ǰ����::</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�˶���'<? echo $prd3 =='�˶��� Ȩ������ ����' ? 'selected':''?>>�˶��� Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������(Ȩ������ �ּ�) 1��' ? 'selected':''?>>������(Ȩ������ �ּ�) 1��</option>
				<option value='SSL'<? echo $prd3 =='SSL ���ȼ��� 1��' ? 'selected':''?>>SSL ���ȼ��� 1��</option>
				<option value='���ڰ���'<? echo $prd3 =='���ڰ��� ���Ժ��' ? 'selected':''?>>���ڰ��� ���Ժ��</option>
				<option value='100MB'<? echo $prd3 =='���뷮 100MB / ��Ʈ���� 400MB' ? 'selected':''?>>���뷮 100MB / ��Ʈ���� 400MB</option>
				<option value='500MB'<? echo $prd3 =='���뷮 500MB / ��Ʈ���� 2GB' ? 'selected':''?>>���뷮 500MB / ��Ʈ���� 2GB</option>
				<option value='1GB'<? echo $prd3 =='���뷮 1GB / ��Ʈ���� 5GB' ? 'selected':''?>>���뷮 1GB / ��Ʈ���� 5GB</option>
				<option value='2GB'<? echo $prd3 =='���뷮 2GB / ��Ʈ���� 10GB' ? 'selected':''?>>���뷮 2GB / ��Ʈ���� 10GB</option>
				<option value='3GB'<? echo $prd3 =='���뷮 3GB / ��Ʈ���� 15GB' ? 'selected':''?>>���뷮 3GB / ��Ʈ���� 15GB</option>
				<option value='5GB'<? echo $prd3 =='���뷮 5GB / ��Ʈ���� 25GB' ? 'selected':''?>>���뷮 5GB / ��Ʈ���� 25GB</option>
				<option value='7GB'<? echo $prd3 =='���뷮 7GB / ��Ʈ���� 35GB' ? 'selected':''?>>���뷮 7GB / ��Ʈ���� 35GB</option>
				<option value='10GB'<? echo $prd3 =='���뷮 10GB / ��Ʈ���� 50GB' ? 'selected':''?>>���뷮 10GB / ��Ʈ���� 50GB</option>
				<option value='20GB'<? echo $prd3 =='���뷮 20GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 20GB / ��Ʈ���� ������</option>
				<option value='30GB'<? echo $prd3 =='���뷮 30GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 30GB / ��Ʈ���� ������</option>
				<option value='�˶���+1P�κ�����'<? echo $prd3 =='�˶���+1P�κ�����' ? 'selected':''?>>�˶���+1P�κ�����</option>
				<option value='1P�κ�����'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�ٱ���������'<? echo $prd3 =='�ٱ���������' ? 'selected':''?>>�ٱ���������</option>
			</select>
			<select name='prd2'>
				<option value=''>::��������::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr>
	<tr>
		<th>��ǰ��4</th>
		<td>
			<select name='prd3'>
				<option value=''>::��ǰ����::</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�˶���'<? echo $prd3 =='�˶��� Ȩ������ ����' ? 'selected':''?>>�˶��� Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������(Ȩ������ �ּ�) 1��' ? 'selected':''?>>������(Ȩ������ �ּ�) 1��</option>
				<option value='SSL'<? echo $prd3 =='SSL ���ȼ��� 1��' ? 'selected':''?>>SSL ���ȼ��� 1��</option>
				<option value='���ڰ���'<? echo $prd3 =='���ڰ��� ���Ժ��' ? 'selected':''?>>���ڰ��� ���Ժ��</option>
				<option value='100MB'<? echo $prd3 =='���뷮 100MB / ��Ʈ���� 400MB' ? 'selected':''?>>���뷮 100MB / ��Ʈ���� 400MB</option>
				<option value='500MB'<? echo $prd3 =='���뷮 500MB / ��Ʈ���� 2GB' ? 'selected':''?>>���뷮 500MB / ��Ʈ���� 2GB</option>
				<option value='1GB'<? echo $prd3 =='���뷮 1GB / ��Ʈ���� 5GB' ? 'selected':''?>>���뷮 1GB / ��Ʈ���� 5GB</option>
				<option value='2GB'<? echo $prd3 =='���뷮 2GB / ��Ʈ���� 10GB' ? 'selected':''?>>���뷮 2GB / ��Ʈ���� 10GB</option>
				<option value='3GB'<? echo $prd3 =='���뷮 3GB / ��Ʈ���� 15GB' ? 'selected':''?>>���뷮 3GB / ��Ʈ���� 15GB</option>
				<option value='5GB'<? echo $prd3 =='���뷮 5GB / ��Ʈ���� 25GB' ? 'selected':''?>>���뷮 5GB / ��Ʈ���� 25GB</option>
				<option value='7GB'<? echo $prd3 =='���뷮 7GB / ��Ʈ���� 35GB' ? 'selected':''?>>���뷮 7GB / ��Ʈ���� 35GB</option>
				<option value='10GB'<? echo $prd3 =='���뷮 10GB / ��Ʈ���� 50GB' ? 'selected':''?>>���뷮 10GB / ��Ʈ���� 50GB</option>
				<option value='20GB'<? echo $prd3 =='���뷮 20GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 20GB / ��Ʈ���� ������</option>
				<option value='30GB'<? echo $prd3 =='���뷮 30GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 30GB / ��Ʈ���� ������</option>
				<option value='�˶���+1P�κ�����'<? echo $prd3 =='�˶���+1P�κ�����' ? 'selected':''?>>�˶���+1P�κ�����</option>
				<option value='1P�κ�����'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�ٱ���������'<? echo $prd3 =='�ٱ���������' ? 'selected':''?>>�ٱ���������</option>
			</select>
			<select name='prd2'>
				<option value=''>::��������::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr>
	<tr>
		<th>��ǰ��5</th>
		<td>
			<select name='prd3'>
				<option value=''>::��ǰ����::</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�˶���'<? echo $prd3 =='�˶��� Ȩ������ ����' ? 'selected':''?>>�˶��� Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='������'<? echo $prd3 =='������(Ȩ������ �ּ�) 1��' ? 'selected':''?>>������(Ȩ������ �ּ�) 1��</option>
				<option value='SSL'<? echo $prd3 =='SSL ���ȼ��� 1��' ? 'selected':''?>>SSL ���ȼ��� 1��</option>
				<option value='���ڰ���'<? echo $prd3 =='���ڰ��� ���Ժ��' ? 'selected':''?>>���ڰ��� ���Ժ��</option>
				<option value='100MB'<? echo $prd3 =='���뷮 100MB / ��Ʈ���� 400MB' ? 'selected':''?>>���뷮 100MB / ��Ʈ���� 400MB</option>
				<option value='500MB'<? echo $prd3 =='���뷮 500MB / ��Ʈ���� 2GB' ? 'selected':''?>>���뷮 500MB / ��Ʈ���� 2GB</option>
				<option value='1GB'<? echo $prd3 =='���뷮 1GB / ��Ʈ���� 5GB' ? 'selected':''?>>���뷮 1GB / ��Ʈ���� 5GB</option>
				<option value='2GB'<? echo $prd3 =='���뷮 2GB / ��Ʈ���� 10GB' ? 'selected':''?>>���뷮 2GB / ��Ʈ���� 10GB</option>
				<option value='3GB'<? echo $prd3 =='���뷮 3GB / ��Ʈ���� 15GB' ? 'selected':''?>>���뷮 3GB / ��Ʈ���� 15GB</option>
				<option value='5GB'<? echo $prd3 =='���뷮 5GB / ��Ʈ���� 25GB' ? 'selected':''?>>���뷮 5GB / ��Ʈ���� 25GB</option>
				<option value='7GB'<? echo $prd3 =='���뷮 7GB / ��Ʈ���� 35GB' ? 'selected':''?>>���뷮 7GB / ��Ʈ���� 35GB</option>
				<option value='10GB'<? echo $prd3 =='���뷮 10GB / ��Ʈ���� 50GB' ? 'selected':''?>>���뷮 10GB / ��Ʈ���� 50GB</option>
				<option value='20GB'<? echo $prd3 =='���뷮 20GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 20GB / ��Ʈ���� ������</option>
				<option value='30GB'<? echo $prd3 =='���뷮 30GB / ��Ʈ���� ������' ? 'selected':''?>>���뷮 30GB / ��Ʈ���� ������</option>
				<option value='�˶���+1P�κ�����'<? echo $prd3 =='�˶���+1P�κ�����' ? 'selected':''?>>�˶���+1P�κ�����</option>
				<option value='1P�κ�����'<? echo $prd3 =='������ Ȩ������ ����' ? 'selected':''?>>������ Ȩ������ ����</option>
				<option value='�ٱ���������'<? echo $prd3 =='�ٱ���������' ? 'selected':''?>>�ٱ���������</option>
			</select>
			<select name='prd2'>
				<option value=''>::��������::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr> -->

	<tr>
		<th>��  ��</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>�� ��</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>ȸ �� ��</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>������ ����</th>
		<td>
			<input type='text' name='account01' style='width:180px;' value='<?=$account01?>' readonly>
		</td>
	</tr>

	<tr>
		<th>������</th>
		<td>
			<input type='text' name='actxt01' style='width:350px;' value='<?=$actxt01?>' readonly>
		</td>
	</tr>

	<tr>
		<th>ȸ�ſ���ó</th>
		<td>
			<input type='text' id="phone" name='phone' value='<?=$phone?>' readonly>
		</td>
	</tr>

	<tr>
		<th>�̸���</th>
		<td>
			<input type='text' id="i_mail" name='i_mail' value='<?=$i_mail?>' readonly>
		</td>
	</tr>
	<tr>
		<th>����</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>��ǥ�̻� </th>
		<td><input type='text' name='team' style='width:50px;' value='<?=$ceo_nm?>' readonly></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>
					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../../img/board/list01.gif" border=0></a>&nbsp;

					</td>

				</tr>
			</table>
		</td>
	</tr>
</table> 


</form>

<script type="text/javascript">
/*
var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",


	/* ������ ����� ���â ���ֱ� */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});
*/
</script>


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- ��Ŷ�������� -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder �±�ó���� -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>