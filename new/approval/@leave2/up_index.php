<?

include $_SERVER["DOCUMENT_ROOT"].'/new/header.php';
include $_SERVER["DOCUMENT_ROOT"]."/module/class/class.Msg.php";
include $_SERVER["DOCUMENT_ROOT"]."/module/class/class.DbCon.php";

if (!$type)	$type = 'list';

?>

<link rel="stylesheet" href="./leave.style.css">
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center' class="no-print">
	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='50%'>

						<span style="font-size:20px;font-weight:800;margin-left:8px;">휴가신청서</span>
					</td>
					<td width='50%' align='right' valign='bottom'><? if ($type == 'list') { ?><a href='up_index.php?type=write' class="big cbtn black">등록</a><? } ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<div class="container leave-container">

	<?
	$calSize = 'medium';

	switch ($type) {
		case 'list':
			include 'list.php';
			break;

		case 'view':
			include 'view.php';
			break;

		case 'write':
		case 'edit':
			include 'write.php';
			break;
	}
	?>
</div>