<?
	include "../../module/class/class.DbCon.php";




	if($mtype){
		//기존설정삭제
		$sql = "delete from wo_bus01_config";
		$result = mysql_query($sql);

		$sql = "insert into wo_bus01_config (mtype) values ('$mtype')";
		$result = mysql_query($sql);
	}

?>


<script language='javascript'>
opener.location.reload();
self.close();
</script>