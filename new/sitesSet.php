<?
	$userid = $_SESSION['ses_id'];
	$sql = "select * from site_set where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

?>
<form name="frm01"  id="frm01" method='POST'>
	<input type="hidden" name='userid' value="<?=$_SESSION['ses_id']?>"/>
	<input type="hidden" name='type' value="<?=$type?>"/>
	<input type="hidden" name='uid' value="<?=$uid?>"/>

<div class="modal_wrap site_set_modal">
	<div class="pop_content">
		<div class="pop_inner">
			<div class="dp_sb dp_c">
				<p class="box_tit">���� ���� ����Ʈ</p>
				<div class="book_mark_head book_mark_head_modify">
					<span class="material-symbols-outlined modal_close">close</span>
				</div>
			</div>
			<div class="site_set_wrap">
				<p class="m_scroll_detail">�� ǥ�� �¿�� �����̽ø� �ڼ��ϰ� ���� �� �ֽ��ϴ�.</p>
				<div class="m_scroll_bar">
					<div class="list_tbl list_tbl_set">
						<div class="row dp_f dp_c">
							<div class="row_tit dp_f dp_c dp_cc">����Ʈ �̸�</div>
							<div class="row_tit dp_f dp_c dp_cc">����Ʈ �ּ�</div>
							<div class="row_tit dp_f dp_c dp_cc">���̵�</div>
							<div class="row_tit dp_f dp_c dp_cc">��й�ȣ</div>
							<div class="row_tit dp_f dp_c dp_cc"></div>
						</div>
						<?
						while($row = mysql_fetch_array($result)){
								$uid = $row['uid'];
								$siteName= $row['siteName'];	
								$url= $row['url'];	
								$id= $row['id'];	
								$pwd= $row['pwd'];	

						?>
						<div class="row dp_f dp_c">
							<div class="row_det dp_f dp_c dp_cc">
								<?=$siteName?>
							</div>
							<div class="row_det dp_f dp_c dp_cc">
								<a class="dp_f dp_c dp_cc" href="<?=$url?>" title="�ּ�"><?=$url?></a>
							</div>
							<div class="row_det dp_f dp_c dp_cc">
								<?=$id?>
							</div>
							<div class="row_det dp_f dp_c dp_cc">
								<?=$pwd?>
							</div>
							<div class="row_det dp_f dp_c dp_cc">
								<a class="row_delete dp_f dp_c dp_cc" href="javascript:reg_del(<?=$uid?>)" title="����">
									<span class="material-symbols-outlined">
									close
									</span>
								</a>
							</div>
						</div>

						<?}?>

					</div>
				</div>

				<p class="pop_sub_tit">�߰��ϱ�</p>
				<div class="write_tbl">
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">����Ʈ �̸�</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" id="siteName" name="siteName"></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">����Ʈ �ּ�</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" id="url" name="url"></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">���̵�</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" id="id" name="id"></div>
					</div>
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">��й�ȣ</div>
						<div class="row_det dp_f dp_c dp_cc"><input type="text" id="pwd" name="pwd"></div>
					</div>
				</div>

				<a class="btn_primary02" style="margin: 30px auto 10px;" onclick="chkBookMark2();">�߰� �ϱ�</a>
			</div>
		</div>
	</div>
</div>
</form>

<script>
		$(".site_setting").click(function(event) {
			$('.site_set_modal').fadeIn();
			$("html, body").addClass("not_scroll");
		});
		$(".site_set_modal .modal_close").click(function(event) {
			$('.site_set_modal').fadeOut();
			$("html, body").removeClass("not_scroll");
		});


		function chkBookMark2() {
			$('#frm01 [name=type]').val('write');
			$("#frm01").attr("action","./sites_proc.php").submit();
		}

		function reg_del(uid){
		//	form = $("#frm01");
			let result = confirm('�����Ͻðڽ��ϱ�?');

			if(result == true){
				$('#frm01 [name=type]').val('del');
				$('#frm01 [name=uid]').val(uid);
				$("#frm01").attr("action","./sites_proc.php").submit();
			} else {
			alert('���');
			}
			
		}
</script>