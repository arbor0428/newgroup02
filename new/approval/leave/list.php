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

$query = "select * from wo_leave $query_ment $sort_ment";

$result = mysql_query($query) or die("�������");

$total_record = mysql_num_rows($result);		//�Ѱ���

$total_page = (int)($total_record / $record_count);

if ($total_record % $record_count) {
	$total_page++;
}

$query2 = "select * from wo_leave $query_ment $sort_ment limit $record_start, $record_count";
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
<div class="new_tbl_wrap">
		<div class="list_top">
			<div class="sub_title" >�ް���û��</div>
			<? if ($type == 'list') { ?><a href='up_index.php?type=write' class="big cbtn black"><span class="material-symbols-outlined">add</span></a><? } ?>
		</div>
	</div>
<form name='form1' method='get' action='<?= $PHP_SELF ?>'>
	<input type="text" style="display: none;"> <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='uid' value='<?= $uid ?>'>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>


	<?
	include 'search.php';
	?>

	<div class="leave_wrap">
		<div class="tbl">
			<div class="tbl_tr tbl_tit_tr board_flex leave_row">				
				<div class="tbl_th board_title pc_only" >No.</div>
				<div class="tbl_th board_title pc_only" >�Ҽ�</div>
				<div class="tbl_th board_title pc_only" >����</div>
				<div class="tbl_th board_title" >��û��</div>
				<div class="tbl_th board_title" >�ް��Ⱓ</div>
				<div class="tbl_th board_title pc_only" >���뵵</div>
				<div class="tbl_th board_title" >���ο���</div>
				<div class="tbl_th board_title pc_only" >����</div>
			</div>
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
				<div class="tbl_tr tbl_tit_tr board_flex leave_row">
					
					<div class="tbl_td pc_only" onclick="reg_view('<?= $uid ?>');"><?= $uid ?></div>
					<div class="tbl_td pc_only" onclick="reg_view('<?= $uid ?>');"><?= $team ?></div>
					<div class="tbl_td pc_only " onclick="reg_view('<?= $uid ?>');"><?= $affil ?></div>
					<div class="tbl_td " onclick="reg_view('<?= $uid ?>');"><?= $name ?></div>
					<div class="tbl_td " onclick="reg_view('<?= $uid ?>');"><?= $daterange ?></div>
					<div class="tbl_td pc_only" onclick="reg_view('<?= $uid ?>');"><?= $gubun2 ?></div>
					<div class="tbl_td " onclick="reg_view('<?= $uid ?>');" style="font-weight:600; color: <? if ($status=='����') {echo "#0b0";} else if ($status == '�ݷ�') {echo "#f00";} else {echo "#777";}?>;"><?= $status ?></div>
					<div class="tbl_td pc_only" >
						<? if ($GBL_MTYPE == 'A' || $GBL_MTYPE == 'S') { ?>
						<a href="javascript:reg_del('<?= $uid ?>')" class='small cbtn black'>����</a> 
						<? } ?>
					</div>
				</div>
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

		</div>
	</div>
	


</form>


<?
$fName = '../../form1';
include '../../pageNum.php';
?>