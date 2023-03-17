

<style type='text/css'>
.pageNum *{-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box;}
.pageNum{
	padding:20px 0 10px 0;
	text-align:center;  
	padding: 24px 0;
	text-align: center;
	display: flex;
	align-items: center;
	justify-content: center;
}
.pageNum a,.pageNum strong{
	display:flex;
	align-items: center;
	justify-content: center;
	width:25px;
	height:25px;
	margin:0 6px;
	background-color: #e0eaff;
	border-radius:50%;
	font-size: 0.875rem;
}
.pageNum a{color:#003081;text-decoration:none!important}
/* .pageNum .this,.pageNum a:hover,.pageNum a:focus{color:#fff; background-color:#003081;} */
.pageNum .frst_last{color:#003081;}
.pageNum .this{color:#fff; background-color:#003081;}
.pageNum .direction{margin:0 4px;color:#003081;letter-spacing:0;font-weight:400; }
.pageNum strong.direction{color:#003081}
</style>



<div class="pageNum">
<?
if($total_record != '0'){
	if($total_record > $record_count){
		
		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
			echo ("<a href=javascript:pageing('$fName','$pre_group_start');><span class='material-symbols-outlined'>first_page</span></a> ");
		}else{
			echo ("<a href=javascript:pageing('$fName','$pre_group_start');><span class='material-symbols-outlined'>first_page</span></a> ");
		}


		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo ("<a href=javascript:pageing('$fName','$pre_page_start'); class='direction'><span class='material-symbols-outlined'>navigate_before</span></a> ");
		}else{
			echo ("<a href=javascript:pageing('$fName','$pre_page_start'); class='direction'><span class='material-symbols-outlined'>navigate_before</span></a> ");
		}






		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo ("<a href=javascript:pageing('$fName','$input_start');>$link</a> ");
				} else {
					echo ("<a href=javascript:pageing('$fName','$input_start'); class='frst_last this'>$link</a> ");
				}
			}
		}





		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo ("<a href=javascript:pageing('$fName','$next_page_start'); class='direction'><span class='material-symbols-outlined'>navigate_next</span></a> ");
		}else{
			$next_page_start = $record_start;
			echo ("<a href=javascript:pageing('$fName','$next_page_start'); class='direction'><span class='material-symbols-outlined'>navigate_next</span></a> ");
		}


		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
			echo("<a href=javascript:pageing('$fName','$next_group_start');><span class='material-symbols-outlined'>last_page</span></a>");
		}else{
			$next_group_start = $record_start;
			echo("<a href=javascript:pageing('$fName','$next_group_start');><span class='material-symbols-outlined'>last_page</span></a>");
		}



		  
	}else{
		echo ("<a href='#' class='frst_last this'>1</a>");
	}
}
?>
</div>
