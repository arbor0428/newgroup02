<?
	$userid = $_SESSION['ses_id'];
	$sql = "select * from main_phone where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

?>
			
			<div class="parking_wrap">
				<div class="box_tit dp_sb dp_f">
					<p class="dp_f dp_c">
					<span class="material-symbols-outlined">
					phone_in_talk
					</span>
					대표번호
					</p>
					<span class="material-symbols-outlined numbers_setting" style="cursor:pointer; margin-right: 0;">settings</span>
				</div>
				<ul class="list_ex_wrap">

					<?
						while($row = mysql_fetch_array($result)){
								$uid = $row['uid'];
								$phoneName= $row['phoneName'];	
								$phoneNum= $row['phoneNum'];	

					?>
					<li class="dp_c dp_sb">
						<p><?=$phoneName?></p> 
						<p class="dp_c dp_f"><?=$phoneNum?></p>
					</li>

					<?
						}
	
					?>
				<ul>
			</div>

			<?
				include 'numbersSet.php';
			?>