<?

error_reporting( E_ALL );
  ini_set( "display_errors", 1 );

function monthNum($date1, $date2){

		//년, 월, 일을 별도의 변수에 할당합니다.
		sscanf($date1,'%4d-%2d-%2d',$y1,$m1,$d1);
		sscanf($date2,'%4d-%2d-%2d',$y2,$m2,$d2);

		// 각각의 차를 구합니다.
		$m3 = $m2 - $m1; // 11 - 12 = -1
		$y3 = $y2 - $y1; // 2013 - 2002 = 11

		// '월'이 음수면…
		if($m3 < 1){
			$y3--; // '년'에서 1을 빼주고
			$m3+= 12; // 12를 더하면 끝.
		}

		//12개월로 나올시 1년으로 바꿔줌
		if($m3 == 12){
			$m3 = 0;
			$y3 = $y3 + 1;
		}

	//	echo $y3.'년 '.$m3.'개월 '; // 10년 10개월 11일
		//일자확인
		if($d1 >= $d2)		$m3--;

		$arr = Array();
		$arr['y'] = $y3;
		$arr['m'] = $m3 + 1;

		return $arr;
	}
	function periodMonth($m,$d){
		$ty = date('Y');
		$tm = date('m');

		if($tm < $m)	$csy = $ty-1;
		else				$csy = $ty;

		$csTime = strtotime($csy.'-'.$m.'-'.$d);

		$cey = $csy + 1;
		$cem = $m;

		$day_last = Date("t",MkTime('0','0','0',$cem,1,$cey));	//해당월의 마지막날
		$ceTime = strtotime($cey.'-'.$cem.'-'.$d) - 1;

		$arr = Array();
		$arr['st'] = $csTime;
		$arr['et'] = $ceTime;

		return $arr;

	//		return date('Y-m-d H:i:s',$csTime).' ~ '.date('Y-m-d H:i:s',$ceTime).'<br>';
	}
	
	if(!$f_userid)	$f_userid = $GBL_USERID;
	if(!$f_year)		$f_year = date('Y');
	if(!$f_month)	$f_month = date('m');
	$f_day = date('d');

	$day_last = Date("t",MkTime('0','0','0',$f_month,$f_day,$f_year));	//해당월의 마지막날

		//해당 직원의 입사년도
	$sql = "select * from wo_member where userid='$f_userid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$idate01 = $row['idate01'];	//년
	$idate02 = $row['idate02'];	//월
	$idate03 = $row['idate03'];	//일

	
	//근무개월수
	$d1 = $idate01.'-'.$idate02.'-'.$idate03;
	$d2 = date('Y-m');
	$tmpArr = monthNum($d1,$d2);
	$wMonth = ($tmpArr['y'] * 12) + $tmpArr['m'];

	//입사일을 기준으로 근무개월 수를 수정
	if($f_day <= $idate03)	$wMonth -= 1;

	//발생한 연차수
	if($wMonth < 12)			$DayOff = $wMonth;
	elseif($wMonth < 36)		$DayOff = 15;
	elseif($wMonth < 60)		$DayOff = 16;
	elseif($wMonth < 84)		$DayOff = 17;
	elseif($wMonth < 108)		$DayOff = 18;
	elseif($wMonth < 132)		$DayOff = 19;
	elseif($wMonth < 156)		$DayOff = 20;
	elseif($wMonth < 180)		$DayOff = 21;
	elseif($wMonth < 204)		$DayOff = 22;
	elseif($wMonth < 228)		$DayOff = 23;
	elseif($wMonth < 252)		$DayOff = 24;
	else							$DayOff = 25;

	//조회일자기준 사용한 연차수
	$sTime = mktime(0,0,0,$f_month,1,$f_year);
	$eTime = mktime(0,0,0,$f_month,$day_last,$f_year);

	//연차사용내역
	$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$OffArr = Array();	//연차
	$HalfArr = Array();	//반차

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$offType = $row['offType'];

		if($offType == 'A'){
			$OffArr[] = $row['rTime'];
		}

		if($offType == 'H'){
			$HalfArr[] = $row['rTime'];
		}
	}

	$tmpArr = periodMonth($idate02,$idate03);

	$syTime = $tmpArr['st'];
	$eyTime = $tmpArr['et'];

	//입사한 월인 경우 입사일을 기준으로 근무개월 수를 수정
	if($f_month == $idate02){
		if($f_day <= $idate03){
			$syTime = strtotime('-1 year', $syTime);
			$eyTime = strtotime('-1 year', $eyTime);
		}
	}
//연단위 연차/반차 사용수
	$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$syTime and rTime<=$eyTime";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$OffNum = 0;
	$HalfNum = 0;

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$offType = $row['offType'];

		if($offType == 'A'){
			$OffNum++;
		}

		if($offType == 'H'){
			$HalfNum++;
		}
	}

	//사용 연차수
	$UseOff = $OffNum + ($HalfNum * 0.5);


	//남은 연차수
	$ModOff = $DayOff - $UseOff;

	



?>



<p class="dp_f dp_c" style='color: #fff;'><span class="lnr lnr-calendar-full"></span>남은 연차수<span class="re_amt"><?=$ModOff?></span></p>