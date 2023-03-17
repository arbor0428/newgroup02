		<div class="content_head">
			<div class="m_menu">
				<div class="m_menu_bar"></div>
				<div class="m_menu_bar"></div>
				<div class="m_menu_bar"></div>
			</div>
			<div class="search_box pc_search_box">
				<input type="text" placeholder="Search...">
				<button type="button" onclick="">
					<span class="material-symbols-outlined">
					search
					</span>
				</button>
			</div>
			<div class="dp_f dp_c">
				<div class="mini_alert_wrap dp_f dp_c dp_cc">
					<div class="mini_alert dp_f dp_c dp_cc">
						<span class="material-symbols-outlined">
						notifications
						</span>
						<!--제일 마지막 로그아웃 기준으로 새로운 업무요청이 도착해있을 경우 display: block처리--->
							<?
								$to_y = date('Y');
								$to_m = date('m');
								$to_d = date('d');

								$sql2 = "select * from wo_timechk where userid='$GBL_USERID' and to_y='$to_y' and to_m='$to_m' and to_d='$to_d' order by uid desc limit 1";
								$result2 = mysql_query($sql2);
								$num = mysql_num_rows($result2);

								if($num){
									$row2 = mysql_fetch_array($result2);
									$in_date = $row2['in_date'];
									$out_date = $row2['out_date'];
									$name = $row2['name'];
								
								}


								$sql = "select * from wo_job where name='$GBL_NAME' ";
								$result = mysql_query($sql);
								$row = mysql_fetch_array($result);
								$reg_date = $row['reg_date'];
							?>

							<?
								if($out_date && $out_date < $reg_date){
							?>
								<div class="alert_chk" style="display: block;"></div>		
							<?} else {?>
								<div class="alert_chk" style="display: none;"></div>
							<?}?>
					</div>
				</div>

				<div class="commute_wrap">
					<? if ($time_mod == 'out') { ?>
					<a style="color: #ffff; padding: 10px 30px;" class="btn_primary02" href="javascript:time_chk('<?= $time_mod ?>');">퇴근체크
					<? } else { ?>
					<a style="color: #ffff; padding: 10px 30px;" class="btn_primary02" href="javascript:time_chk('<?= $time_mod ?>');">출근체크
					<? } ?>
					</a>

					<?
					if ($GBL_USERID) {
					?>
					<a href="/logout_proc.php" class="logout_btn dp_f dp_c dp_cc" title="로그아웃" ><!-- 로그아웃 --><span class="material-symbols-outlined">logout</span></a>
					<?
					}
					?>
				</div>
			</div>
		</div>

		<script>
			//topheader 스크롤시 고정
			$(window).scroll(function(){

				var ovmScroll= $(document).scrollTop();

				if(0<ovmScroll){
					$('.content_head').addClass("on");
					$('.main_content_right').addClass("active");
				}else{
					$('.content_head').removeClass("on");
					$('.main_content_right').removeClass("active");
				}

			});

			$(".content_head .m_menu").on("click", function () {
				$('.header').addClass("m_active");
				$('.header .m_header_bg').fadeIn();
			});

			$(".m_header_top .m_close_btn").on("click", function () {
				$('.header .m_header_bg').fadeOut();
				$('.header').removeClass("m_active");
			});
		</script>