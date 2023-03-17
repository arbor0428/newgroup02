<link rel='stylesheet' type='text/css' href='./css/style.css'>
<script language='javascript'>
function Admin_Login(){
	form = document.LOG;

	if(form.userid.value==''){
		alert('아이디를 입력해 주십시오');
		form.userid.focus();
		return;
	}

	if(form.pwd.value==''){
		alert('비밀번호를 입력해 주십시오');
		form.pwd.focus();
		return;
	}

	form.submit();

}

function is_Key(){
	if(event.keyCode==13)	Admin_Login();
}
</script>


<body onload="document.LOG.userid.focus();">

<style>
	.login_wrap {
		width: 100%;
		height: 100vh;
		display: flex;

	}
	.login_left {
		width: 40%;
		display: flex;
    align-items: center;
    justify-content: center;
		background-color: #003081;
	}
	.login_right {
		width: 60%;
		display: flex;
		align-items: center;
    justify-content: center;
    flex-direction: column;
	}
	.login_input_wrap {
		width: 50%;
		margin: 0 auto;
	}
	.login_input_wrap h2 {
		text-align: center;
		color: #003081;
	}
	.input_row {
		width: 100%;
		position:relative;
		border: 1px solid #003081;
		border-radius: 4px;
		margin-bottom: 30px;
	}
	.input_name {
		position: absolute;
		top: -16px;
		left: 15px;
		background-color: #fff;
		color: #003081;
		font-size: 20px;			
	}
	.input_row input {
		width: 100%;
    padding: 10px;
    height: 60px;
	}
	.input_row input:focus {
		outline :none;
	}

	.login_btn {
		width: 100%;
	}
	.login_btn a {
		display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #003081;
    border-radius: 4px;
    background-color: #003081;
    padding: 15px;
    color: #fff;
    font-size: 20px;
    font-weight: 700;
	}
	@media (max-width:760px){ 
		.login_wrap {
			flex-direction: column;
		}
		.login_left {
			width: 100%;
		}
		.login_right {
			width: 100%;
		}
		.login_left img {
			height: 120px;
		}
		.login_input_wrap {
			width: 90%;
			margin: 70px auto;
		}

	}
</style>

<form name='LOG' method='post' action='./login_proc.php'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
		
	<div class="login_wrap">
		<div class="login_left">
			<img src="/new/images/logo.png">
		</div>
		<div class="login_right">
		
			<div class="login_input_wrap">
				<h2>LOGIN</h2>
				<div class="input_row">
					<div class="input_name">ID</div>
					<input type='text' name='userid' value='<?=$userid?>' onKeypress='is_Key();'>
				</div>

				<div class="input_row">
					<div class="input_name">PWD</div>
					<input type='password' name='pwd' value='<?=$pwd?>'  onKeypress='is_Key();'>
				</div>

				<div class="login_btn">
					<a href="javascript:Admin_Login();">LOGIN</a>
				</div>

			</div>
		</div>
	</div>


			
</form>
