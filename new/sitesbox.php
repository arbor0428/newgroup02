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
					���� ���� ����Ʈ
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
							<button class="copy_btn" id="copy_btn<?=$uid?>" onclick="clipboard(id)" title="���̵𺹻�" data-clipboard-text="<?=$id?>">ID</button> 
							<button class="copy_btn"  id="copy_btn<?=$uid?>" onclick="clipboard(id)" title="�н����庹��" data-clipboard-text="<?=$pwd?>">PWD</button>
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
					var clipboard = new ClipboardJS('#' + id);  // Ŭ������ ���� btn�� ��Ҹ� ����
					clipboard.on( 'success', function() {       // ���翡 �������� ��
					  // do something
					   alert( '���縦 �Ϸ��߽��ϴ�.' );
					} );
					clipboard.on( 'error', function() {         // ���翡 �������� ��
					  // do something
					  alert( '���縦 �����߽��ϴ�.' );
					} );
					}
					// $textarea
					//const myTextarea = document.getElementById("copy_text_input01");

					// button Ŭ�� �̺�Ʈ
					//document.getElementById("copy_btn01").onclick = () => {
					  // textarea�� ������ �����Ѵ�.
					  //window.navigator.clipboard.writeText(myTextarea.value).then(() => {
						// ���簡 �Ϸ�Ǹ� ȣ��ȴ�.
					//	alert("����Ϸ�");
					 // });
				//	};


				//$('#copy_btn02').click(function(e){
					//e.preventDefault()
					//$(this).siblings('#copy_text_input02').select(); //������ �ؽ�Ʈ�� ����
					//document.execCommand("copy"); //Ŭ������ ���� ����
					//alert('����Ϸ�');
			//	});
			</script>

			<?
				include 'sitesSet.php';
			?>