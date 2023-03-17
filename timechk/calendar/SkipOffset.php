<?
  for($i=1;$i<=$no;$i++) { 
    $ck = $no-$i+1;

    if($sdate){
		$snum = date('d',$sdate-((3600*24)*$ck));
		$sy = date('Y',$sdate);
		$sm = date('m',$sdate);
		$smk = mktime(0,0,0,$sm-1,1,$sy);
		$yy = date('Y',$smk);
		$mm = date('n',$smk);
	}

	if($edate){
		$snum=$i;
		$sy = date('Y',$edate);
		$sm = date('m',$edate);
		$smk = mktime(0,0,0,$sm,1,$sy);
		$yy = date('Y',$smk);
		$mm = date('n',$smk);
	}



	//스케쥴데이터를 가져온다
//	$sql = "select * from ks_board_list where table_id='$table_id' and data01='$yy' and data02='$mm' and data03='$snum' order by uid";
//	$result = mysql_query($sql);
//	$trecord = mysql_num_rows($result);

	if($trecord){
		$style = 'sover2';
		$date2_txt = "<a href=javascript:setView('$yy','$mm','$snum'); class=$style>$snum</a>";
	}else{
		$style = 'snum2';
		$date2_txt = "<span class=$style>$snum</span>";
	}




	if($trecord){
		$style = 'sover2';
	}else{
		$style = 'snum2';
	}


	echo ("
		<td align='center'>$date2_txt</td>");
  }
  ?>