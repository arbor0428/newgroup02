
<style>
  textarea:focus {
    outline: none;
  }

  .i_post {
	position: relative;
   /*  background-image: url("/images/memo_bg.png"); */
    background-color: #fff;
    width: 100%;
	padding: 15px;
	box-sizing: border-box;
	margin-bottom: 10px;
    overflow-y: scroll;
    border-radius: 4px;
    word-break: break-all;
    scrollbar-3dLight-Color: #F6F3C6;
    scrollbar-arrow-color: #F6F3C6;
    scrollbar-base-color: #F6F3C6;
    scrollbar-Face-Color: #f8dc7e;
    scrollbar-Track-Color: #F6F3C6;
    scrollbar-DarkShadow-Color: #F6F3C6;
    scrollbar-Highlight-Color: #F6F3C6;
    scrollbar-Shadow-Color: #F6F3C6;
    -ms-overflow-style: none;
    /*ie용 스크롤바 자동숨김*/       
    color: #333;    
		box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
  }

  /*크롬 투명 스크롤*/
  .scrollable-content {
    overflow-x: hidden;
    overflow-y: scroll;
  }

  .scrollable-content::-webkit-scrollbar {
    width: 0;
  }

  .scrollable-content::-webkit-scrollbar * {
    background: transparent;
  }

  .scrollable-content::-webkit-scrollbar-thumb {
    background: transparent !important;
  }

  .memo_area {
  	display: block;
    padding: 5px;
    width: 100%;
    height: 180px;
    border: 0px;
	border-radius: 0;
    font-size: 14px;
    line-height: 23px;
    color: #111;
	background-color: #e0eaff;
  }


  .m_save {
    display: block;
    width: 100%;
    line-height: 40px;
    color: #003081;
	border-radius: 0 0 4px 4px;
    border: 1px solid #ddd;
    text-align: center;
    font-weight: 600;
	box-sizing:border-box;
    padding-bottom: 3px;
    font-size: 14px;
    cursor: pointer;
	transition: all 0.3s;
  }
  .m_save .lnr-pencil {
	    color: #003081;
		font-weight: bold;
		margin-right: 10px;
  }

  .m_save:hover {
    border: 1px solid #49597a;
	color: #fff;
	background-color: #49597a;
  }
    .m_save:hover .lnr-pencil {
		color:#fff;
	}
	.m_tab_wrap .m_tab_box {display: none;}
	.m_tab_wrap .m_tab_box:nth-child(1) {display: block;}
	.m_tab_btn li {width: 33.333%; height: 30px; border: 1px solid #ddd; border-right: none; cursor: pointer; font-size: 0.75rem;}
	.m_tab_btn li:first-child {border-radius: 4px 0 0 0;}
	.m_tab_btn li:last-child {border-radius: 0 4px 0 0; border-right: 1px solid #ddd;}
	.m_tab_btn li.on {background-color:#003081; border: 1px solid #003081; color: #fff;}
@media (max-width:1400px){
	.i_post {
		padding: 15px 10px;
	}
}

@media (max-width:1360px){
	.i_post {display: none;}
}
</style>

<script>
	  function memoChk(id) {
		form = document.frm_memo;
		//id = $('#'+id);
		
		if (id.includes('memoTxt01')){
			form.target = 'ifra_memo';
			form.action = '/module/memo_proc01.php';
			console.log(id);
		}
		if (id.includes('memoTxt02')){
			form.target = 'ifra_memo';
			form.action = '/module/memo_proc02.php';
			console.log(id);
		}
		 if (id.includes('memoTxt03')){
			form.target = 'ifra_memo';
			form.action = '/module/memo_proc03.php';
			console.log(id);
		}

		form.submit();
		$(".m_save").html('저장완료');
	  }

  $(function() {
	  $(".memoTxt").each(function() {
		$(this) .on("keyup", function() {
			$(".m_save").text('자동 저장중');
		}); 
	  });
    /*$(".memoTxt").on("keyup", function() {
      $(".m_save").text('자동 저장중');
    });*/
	$(".memoTxt").each(function() {
		$(this) .on("focusout", function(e) {
			let id = e.target.id;

			memoChk(id);
		}); 
	  });
    

    $(".m_tab_btn > li").on("click",function(event){

        event.preventDefault();

        let tabNumber = $(this).index();

        $(".m_tab_btn > li").removeClass("on");
        $(this).addClass("on");

        $(".m_tab_wrap .m_tab_box").hide();
        $(".m_tab_wrap .m_tab_box").eq(tabNumber).stop().fadeIn();

    });
  });
</script>

<form name='frm_memo' method='post'>
  <input type='text' style='display:none;'>
  <input type='hidden' name='userid' value='<?= $GBL_USERID ?>'>
  <div class="i_post scrollable-content clearfix">
  	<p class="box_tit dp_sb dp_c" style="margin-bottom: 10px;">
		메모장
		<span class="material-symbols-outlined memo_mark_setting" style="cursor:pointer;">settings</span>
	</p>
	<ul class="m_tab_btn dp_f dp_c">
		<li class="on dp_f dp_c dp_cc">메모1</li>
		<li class="dp_f dp_c dp_cc">메모2</li>
		<li class="dp_f dp_c dp_cc">메모3</li>
	</ul>
	<div class="m_tab_wrap">
		<div class="m_tab_box">
		<?
			$sql = "select * from wo_memo01 where userid='$GBL_USERID'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if ($num) {
			  $row = mysql_fetch_array($result);
			  $memoTxt01 = $row['ment'];

			  if ($memoTxt01) {
				$memoTxt01 = str_replace("&nbsp;", " ", $memoTxt01);
				$memoTxt01 = str_replace("&lt;", "<", $memoTxt01);
				$memoTxt01 = str_replace("&gt;", ">", $memoTxt01);
				$memoTxt01 = str_replace("&quot;", "\"", $memoTxt01);
				$memoTxt01 = str_replace("&#124;", "\|", $memoTxt01);
				$memoTxt01 = str_replace("<br><br>", "\r\n\r\n", $memoTxt01);
				$memoTxt01 = str_replace("<BR>", "\r\n", $memoTxt01);
			  }
			}
			?>
			<textarea name='memoTxt01' id='memoTxt01' class="memoTxt memo_area scrollable-content" placeholder="메모입력"><?= $memoTxt01 ?></textarea>
			<div class="m_save" onclick="memoChk();"><span class="lnr lnr-pencil"></span>자동 저장중</div>
		</div>
		<?
			$sql = "select * from wo_memo02 where userid='$GBL_USERID'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if ($num) {
			  $row = mysql_fetch_array($result);
			  $memoTxt02 = $row['ment'];

			  if ($memoTxt02) {
				$memoTxt02 = str_replace("&nbsp;", " ", $memoTxt02);
				$memoTxt02 = str_replace("&lt;", "<", $memoTxt02);
				$memoTxt02 = str_replace("&gt;", ">", $memoTxt02);
				$memoTxt02 = str_replace("&quot;", "\"", $memoTxt02);
				$memoTxt02 = str_replace("&#124;", "\|", $memoTxt02);
				$memoTxt02 = str_replace("<br><br>", "\r\n\r\n", $memoTxt02);
				$memoTxt02 = str_replace("<BR>", "\r\n", $memoTxt02);
			  }
			}
			?>
		<div class="m_tab_box">
			<textarea name='memoTxt02' id='memoTxt02' class="memoTxt memo_area scrollable-content" placeholder="메모입력"><?= $memoTxt02 ?></textarea>
			<div class="m_save" onclick="memoChk();"><span class="lnr lnr-pencil"></span>자동 저장중</div>
		</div>
		<?
			$sql = "select * from wo_memo03 where userid='$GBL_USERID'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if ($num) {
			  $row = mysql_fetch_array($result);
			  $memoTxt03 = $row['ment'];

			  if ($memoTxt03) {
				$memoTxt03 = str_replace("&nbsp;", " ", $memoTxt03);
				$memoTxt03 = str_replace("&lt;", "<", $memoTxt03);
				$memoTxt03 = str_replace("&gt;", ">", $memoTxt03);
				$memoTxt03 = str_replace("&quot;", "\"", $memoTxt03);
				$memoTxt03 = str_replace("&#124;", "\|", $memoTxt03);
				$memoTxt03 = str_replace("<br><br>", "\r\n\r\n", $memoTxt03);
				$memoTxt03 = str_replace("<BR>", "\r\n", $memoTxt03);
			  }
			}
			?>
		<div class="m_tab_box">
			<textarea name='memoTxt03' id='memoTxt03' class="memoTxt memo_area scrollable-content" placeholder="메모입력"><?= $memoTxt03 ?></textarea>
			<div class="m_save" onclick="memoChk();"><span class="lnr lnr-pencil"></span>자동 저장중</div>
		</div>
	</div>

  </div>

</form>

<iframe name='ifra_memo' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>

<?
	include './memoSet.php';
?>