
			
			<!--profile_wrap -->
			<div class="profile_box">
				<div class="profile_wrap">
					<div class="profile_img" style="background-image: url('/new/images/no_img_per.png')"></div>
					<div class="profile_info_wrap">
						<?
							$sql = "select * from wo_member where userid='$GBL_USERID'";
							$result = mysql_query($sql);
							$row = mysql_fetch_array($result);

							$name = $row['name'];	//�̸�
							$team = $row['team'];	//��
							$affil = $row['affil'];	//����
						?>
						<div class="profile_info">
							<p><?=$name?></p>
							<div class="m_pro_flex">
								<p><?=$affil?> / <?=$team?></p>
								<p>���</p>
							</div>
						</div>
					</div>
				</div>
				<div class="dayoff_wrap">
					<p class="dp_f dp_c" style='color: #fff;'><span class="lnr lnr-calendar-full"></span>���� ������<span class="re_amt"><?=$ModOff?></span></p>
				</div>
				<div class="commute_wrap">
					<? if ($time_mod == 'out') { ?>
					<a style="color: #fff;" class="btn_primary02" href="javascript:time_chk('<?= $time_mod ?>');">���üũ
					<? } else { ?>
					<a style="color: #fff;" class="btn_primary02" href="javascript:time_chk('<?= $time_mod ?>');">���üũ
					<? } ?>
					</a>
				</div>
			</div>
			<!--//profile_wrap -->