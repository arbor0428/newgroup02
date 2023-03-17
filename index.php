<?

	include "./head.php";
	include "./module/class/class.Msg.php";
	include "./module/class/class.DbCon.php";

?>



<?
	if($GBL_USERID){
		include './main.php';
	}else{
		include './loginNew.php';
	}
?>
