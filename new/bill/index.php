<?
	$n_url = "./";
	//include ��� �ȸԾ ����
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
				<div class="list-title-text">�λ�</div>			
			</div>
			<div class="btn-wrap">
				<a href="/approval/proof/up_index.php?type=write">
					<div class="list-btn color-person">��������</div>
				</a>
				<a href="/approval/career/up_index.php?type=write">
					<div class="list-btn color-person">�������</div>
				</a>
				<a href="/approval/leave2/up_index.php?type=list">
					<div class="list-btn color-person">�ް� ��û��</div>
				</a>
				<a href="/new/bill/transition.php">
					<div class="list-btn color-person">�μ��ΰ輭</div>
				</a>		
				<a href="/approval/leave/up_index.php?type=list">
					<div class="list-btn deactivation">(��)�ް� ��û��</div>
				</a>		
				<a>
					<div class="list-btn deactivation">������ ��û</div>
				</a>
				<a>
					<div class="list-btn deactivation">ź�±ٹ���û</div>
				</a>
				<a>
					<div class="list-btn deactivation">�ٷνð�����<br />��û</div>
				</a>
				<a>
					<div class="list-btn deactivation">����/����<br />�ٹ���û</div>
				</a>
			</div>
		</div>

		<div class="list-wrap">
			<div class="list-title">
				<div class="list-title-text">�繫</div>
			</div>
			<div class="btn-wrap">
				<a href="/new/bill/write.php">
					<div class="list-btn finance">������</div>
				</a>
				<a href="/new/bill/transactionStatement.php">
					<div class="list-btn finance">�ŷ�����</div>
				</a>
				<a href="/new/bill/payment.php">
					<div class="list-btn finance">���û����</div>
				</a>
				<a href="/new/bill/contract.php">
					<div class="list-btn deactivation">��༭</div>
				</a>
				<a>
					<div class="list-btn deactivation">������Ǽ�</div>
				</a>
				<a>
					<div class="list-btn deactivation">���� ǰ�Ǽ�</div>
				</a>
				<a>
					<div class="list-btn deactivation">�������<br />��û</div>
				</a>
			</div>
		</div>

		<div class="list-wrap">
			<div class="list-title">				
				<div class="list-title-text">��������</div>			
			</div>
			<div class="btn-wrap">
				<a>
					<div class="list-btn deactivation">���� ���<br />���� ��û��</div>
				</a>
				<a>
					<div class="list-btn deactivation">���� ����<br />��û��</div>
				</a>
			</div>
		</div>

	</div>
	<!-- //approval_container-->
			<?
			include '../rightContent.php';
		?>

</div>

