<?

include $_SERVER["DOCUMENT_ROOT"]."/module/class/class.Msg.php";
include $_SERVER["DOCUMENT_ROOT"]."/module/class/class.DbCon.php";
include $_SERVER["DOCUMENT_ROOT"].'/new/header.php';

if (!$type)  $type = 'list';
?>

<link rel="stylesheet" href="./css/leave.style.css?v=1.1">
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<style>
	.dealTable,
	.deal-sign {
		display: none;
	}

	.deal-sign-btn {
		margin-right: 10px;
		font-size: 0.8rem;
		color: #222;
		cursor: pointer;
		background-color: var(--main-bg-color);
		display: inline-block;
		padding: 2px 4px;
		border-radius: 2px;
	}

	.formTable th,
	.formTable2 th,
	.inputTable th,
	.etcTable th {
		letter-spacing: 0.5rem;
		text-align: center;
	}

	.fpicker {
		width: 150px;
		background: url(/images/cals.jpg) no-repeat;
		background-color: #fff !important;
		background-position: calc(100% - 5px) center;
		cursor: pointer;
	}

	.form-control {
		height: 36px !important;
		padding: 0.375rem 0.75rem;
		font-size: 1rem;
		font-weight: 400;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #d1d3e2;
		border-radius: 0.35rem;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
	}

	.datepicker-count {
		width: 50px;
		text-align: center;
	}

	.fpickerafter {
		width: 80px;
	}

	.modOff {
		color: #f00;
		font-size: 13px;
	}

	.datepicker {
		width: 210px;
		height: 270px;
	}
</style>
<div class="main">
	<?
		include $_SERVER["DOCUMENT_ROOT"]."/new/top_header.php";
	?>
	

<!-- <table width="1200" border="0" cellspacing="0" cellpadding="0" align='center' class="no-print">
	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='50%'>
						<span style="font-size:20px;font-weight:800;margin-left:8px;">»ﬁ∞°Ω≈√ªº≠</span>
					</td>
					<td width='50%' align='right' valign='bottom'></td>
				</tr>
			</table>
		</td>
	</tr>
</table> -->
<div class="mobile_col_wrap">
	<div class="content_wrap">  
		<div class="main_content_left_sub leave_wraps">
			
			<?
			$calSize = 'medium';

			switch ($type) {
				case 'list':
					include 'list.php';
					break;

				case 'view':
					include 'view.php';
					break;

				case 'write':
					include 'write.php';
					break;

				case 'edit':
					include 'edit.php';
					break;
				}
			?>
		</div>	
		<?
		//	include include $_SERVER["DOCUMENT_ROOT"].'/new/rightContent.php';
		?>
			
	</div>
	<!-- // content_wrap -->

</div>