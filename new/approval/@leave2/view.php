<?
$sessionId = $_SESSION['ses_id']; //���� �α������� ���
$sessionName = $_SESSION['ses_name'];

error_reporting(E_ALL);
ini_set("display_errors", 1);

$uid = $_GET['uid'];
$sql = "select * from wo_leave2 where uid=$uid";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$doc_num = $row['doc_num'];
$userid = $row['userid'];
$name = $row['name'];
$affil = $row['affil'];
$team = $row['team'];
$title = $row['title'];
$text = $row['text'];
$gubun = $row['gubun'];
$date1 = $row['date1'];
$sort1 = $row['sort1'];
$date2 = $row['date2'];
$sort2 = $row['sort2'];
$date_cnt = $row['date_cnt'];
$upfile01 = $row['upfile01'];
$realfile01 = $row['realfile01'];
$opinion  = $row['opinion'];
$agree1 = $row['agree1'];
$agree2 = $row['agree2'];
$agree3 = $row['agree3'];
$deal1 = $row['deal1'];
$deal2 = $row['deal2'];
$deal3 = $row['deal3'];
$status = $row['status'];
$reg_date = $row['reg_date'];


?>
<div class="title no-print">
	<div>
		<a href='up_index.php?type=list' class="big cbtn black">���</a>
	</div>
</div>
<div class="write-cont">
	<form name="frm" id="frm" method="get">
		<input type="hidden" name="uid" value="">
		<input type="hidden" name="type" value="">
		<input type="hidden" name="target" value="">
		<header>
			<h1>�ް���û��</h1>
			<div class="logo">
				<img src="/images/iweblogo.jpg" alt="�ΰ�">
			</div>
			<div class="submitWrap no-print">
				<!-- <a href="javascript:window.open('./printSet.php?mod=1&uid=<?= $uid ?>','ieprint','width=990,height=900,scrollbars=yes','_blank')" class="big cbtn blue">�μ��ϱ�</a> -->
				<a href="javascript:window.print();" class="big cbtn blue">�μ��ϱ�</a>
			</div>
		</header>

		<section>

			<div class="agreeForm">
				<table class="agreeTable">
					<tr>
						<th rowspan="3">��<br /><br />��</th>
						<th>�����</th>
						<?
						if ($agree1 != '') {
							$row1 = sqlRow("select userid, affil, name from wo_member where userid='$agree1'");
							echo "<th>" . $row1['affil'] . "</th>";
						}
						if ($agree2 != '') {
							$row2 = sqlRow("select userid, affil, name from wo_member where userid='$agree2'");
							echo "<th>" . $row2['affil'] . "</th>";
						}
						if ($agree3 != '') {
							$row3 = sqlRow("select userid, affil, name from wo_member where userid='$agree3'");
							echo "<th>" . $row3['affil'] . "</th>";
						}
						?>
					</tr>

					<tr>
						<td class="sign">
							<img src="/images/sign/<?= $userid ?>.png" onerror="javascript:this.src='/images/sign/stamp.png'" width="75" height="75" alt="stamp">
						</td>
						<? if ($agree1 != '') { ?>
							<td class="sign">
								<? if ($row['agree1_status'] == 2) echo '<img src="/images/sign/'.$row1['userid'].'.png" height="75" alt="stamp">'; ?>
								<select name="agree1_status" <? if ($row1['userid'] != $sessionId) echo "disabled"; ?>>
									<option value="0" <? if ($row['agree1_status'] == 0) echo "selected"; ?>>���</option>
									<option value="1" <? if ($row['agree1_status'] == 1) echo "selected"; ?>>�ݷ�</option>
									<option value="2" <? if ($row['agree1_status'] == 2) echo "selected"; ?>>����</option>
								</select>
							</td>
						<? }
						if ($agree2 != '') { ?>
							<td class="sign">
								<? if ($row['agree2_status'] == 2) echo '<img src="/images/sign/'.$row2['userid'].'.png" height="75" alt="stamp">'; ?>
								<select name="agree2_status" <? if ($row2['userid'] != $sessionId) echo "disabled"; ?>>
									<option value="0" <? if ($row['agree2_status'] == 0) echo "selected"; ?>>���</option>
									<option value="1" <? if ($row['agree2_status'] == 1) echo "selected"; ?>>�ݷ�</option>
									<option value="2" <? if ($row['agree2_status'] == 2) echo "selected"; ?>>����</option>
								</select>
							</td>
						<? }
						if ($agree3 != '') { ?>
							<td class="sign">
								<? if ($row['agree3_status'] == 2) echo '<img src="/images/sign/'.$row3['userid'].'.png" height="75" alt="stamp">'; ?>
								<select name="agree3_status" <? if ($row3['userid'] != $sessionId) echo "disabled"; ?>>
									<option value="0" <? if ($row['agree3_status'] == 0) echo "selected"; ?>>���</option>
									<option value="1" <? if ($row['agree3_status'] == 1) echo "selected"; ?>>�ݷ�</option>
									<option value="2" <? if ($row['agree3_status'] == 2) echo "selected"; ?>>����</option>
								</select>
							</td>
						<?} ?>
					</tr>

					<tr>
						<td style="font-size: 16px;"><?= $name ?></td>
						<?
						if ($agree1 != '') {
							echo '<td style="font-size: 16px;" class="agreeName">' . $row1['name'] . '</td>';
						}
						if ($agree2 != '') {
							echo '<td style="font-size: 16px;" class="agreeName">' . $row2['name'] . '</td>';
						}
						if ($agree3 != '') {
							echo '<td style="font-size: 16px;" class="agreeName">' . $row3['name'] . '</td>';
						}
						?>
					</tr>
				</table>

				<table class="dealTable" style="display: table;">
					<tr>
						<?
						if ($deal1 != '') {
							$row1 = sqlRow("select userid, affil, name from wo_member where userid='$deal1'");
							echo '<th rowspan="3">��<br /><br />��</th>';
							echo "<th>" . $row1['affil'] . "</th>";
						}
						if ($deal2 != '') {
							$row2 = sqlRow("select userid, affil, name from wo_member where userid='$deal2'");
							echo "<th>" . $row2['affil'] . "</th>";
						}
						if ($deal3 != '') {
							$row3 = sqlRow("select userid, affil, name from wo_member where userid='$deal3'");
							echo "<th>" . $row3['affil'] . "</th>";
						}
						?>
					</tr>

					<tr>
						<? if ($deal1 != '') { ?>
							<td class="sign">
								<select name="deal1_status" <? if ($row1['userid'] != $sessionId) echo "disabled"; ?>>
									<option value="0" <? if ($row['deal1_status'] == 0) echo "selected"; ?>>���</option>
									<option value="1" <? if ($row['deal1_status'] == 1) echo "selected"; ?>>�ݷ�</option>
									<option value="2" <? if ($row['deal1_status'] == 2) echo "selected"; ?>>����</option>
								</select>
							</td>
						<? }
						if ($deal2 != '') { ?>
							<td class="sign">
								<select name="deal2_status" <? if ($row2['userid'] != $sessionId) echo "disabled"; ?>>
									<option value="0" <? if ($row['deal2_status'] == 0) echo "selected"; ?>>���</option>
									<option value="1" <? if ($row['deal2_status'] == 1) echo "selected"; ?>>�ݷ�</option>
									<option value="2" <? if ($row['deal2_status'] == 2) echo "selected"; ?>>����</option>
								</select>
							</td>
						<? }
						if ($deal3 != '') { ?>
							<td class="sign">
								<select name="deal3_status" <? if ($row3['userid'] != $sessionId) echo "disabled"; ?>>
									<option value="0" <? if ($row['deal3_status'] == 0) echo "selected"; ?>>���</option>
									<option value="1" <? if ($row['deal3_status'] == 1) echo "selected"; ?>>�ݷ�</option>
									<option value="2" <? if ($row['deal3_status'] == 2) echo "selected"; ?>>����</option>
								</select>
							</td>
						<?} ?>
					<tr>
						<?
						if ($deal1 != '') {
							echo '<td style="font-size: 16px;" class="agreeName">' . $row1['name'] . '</td>';
						}
						if ($deal2 != '') {
							echo '<td style="font-size: 16px;" class="agreeName">' . $row2['name'] . '</td>';
						}
						if ($deal3 != '') {
							echo '<td style="font-size: 16px;" class="agreeName">' . $row3['name'] . '</td>';
						}
						?>
					</tr>
				</table>
			</div>

			<div class="submitForm">
				<h2>1. ��������</h2>
				<table class="formTable">
					<tr>
						<th>������ȣ</th>
						<td>
							<?= $doc_num ?>
						</td>
					</tr>
					<tr>
						<th>���ȵ��</th>
						<td>
							L2
						</td>
					</tr>
					<tr>
						<th>��������</th>
						<td>
							5��
						</td>
					</tr>
					<tr>
						<th>��������</th>
						<td>
							����
						</td>
					</tr>
				</table>
				<table class="formTable2">
					<tr>
						<th>�����</th>
						<td>
							<?= $name ?>
						</td>
					</tr>
					<tr>
						<th>����/��å </th>
						<td>
							<?= $affil ?>
						</td>
					</tr>
					<tr>
						<th style="letter-spacing: 2.5rem; text-align: right;">�μ�</th>
						<td>
							<?= $team ?>
						</td>
					</tr>
					<tr>
						<th>����ó</th>
						<td>
							�������
						</td>
					</tr>
				</table>

				<h2>2. ���γ���</h2>
				<table class="inputTable">
					<tr class="inputForm">
						<th style="letter-spacing: 2.5rem; text-align: right;">����</th>
						<td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="mainTitle" placeholder="����" readonly><?= $title ?></textarea></td>
					</tr>
					<tr class="inputForm">
						<th style="letter-spacing: 2.5rem; text-align: right;">����</th>
						<td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" placeholder="����" readonly><?= $text ?></textarea></td>
					</tr>
					<tr class="inputForm">
						<th>�ް����� </th>
						<?
						if ($gubun == 'H') {
							$gubun2 = '����';
						} else {
							$gubun2 = '����';
						}
						?>
						<td id="dayoff_wrap"><?= $gubun2 ?></td>
					</tr>
					<tr class="inputForm">
						<th style="letter-spacing: 2.5rem; text-align: right;">�Ⱓ</th>
						<td id="startdate_wrap">
							<span><?= $date1 ?> <?= $sort1 ?></span>
							<span <? if ($gubun == 'H') echo "style='display:none;'"; ?>> ~ </span>
							<span><?= $date2 ?> <?= $sort2 ?></span>
							<!-- <input id="daterange" type="text" name="daterange" value="" /> -->
							<!-- <input type="text" name="datepicker" id="datepicker" value=""/> -->
							<!-- <span class="no_print none_print">
								<span>(<?= $date_cnt ?></span>
								<span style="margin-right:10px;">��)</span>
							</span> -->
						</td>
					</tr>
				</table>
				
				<div class="etc-wrap no-print">
					<h2 class="etcTitle">
						3. ��Ÿ
						<span> (��µ��� �ʴ� �׸��Դϴ�.) <span>
					</h2>
					<table class="etcTable no-print">
						<tr>
							<th>÷���ڷ�</th>
							<td>
								<!-- <input type='file' name='upfile01' class='file03' style='width:213px;'><? if ($userfile01) { ?><br><input type='checkbox' name='del_upfile01' value='Y'>���� (<?= $realfile01 ?>)<? } ?> -->
							</td>
						</tr>
						<tr>
							<th style="letter-spacing: 2.5rem; text-align: right;">�ǰ�</th>
							<td>
								<?= $opinion ?>
								<!-- <textarea name="opinion" id="opinion" rows="1" class="title" placeholder="�ǰ�(����)"></textarea> -->
							</td>
						</tr>
					</table>
				</div>

				<table class="submitTable">
					<tr>
						<td colspan="2">
							<div class="tailContent">
								<p>���� ���� ǰ���Ͽ��� �簡 �Ͽ� �ֽñ� �ٶ��ϴ�.</p>
								<p id="today">
									<?= date('Y�� m�� d��', strtotime($reg_date)) ?>
								</p>
							</div>
						</td>
					</tr>
				</table>

			</div>
		</section>

		<footer>
			<h1 style="letter-spacing: 2.5rem;">�ֽ�ȸ�� ������</h1>
		</footer>
	</form>
</div>

<script>
	// const sign2 = document.querySelector("#agreeTr2 > td:nth-child(2) > div");
	// const sign3 = document.querySelector("#agreeTr2 > td:nth-child(3) > div");
	// const sign4 = document.querySelector("#agreeTr2 > td:nth-child(4) > div");
	// const sign5 = document.querySelector("#agreeTr2 > td:nth-child(5) > div");

	// const priority = () => {
	// 	if (sign2 != null && sign2.innerText != "����") {
	// 		if ($(sign2).children().val() == "����") {
	// 			return true;
	// 		} else {
	// 			return false;
	// 		}
	// 	} else if (sign3 != null && sign3.innerText != "����") {
	// 		if ($(sign3).children().val() == "����") {
	// 			return true;
	// 		} else {
	// 			return false;
	// 		}
	// 	} else if (sign4 != null && sign4.innerText != "����") {
	// 		if ($(sign4).children().val() == "����") {
	// 			return true;
	// 		} else {
	// 			return false;
	// 		}
	// 	} else if (sign5 != null && sign5.innerText != "����") {
	// 		if ($(sign5).children().val() == "����") {
	// 			return true;
	// 		} else {
	// 			return false;
	// 		}
	// 	} else {
	// 		return true;
	// 	}
	// }


	// function go_agree(uid) {
	// 	if (priority()) {
	// 		const form = document.FRM;
	// 		form.uid.value = uid;
	// 		form.type.value = 'agree';
	// 		form.action = 'proc2.php';
	// 		form.submit();
	// 	} else {
	// 		alert("���� ��� ���Դϴ�.");
	// 		return false;
	// 	}

	// }

	function edit_status(uid, target) {
		const form = document.frm;
		form.uid.value = uid;
		form.type.value = 'agree';
		form.target.value = target;
		form.action = 'proc.php';
		form.submit();
	}
	
	// ������ �ε�
	$(function() {
		$('.agreeForm select').on('change', (e) => {
			edit_status(<?= $uid ?>, e.target.name);
		})

	});
</script>