<?
	$n_url = "./";
	
	include "head.php";
	include "array.php";

?>

<?
	$to_y = date('Y');
	$to_m = date('m');
	$to_d = date('d');

	$sql = "select * from wo_timechk where userid='$GBL_USERID' and to_y='$to_y' and to_m='$to_m' and to_d='$to_d' order by uid desc limit 1";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);
		$in_date = $row['in_date'];
		$out_date = $row['out_date'];
		$name = $row['name'];
	}

	if($in_date && !$out_date){
		$time_img = 'btn_check02.gif';
		$time_mod = 'out';

	}else{
		$time_img = 'btn_check01.gif';
		$time_mod = 'in';
	}

?>

<?
if (!$str_Root)  $str_Root = './';
?>
<script language='javascript'>
  function time_chk(mtype) {
    if (mtype == 'out') {
			if (!confirm('���üũ �Ͻðڽ��ϱ�?')) {
        return;
      }
    }
    document.ifra_check.location.href = '../time_chk.php?mtype=' + mtype;
  }
</script>

<?
function monthNum2($date1, $date2){

		//��, ��, ���� ������ ������ �Ҵ��մϴ�.
		sscanf($date1,'%4d-%2d-%2d',$y1,$m1,$d1);
		sscanf($date2,'%4d-%2d-%2d',$y2,$m2,$d2);

		// ������ ���� ���մϴ�.
		$m3 = $m2 - $m1; // 11 - 12 = -1
		$y3 = $y2 - $y1; // 2013 - 2002 = 11

		// '��'�� �����顦
		if($m3 < 1){
			$y3--; // '��'���� 1�� ���ְ�
			$m3+= 12; // 12�� ���ϸ� ��.
		}

		//12������ ���ý� 1������ �ٲ���
		if($m3 == 12){
			$m3 = 0;
			$y3 = $y3 + 1;
		}

	//	echo $y3.'�� '.$m3.'���� '; // 10�� 10���� 11��
		//����Ȯ��
		if($d1 >= $d2)		$m3--;

		$arr = Array();
		$arr['y'] = $y3;
		$arr['m'] = $m3 + 1;

		return $arr;
	}
	function periodMonth2($m,$d){
		$ty = date('Y');
		$tm = date('m');

		if($tm < $m)	$csy = $ty-1;
		else				$csy = $ty;

		$csTime = strtotime($csy.'-'.$m.'-'.$d);

		$cey = $csy + 1;
		$cem = $m;

		$day_last = Date("t",MkTime('0','0','0',$cem,1,$cey));	//�ش���� ��������
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

	$day_last = Date("t",MkTime('0','0','0',$f_month,$f_day,$f_year));	//�ش���� ��������

		//�ش� ������ �Ի�⵵
	$sql = "select * from wo_member where userid='$f_userid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$idate01 = $row['idate01'];	//��
	$idate02 = $row['idate02'];	//��
	$idate03 = $row['idate03'];	//��

	
	//�ٹ�������
	$d1 = $idate01.'-'.$idate02.'-'.$idate03;
	$d2 = date('Y-m');
	$tmpArr = monthNum2($d1,$d2);
	$wMonth = ($tmpArr['y'] * 12) + $tmpArr['m'];

	//�Ի����� �������� �ٹ����� ���� ����
	if($f_day <= $idate03)	$wMonth -= 1;

	//�߻��� ������
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

	//��ȸ���ڱ��� ����� ������
	$sTime = mktime(0,0,0,$f_month,1,$f_year);
	$eTime = mktime(0,0,0,$f_month,$day_last,$f_year);

	//������볻��
	$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$OffArr = Array();	//����
	$HalfArr = Array();	//����

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

	$tmpArr = periodMonth2($idate02,$idate03);

	$syTime = $tmpArr['st'];
	$eyTime = $tmpArr['et'];

	//�Ի��� ���� ��� �Ի����� �������� �ٹ����� ���� ����
	if($f_month == $idate02){
		if($f_day <= $idate03){
			$syTime = strtotime('-1 year', $syTime);
			$eyTime = strtotime('-1 year', $eyTime);
		}
	}
//������ ����/���� ����
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

	//��� ������
	$UseOff = $OffNum + ($HalfNum * 0.5);


	//���� ������
	$ModOff = $DayOff - $UseOff;

	

?>

<header class="header">
	<div class="m_header_bg"></div>
	<div class="menu_wrap">
		<div class="pc_profile_wrap">
			<?
				include 'profile.php';
			?>
		</div>
		<div class="m_header_top">
			<div class="m_close_btn">
				<span class="material-symbols-outlined">
				close
				</span>
			</div>
		</div>
		<ul class="dep1">
			<li>
				<a href="javascript:void(0)">
					<img src="/new/images/menu01.png" class="menu_icon"/>
					<span>��������</span>
				</a>
				<span class="lnr lnr-chevron-down"></span>
				<span class="lnr lnr-chevron-up"></span>
				<ul class="dep2">
					<li><a href="/new/timechk/up_index.php">������Ȳ</a></li>
					<li><a href="/new/job/up_index.php">������Ȳ</a></li>
					<li><a href="/new/daylog/up_index.php">��������</a></li>
					<li><a href="/new/member/up_index.php">�λ����</a></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0)">
					<img src="/new/images/menu02.png" class="menu_icon"/>
					<span>��������</span>
				</a>				
				<span class="lnr lnr-chevron-down"></span>
				<span class="lnr lnr-chevron-up"></span>
				<ul class="dep2">
					<li><a href="/new/ing01/up_index.php">������Ȳ</a></li>
					<li><a href="/new/ing02/up_index.php">����������Ȳ</a></li>
					<li><a href="/new/ing02/up_index02.php">����û�����</a></li>
					<li><a href="/new/ing02/up_index.php?f_status=�κ�����">�κ�����</a></li>
					<li><a href="/new/bus01/up_index.php">�ŷ�ó����</a></li>
					<li><a href="/new/bus02/up_index.php">�����ü��Ȳ</a></li>
					<li><a href="/new/searchad/up_index.php">�������</a></li>					    
    			<li><a href="/new/lgu/up_index.php">LGU+</a></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0)">
					<img src="/new/images/menu03.png" class="menu_icon"/>
					<span>���ڰ���</span>
				</a>
				<span class="lnr lnr-chevron-down"></span>
				<span class="lnr lnr-chevron-up"></span>
				<ul class="dep2">
					<!-- <li><a href="/approval/up_index.php">���ڰ���(��)</a></li> -->
					<li><a href="/new/bill/index.php">���ڰ���(��)</a></li>
					<li><a href="/new/bill/write.php">������</a></li>
					<li><a href="/new/bill/transactionStatement.php">�ŷ�����</a></li>
					<li><a href="/new/bill/payment.php">���û����</a></li>
					<li><a href="/new/bill/transition.php">�μ��ΰ輭</a></li>
					<li><a href="/new/bill/order.php">����ǰ�Ǽ�</a></li>
				</ul>
			</li>
			
			<li><iframe name='ifra_check' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe></li>	
		</ul>
		<a href="/new" class="logo"></a>
	</div>
</header>
    


	


<script>
	
	$(function () {	

		$(".dep1 > li > a").on("click", function (event) {
			event.preventDefault();

			$(this).parent().siblings().children(".dep2").stop().slideUp();

			if(!$(this).parent().hasClass('on')){
				$(this).siblings(".dep2").slideDown();

				$(this).parent().siblings().removeClass("on");
				$(this).parent().addClass("on");
			}else {
				$(this).siblings(".dep2").slideUp();
				$(this).parent().removeClass("on");
			}
		});

	});
	
</script>
