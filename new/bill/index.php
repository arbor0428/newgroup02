<?
	$n_url = "./";
	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

?>


<div class="wrap">
	<?
		include "../top_header.php";
	?>

	<div class="approval_container">
		<div class="list-wrap">
			<div class="list-title">			
				<div class="list-title-text">인사</div>			
			</div>
			<div class="btn-wrap">
				<a href="/approval/proof/up_index.php?type=write">
					<div class="list-btn color-person">재직증명서</div>
				</a>
				<a href="/approval/career/up_index.php?type=write">
					<div class="list-btn color-person">경력증명서</div>
				</a>
				<a href="/approval/leave2/up_index.php?type=list">
					<div class="list-btn color-person">휴가 신청서</div>
				</a>
				<a href="/new/bill/transition.php">
					<div class="list-btn color-person">인수인계서</div>
				</a>		
				<a href="/approval/leave/up_index.php?type=list">
					<div class="list-btn deactivation">(구)휴가 신청서</div>
				</a>		
				<a>
					<div class="list-btn deactivation">경조사 신청</div>
				</a>
				<a>
					<div class="list-btn deactivation">탄력근무신청</div>
				</a>
				<a>
					<div class="list-btn deactivation">근로시간단축<br />신청</div>
				</a>
				<a>
					<div class="list-btn deactivation">휴일/연장<br />근무신청</div>
				</a>
			</div>
		</div>

		<div class="list-wrap">
			<div class="list-title">
				<div class="list-title-text">재무</div>
			</div>
			<div class="btn-wrap">
				<a href="/new/bill/write.php">
					<div class="list-btn finance">견적서</div>
				</a>
				<a href="/new/bill/transactionStatement.php">
					<div class="list-btn finance">거래명세서</div>
				</a>
				<a href="/new/bill/payment.php">
					<div class="list-btn finance">대금청구서</div>
				</a>
				<a href="/new/bill/contract.php">
					<div class="list-btn deactivation">계약서</div>
				</a>
				<a>
					<div class="list-btn deactivation">지출결의서</div>
				</a>
				<a>
					<div class="list-btn deactivation">구매 품의서</div>
				</a>
				<a>
					<div class="list-btn deactivation">경비지급<br />요청</div>
				</a>
			</div>
		</div>

		<div class="list-wrap">
			<div class="list-title">				
				<div class="list-title-text">업무지원</div>			
			</div>
			<div class="btn-wrap">
				<a>
					<div class="list-btn deactivation">문서 등록<br />승인 요청서</div>
				</a>
				<a>
					<div class="list-btn deactivation">문서 승인<br />요청서</div>
				</a>
			</div>
		</div>

	</div>
	<!-- //approval_container-->
			<?
			include '../rightContent.php';
		?>

</div>

