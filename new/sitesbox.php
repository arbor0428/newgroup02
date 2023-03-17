<?
	$userid = $_SESSION['ses_id'];
	$sql = "select * from site_set where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

?>
			
			<div class="parking_wrap">
				<div class="box_tit dp_sb dp_f">
					<p class="dp_f dp_c">
					<span class="material-symbols-outlined">
					captive_portal
					</span>
					자주 가는 사이트
					</p>
					<span class="material-symbols-outlined site_setting" style="cursor:pointer; margin-right: 0;">settings</span>
				</div>
				<ul class="list_ex_wrap list_go">
					<?
						while($row = mysql_fetch_array($result)){
								$uid = $row['uid'];
								$siteName= $row['siteName'];	
								$url= $row['url'];	
								$id= $row['id'];	
								$pwd= $row['pwd'];	

					?>
					<li class="dp_c dp_sb">
						<a class="parking_link" href="<?=$url?>" target='_blank'><?=$siteName?>
							<span class="material-symbols-outlined">open_in_new</span>
						</a>
						<div class="dp_f dp_c">
							<button class="copy_btn" id="copy_btn<?=$uid?>" onclick="clipboard(id)" title="아이디복사" data-clipboard-text="<?=$id?>">ID</button> 
							<button class="copy_btn"  id="copy_btn<?=$uid?>" onclick="clipboard(id)" title="패스워드복사" data-clipboard-text="<?=$pwd?>">PWD</button>
						</div>
					</li>

					<?
						}
	
					?>
				</ul>
			</div>
			<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
			<script>
					function clipboard (id) {
					console.log(id);
					var clipboard = new ClipboardJS('#' + id);  // 클래스의 값이 btn인 요소를 복사
					clipboard.on( 'success', function() {       // 복사에 성공했을 때
					  // do something
					   alert( '복사를 완료했습니다.' );
					} );
					clipboard.on( 'error', function() {         // 복사에 실패했을 때
					  // do something
					  alert( '복사를 실패했습니다.' );
					} );
					}
					// $textarea
					//const myTextarea = document.getElementById("copy_text_input01");

					// button 클릭 이벤트
					//document.getElementById("copy_btn01").onclick = () => {
					  // textarea의 내용을 복사한다.
					  //window.navigator.clipboard.writeText(myTextarea.value).then(() => {
						// 복사가 완료되면 호출된다.
					//	alert("복사완료");
					 // });
				//	};


				//$('#copy_btn02').click(function(e){
					//e.preventDefault()
					//$(this).siblings('#copy_text_input02').select(); //복사할 텍스트를 선택
					//document.execCommand("copy"); //클립보드 복사 실행
					//alert('복사완료');
			//	});
			</script>

			<?
				include 'sitesSet.php';
			?>