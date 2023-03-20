<?	
	include '../module/class/class.DbCon.php';

	$qment = '';
	$sment = "order by binary(company)";

	if($txt == 'ㄱ'){ 
		$qment = "where (company RLIKE '^(ㄱ|ㄲ)' OR ( company >= '가' AND company < '나' ))";
	}else if($txt == 'ㄴ'){ 
		$qment = "where (company RLIKE '^ㄴ' OR ( company >= '나' AND company < '다' ))";
	}else if($txt == 'ㄷ'){ 
		$qment = "where (company RLIKE '^(ㄷ|ㄸ)' OR ( company >= '다' AND company < '라' ))";
	}else if($txt == 'ㄹ'){ 
		$qment = "where (company RLIKE '^ㄹ' OR ( company >= '라' AND company < '마' ))";
	}else if($txt == 'ㅁ'){ 
		$qment = "where (company RLIKE '^ㅁ' OR ( company >= '마' AND company < '바' ))";
	}else if($txt == 'ㅂ'){ 
		$qment = "where (company RLIKE '^ㅂ' OR ( company >= '바' AND company < '사' ))";
	}else if($txt == 'ㅅ'){ 
		$qment = "where (company RLIKE '^(ㅅ|ㅆ)' OR ( company >= '사' AND company < '아' ))";
	}else if($txt == 'ㅇ'){ 
		$qment = "where (company RLIKE '^ㅇ' OR ( company >= '아' AND company < '자' ))";
	}else if($txt == 'ㅈ'){ 
		$qment = "where (company RLIKE '^(ㅈ|ㅉ)' OR ( company >= '자' AND company < '차' ))";
	}else if($txt == 'ㅊ'){ 
		$qment = "where (company RLIKE '^ㅊ' OR ( company >= '차' AND company < '카' ))";
	}else if($txt == 'ㅋ'){ 
		$qment = "where (company RLIKE '^ㅋ' OR ( company >= '카' AND company < '타' ))";
	}else if($txt == 'ㅌ'){ 
		$qment = "where (company RLIKE '^ㅌ' OR ( company >= '타' AND company < '파' ))";
	}else if($txt == 'ㅍ'){ 
		$qment = "where (company RLIKE '^ㅍ' OR ( company >= '파' AND company < '하' ))";
	}else if($txt == 'ㅎ'){ 
		$qment = "where (company RLIKE '^ㅎ' OR ( company >= '하'))";
	}else if($txt == 'a'){
		$qment = "where (company >= 'a' and company <= 'z')";
	}

	if($playing){
		if($qment)	$qment .= " and playing='진행'";
		else			$qment = "where playing='진행'";
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
	form.set_project.options[1].text = '아이웹';

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