<?
$record_count = 30;  //�� �������� ��µǴ� ���ڵ��

$link_count = 10; //�� �������� ��µǴ� ������ ��ũ��

if (!$record_start) {
	$record_start = 0;
}

$current_page = ($record_start / $record_count) + 1;

$group = floor($record_start / ($record_count * $link_count));

$query_ment = "where uid > 0";

if ($f_name)			$query_ment .= " and name like '%$f_name%'"; // ����
if ($f_gubun)			$query_ment .= " and gubun like '%$f_gubun%'"; // ���뵵

$sort_ment = "order by uid desc";

$query = "select * from wo_leave2 $query_ment $sort_ment";

$result = mysql_query($query) or die("�������");

$total_record = mysql_num_rows($result);		//�Ѱ���

$total_page = (int)($total_record / $record_count);

if ($total_record % $record_count) {
	$total_page++;
}

$query2 = "select * from wo_leave2 $query_ment $sort_ment limit $record_start, $record_count";
$result = mysql_query($query2);
?>

<style>
	.titt tr td {
		font-size: 12px;
		color: #000;
		text-align: center;
	}
</style>

<script language='javascript'>
	function reg_view(uid) {
		form = document.form1;
		form.type.value = 'view';
		form.uid.value = uid;
		form.action = '<?= $PHP_SELF ?>';
		form.submit();
	}

	function reg_write(uid) {
		form = document.form1;
		form.type.value = 'edit';
		form.uid.value = uid;
		form.action = '<?= $PHP_SELF ?>';
		form.submit();
	}

	function page(uid) {
		form = document.form1;
		form.record_start.value = uid;
		form.action = '<?= $PHP_SELF ?>';
		form.submit();
	}

	function reg_del(uid) {

		if (confirm('�ش� ���系���� �����Ͻðڽ��ϱ�?')) {
			form = document.form1;
			form.type.value = 'del';
			form.uid.value = uid;
			form.action = 'proc.php';
			form.submit();

		}
	}
</script>

<form name='form1' method='get' action='<?= $PHP_SELF ?>'>
	<input type="text" style="display: none;"> <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='uid' value='<?= $uid ?>'>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>


	<?
	include 'search.php';
	?>
	<!-- ����Ʈ�� ���̴� ���̺� ȭ�� -->
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
		<tr>
			<th>No.</th>
			<th>�Ҽ�</th>
			<th>����</th>
			<th>��û��</th>
			<th>�ް��Ⱓ</th>
			<th>���뵵</th>
			<!--<th>����������</th>-->
			<th>���ο���</th>
			<th>����</th>
		</tr>

		<?

		if ($total_record != '0') {
			$i = $total_record - ($current_page - 1) * $record_count;

			$line_num = 0;

			while ($row = mysql_fetch_array($result)) {
				$uid = $row["uid"];
				$userid = $row['userid'];
				$name = $row['name'];
				$affil = $row['affil'];
				$team = $row['team'];
				$gubun = $row['gubun'];
				$date1 = $row['date1'];
				$sort1 = $row['sort1'];
				$date2 = $row['date2'];
				$sort2 = $row['sort2'];
				$status = $row['status'];
				$acting = $row['acting'];

				if ($gubun == 'H') {
					$gubun2 = '����';
					$daterange = $date1 . ' ' .  $sort1;
				} else {
					$gubun2 = '����';
					$daterange = $date1 . ' ' .  $sort1 . " ~ " . $date2 . ' ' .  $sort2;
				}

				$acting_name = sqlRowOne("select name from wo_member where userid='$acting'");
		?>

				<tr height='30' style="cursor:hand;<?= $bimg ?>" onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">
					<td class='tit04' onclick="reg_view('<?= $uid ?>');"><?= $uid ?></td>
					<td class='tit04' onclick="reg_view('<?= $uid ?>');"><?= $team ?></td>
					<td class='tit04' onclick="reg_view('<?= $uid ?>');"><?= $affil ?></td>
					<td class='tit04' onclick="reg_view('<?= $uid ?>');"><?= $name ?></td>
					<td class='tit04' onclick="reg_view('<?= $uid ?>');"><?= $daterange ?>
					<td class='tit04' onclick="reg_view('<?= $uid ?>');"><?= $gubun2 ?></td>
					<!--<td class='tit04' style="" onclick="reg_view('<?= $uid ?>');"><?= $acting_name ?></td>-->
					<td class='tit04' onclick="reg_view('<?= $uid ?>');" style="font-weight:600; color: <? if ($status=='����') {echo "#0b0";} else if ($status == '�ݷ�') {echo "#f00";} else {echo "#777";}?>;"><?= $status ?></td>
					<td class='tit04'>
						<? if ($GBL_MTYPE == 'A' || $GBL_MTYPE == 'S') { ?>
						<a href="javascript:reg_del('<?= $uid ?>')" class='small cbtn black'>����</a> 
						<? } ?>
					</td>
				</tr>

			<?
				$line_num++;
				$i--;
			}
		} else {
			?>
			<tr>
				<td colspan="8" align='center'>��ϵ� �ڷᰡ �����ϴ�</td>
			</tr>
		<?
		}
		?>
	</table>


</form>


<?
$fName = '../../form1';
include '../../pageNum.php';
?>