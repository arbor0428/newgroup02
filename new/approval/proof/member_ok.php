<?
	include "../../module/class/class.DbCon.php";

	$name = $_POST["name"];
	$securi = $_POST["securi01"]."-".$_POST["securi02"];
	$addr = $_POST["addr"];
	$team = $_POST["team"];
	$mname = $_POST["mname"];
	$entry_date = $_POST["entry_date"];
	$reg_date = date("Y-m-d");


	$sql = "insert into member(name, securi, addr, team, mname, entry_date, reg_date) values('$name', '$securi', '$addr', '$team', '$mname', '$entry_date', '$reg_date')";
	
	mysql_query($sql);
	echo "등록 성공! <a href=\"http://wgroup.smilework.kr/approval/proof/member.php\">돌아가기</a>";
?>