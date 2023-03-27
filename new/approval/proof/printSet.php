<?
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";
?>

<link type='text/css' rel='stylesheet' href='./print.css'>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

function printPage(uid) {

		var html="<html>";
		html+= document.getElementById(id).innerHTML;
		html+="</html>";
		var printWin = window.open('','','left=1000,top=1000,width=1000,height=1000,toolbar=1000,scrollbars=1000,status =1000');
		printWin.document.write(html);
		printWin.document.close();
		printWin.focus();
		printWin.print();
		printWin.close();

	}

</script>

<div id="wrap" style="page:a4sheet;page-break-after:always;">

	<?
		include 'print_ok.php';
	?>

</div>


<div onclick="javascript:printPage(uid)" style='width:200px;height:50px;line-height:50px;text-align:center;margin:50px auto;background:#4d56c3;color:#ffffff;font-size:18px;font-weight:bold;cursor:pointer;margin-bottom:0'>인쇄</div>
<br>
<div style='text-align:Center;'>
	※ 익스플로러에서 간혹적으로 인쇄가 안되시는 분들은 Chrome 에서 인쇄해주시기 바랍니다.
</div>
<br><br>
