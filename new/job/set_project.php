<?	
	include '../module/class/class.DbCon.php';

	$qment = '';
	$sment = "order by binary(company)";

	if($txt == '��'){ 
		$qment = "where (company RLIKE '^(��|��)' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^(��|��)' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^(��|��)' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^(��|��)' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < 'ī' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= 'ī' AND company < 'Ÿ' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= 'Ÿ' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��' AND company < '��' ))";
	}else if($txt == '��'){ 
		$qment = "where (company RLIKE '^��' OR ( company >= '��'))";
	}else if($txt == 'a'){
		$qment = "where (company >= 'a' and company <= 'z')";
	}

	if($playing){
		if($qment)	$qment .= " and playing='����'";
		else			$qment = "where playing='����'";
	}

	$sql = "select uid, company from wo_ing02 $qment $sment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$tot_num = mysql_num_rows($result);

	$opt_len = $tot_num + 2;
?>


<SCRIPT LANGUAGE=JavaScript> 
function Adding(){
	var form = parent.FRM;
	form.set_project.options.length = '<?=$opt_len?>';

	form.set_project.options[0].value = '';
	form.set_project.options[0].text = '===';

	form.set_project.options[1].value = '24';
	form.set_project.options[1].text = '������';

	<?
		for($i=1; $i<$opt_len; $i++){
			$row = mysql_fetch_array($result);
			$uid = $row[uid];
			$company = $row[company];

			$n = $i + 1;
	?>
	
	form.set_project.options[<?=$n?>].value = '<?=$uid?>';
	form.set_project.options[<?=$n?>].text = '<?=$company?>';

	<?
		}
	?>
}

Adding(); 

</script> 