<?
	$n_url = "./";

	//include ��� �ȸԾ ����
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";


?>
<style>
/***********************
      ��༭
************************/
.contract_content {
  width: 100%;
  margin-bottom: 50px;
}
.contract_content ul li {
  list-style: decimal;
  word-break: keep-all;
}
.list_row {
  display: flex;
}
.list_row p {
  margin: 0;
}
.list_row_inner p {
  width: 100%;
  display: flex;
}
.list_row_inner input[type="text"] {
  width: 100px;
  font-size: 16px;
}
.company_name_wrap input {
  width: 100px;
}
.underline {
  text-decoration: underline;
}
.bill_sub_title {
  font-size: 20px;
  font-weight: 700;
}
	.wrap {
	  width: calc(100% - 250px);
    min-height: 100vh;
    padding-bottom: 20px;
    margin-left: auto;
    background-color: #fff;
	}
	input[type="text"]{
		text-align: center;
		font-size:18px;
	}
</style>

<div class="wrap">
	<?
		include "../top_header.php";
	?>

	<div class="bill">
		<img src="/images/iweblogo.jpg" class="logo2" />
		<div class="bill_title">
			<input
				type="text"
				name="biil_title"
				value="Ȩ������ ���� ��༭"
				placeholder=""
			/>
		</div>
		<div class="contract_content">
			<ul>
				<li>
					<p>
						��ళ��: ��
						<span class="bold company_name_wrap">
							<input
								type="text"
								id=""
								class="bold company_name"
								placeholder="��ü�̸� �Է�"
								onkeydown="putCommpanyName(event)"
								onchange="putCommpanyName(event)"
							/>
						</span>
						�� �� Ȩ������ ����
					</p>
				</li>

				<li>
					<div class="list_row">
						���ݾ�: ���ۺ� :
						<div class="list_row_inner">
							<p class="input_row">
								�ϱ�
								<input
									type="text"
									class="price_han"
									placeholder="�ڵ���ȯ"
								/>�� (\
								<input
									type="text"
									class="contract_price"
									placeholder="�ݾ� �Է�"
									onchange="putPrice(event); transHanPrice(event)"
								/>
								/ �ΰ�������)
							</p>
							<p class="bold">
								�� ���������
								<input
									type="text"
									id=""
									class="bold"
									placeholder="�ݾ� �Է�"
								/>
								�� ���� û������(��༭ �� ���Ի���)
							</p>
						</div>
					</div>
				</li>

				<li>
					<div class="">
						<p>���Ⱓ(���۱Ⱓ)</p>
						<p>
							�� ��༭�� ��� ü���Ϸκ��� 30��(�ٹ��� ����)������ �ϰ�,
							���Ⱓ(���۱Ⱓ)�� ���� �����Ͽ� ���� Ȥ�� ����� �� �ִ�.
							���Ҿ� ���ں����� Ȩ������ ���� �Ϸ� �� 6������ �Ѵ�. ��, ���
							ü������ �Ⱓ�� ���Խ�Ű�� ����.
						</p>
					</div>
					<div>
						���� ��࿡ ���Ͽ� Ȩ������ ������ �Ƿ��� ��
						<span class="bold">
							<input
								type="text"
								id=""
								class="bold company_name"
								placeholder="�ڵ� �Է�"
							/>
						</span>

						�� Ȩ������ ����, ��ġ �� �뿪�� ������ ��(��)���������� ��÷
						������� �� �����ȹ���� �������� �Ͽ� �� ����� ü���ϰ� �ֹ�
						��� ������ ���� ���� 2�θ� �� ���ŷ� ���� 1�ξ� �����Ѵ�
					</div>
				</li>
			</ul>
		</div>

		<div class="contract_content">
			<div class="bill_title">�� �� �� ��</div>
			<ul>
				<li>
					<div>
						<span class="bold input_parents">
							��<input
								type="text"
								class="bold company_name"
								placeholder="�ڵ� �Է�"
							/>��
						</span>
						(���� "��"�̶� �Ѵ�)�� <span class="bold">���߾�������</span>(����
						"��"�̶� �Ѵ�)�� �Ʒ��� ���� Ȩ�� ���� ���� �� ��뿡 ���� �����
						ü���Ѵ�
					</div>
				</li>
			</ul>

			<p class="bill_sub_title">�� 1 �� ���۱Ⱓ �� ���Ⱓ</p>

			<ul>
				<li>
					<div>
						Ȩ������ ���� �Ⱓ��
						<span class="bold underline">����Ϸκ��� 30��</span>�� �ϰ�,
						���Ⱓ(���۱Ⱓ)�� ���� �����Ͽ� ���� Ȥ�� ����� �� �ִ�. ��,
						�������� ���������� �ڷḦ �������� ���Ͽ� Ȩ������ ���ۿ� �ݿ�����
						�ʾ� ������ ���뿡 ���� å���� ���������� ������, ���� �߰� �����ϴ�
						���� ��Ģ���� �Ѵ�.
					</div>
				</li>
				<li>
					<div>
						��Ÿ ������ ���Ͽ� Ȩ������ ������ �ټ� �����Ǵ� ���, "��" ��
						"��"�� ���� �Ŀ� ������ ������ �� �ִ�.
					</div>
				</li>
			</ul>

			<p class="bill_sub_title">�� 2 �� ��� ���� ���</p>
			<ul>
				<li>����ڰ� �ŷ��� ���ݰ��� �Ǵ� ī������� ��Ģ���� �Ѵ�.</li>
				<li>��������� �Ʒ��� ���� �����Ѵ�.</li>
				<li>
					���۰�� ��<input
						type="text"
						id=""
						class="price_per"
						onkeydown="price_per(event)"
						placeholder="% �Է�"
					/>% �ݾ��� �ϱ�
					<input
						type="text"
						class="price_percent_han"
						placeholder="�ڵ���ȯ"
					/>�� (\
					<input type="text" class="price_percent" id="" placeholder="�ڵ��Է�"/>
					/ �ΰ�������) ���� Ȩ������ �Ϸ� �˼� �� �ܱ�
					<input
						type="text"
						id=""
						class="price_per2"
						onkeydown="price_per(event)"
						placeholder="% �Է�"
					/>

					% �ϱ�
					<input
						type="text"
						class="price_percent_han2"
						placeholder="�ڵ���ȯ"
					/>
					(\
					<input type="text" class="price_percent2" id="" placeholder="�ڵ��Է�" />
					/�ΰ�������)��

					<input type="text" placeholder="�� �Է�" />�� �̳��� �����Ѵ�.
				</li>
				<li>
					��������� ������ ��� ��ü��� �����ܱ��� 1�� 1/100�� ���� ��
					�ݾ��� �����Ͽ��� �Ѵ�.
				</li>
				<li>
					�������� �������� ������ �ڷḦ ������� Ȩ������ �۾��� �ּ��� ���Ͽ�
					��ǰ������ ���߸� ���� ������ ������ ���� ��� ��ü��������� �ܱ���
					1�� 1/100���� �����Ѵ�.
				</li>
				<li>
					�������� ����� ��å���� ���ϸ� ����� ������ �̷������ �ʾ��� ���
					�������� ���������� �����޵� �ݾ��� ��ȯ�Ѵ�.
				</li>
				<li>���������� �������� ��������ϸ� ����� �������� �����Ѵ�.</li>
			</ul>

			<p class="bill_sub_title">�� 3 �� �뿪�� ����</p>
			<ul>
				<li>
					�������� ���������� �Ƿ��� �뿪�� ������ �������� Ȩ������ ������������
					���� �� ��뿡 ���� ���ں����Ⱓ�� �������� �� �׿� ���ݵǴ� ����
					������ �Ѵ�.
				</li>
				<li>
					���ۿ� ���� �˼��� �ڵ��۾� ���� �� 1ȸ ������ �ϸ� Ȩ������
					�������� ���� �� 1ȸ Ȩ������ �˼��� �����Ͽ� ����/�����Ѵ�.
					�ϹݰԽù�DATA(�Խù��� ��ϵǴ� �ڷ�)�� ������ ����� �������� ����
					����ϵ��� �Ѵ�.
				</li>
				<li>
					Ȩ������ ���� �Ϸ� �� ���� �� ���ۿ� ���� �������� ���� ��û�� �ִ�
					��� ��ȣ���� �Ͽ� ������ ����� �����Ѵ�.
				</li>
			</ul>
			<p class="bill_sub_title">�� 4 �� �������</p>
			<p>
				�� ���� �����Ͽ� ��ȣ���� ���޵� ��� ������ ���ü�� ����, ���ü��
				���� Ȥ�� ��� �ǹ� �� �ϰ�� ���Ŀ��� ������ ��з� �����Ǿ�� �ϰ�,
				�� ����� ���� �̿ܿ��� ��� ������� ���� ��� ���� �̿�Ǿ�� ��
				�ȴ�. �� ������ ���� �� �������� �������� ���濡 ���Ͽ� ���� å������
			</p>

			<p class="bill_sub_title">�� 5 �� �߰� ���⹰�� ���� �ǹ�</p>
			<ul>
				<p>
					�������� �������� ���������� Ȩ������ ���� �� ����� ���Ͽ� �ּ���
					���ϸ�, �߰� ���⹰�� ���� �� �� �������׿� ���ؼ��� �߰����Ǹ�
					���Ѵ�. �߰������� ����������� ��ȣ �䱸������ �ִ��� ���� ��
					�ǹ��� �ִ�.
				</p>
			</ul>

			<p class="bill_sub_title">�� 6 �� ���۱�</p>
			<ul>
				<li>
					Ȩ������ ���ۿ� ���� �ַ�� ���α׷� �� ����Ʈ��� ���� ���۱���
					���������� �ִ�.
				</li>
				<li>
					�ϼ��� Ȩ������ �� ���α׷��� ���� ���ӻ������� ���������� �ִ�.
				</li>
				<li>
					�������� ���α׷� �� ����Ʈ��� �������� �������� ���� ���� ��3�ڿ���
					�絵 �Ÿ� �� �� ������ �絵/�Ÿ� �� ��3�ڿ��� �����Ͽ��� ��� ��������
					���������� ���� ��ġ�� ���� �� �ִ�.
				</li>
				<li>
					Ȩ�������� ���� ����� �����ΰ� �̹����� �ش� Ȩ������������ ���
					�����ϴ�.
				</li>
			</ul>

			<p class="bill_sub_title">�� 7 �� ��� ����</p>
			<ul>
				<li>
					�������� �������� ������ Ư���� ���� ���� �� ��࿡�� ������ ����
					�ǹ��� ������ �ƴ��Ͽ� �� ��� �� ����� ������ �� �ִ�.
				</li>
				<li>�������� �������� ��ȣ���ǿ� ���Ͽ� �� ����� ������ �� �ִ�.</li>
				<li>
					�������� �������� ��ȣ���ǿ� ���Ͽ� ����� �����ϰ��� �ϴ� ��쿡��
					���濡�� ���� �ǻ縦 ������������ �뺸�Ѵ�.
				</li>
			</ul>

			<p class="bill_sub_title">�� 8 �� ��Ÿ����</p>
			<ul>
				<li>
					�������� �������� Ȩ������ ������ ���� ����, ����� ���Ͽ� ���ǿ� ������
					��Ģ�� �԰��Ͽ� �ּ��� ����� �����Ѵ�.
				</li>
				<li>
					�� ��࿡ ���� �Ҽ��� ����Ǿ�� �ϴ� ���, �������� �������� �����ϴ�
					������ ���� �������� �Ѵ�
				</li>
			</ul>

			<p class="bill_sub_title">�� 9 �� ��༭ ����</p>
			<ul>
				<p>
					����ڴ� �� ��༭�� �����ϰ� �����Ǿ����� Ȯ���ϰ� �����ϱ� ���Ͽ�
					��༭ 2�θ� �ۼ��Ͽ� ��� ������ �� �� �� �뾿 �����Ͽ��� �Ѵ�.
				</p>
			</ul>
		</div>
	</div>
</div>

<script>

//ó�� ȸ���̸� �Է½� �ڵ� ä��
function putCommpanyName(event) {
  const companyName = event.target.value;
  for (i = 0; i < $(".company_name").length; i++) {
    $(".company_name").eq(i).val(companyName);
  }
}

//ù �ݾ� �Է½� �ڵ� ä��
function putPrice(event) {
  let contractPrice = event.target.value;
  contractPrice = comma(contractPrice);

  for (i = 0; i < $(".contract_price").length; i++) {
    $(".contract_price").eq(i).val(comma(contractPrice));
  }
}

// //���� �ѱ۷� ��ȯ
function num2han(num) {
  num = parseInt((num + "").replace(/[^0-9]/g, ""), 10) + ""; // ����/����/�� �� ���ڸ� �ִ� ���ڿ��� ��ȯ
  if (num == "0") return "��";
  var number = ["��", "��", "��", "��", "��", "��", "��", "ĥ", "��", "��"];
  var unit = ["", "��", "��", "��"];
  var smallUnit = ["õ", "��", "��", ""];
  var result = []; //��ȯ�� ���� ������ �迭
  var unitCnt = Math.ceil(num.length / 4); //���� ����. ���� 10000�� �ϴ����� ������ 2���̴�.
  num = num.padStart(unitCnt * 4, "0"); //4�ڸ� ���� �ǵ��� 0�� ä���
  var regexp = /[\w\W]{4}/g; //4�ڸ� ������ ���� �и�
  var array = num.match(regexp);
  //���� �ڸ������� ���� �ڸ��� ������ ���� �����(�׷��� �ڸ��� ����� ���ϴ�)
  for (var i = array.length - 1, unitCnt = 0; i >= 0; i--, unitCnt++) {
    var hanValue = _makeHan(array[i]); //�ѱ۷� ��ȯ�� ����
    if (hanValue == "")
      //���� ������ �ش� ������ ���� ��� 0�̶� ��.
      continue;
    result.unshift(hanValue + unit[unitCnt]); //unshift�� �׻� �迭�� �տ� �ִ´�.
  }
  //����� ������ ���� ������ ���ڸ��̴�. 1234 -> ��õ�̹��ʻ�
  function _makeHan(text) {
    var str = "";
    for (var i = 0; i < text.length; i++) {
      var num = text[i];
      if (num == "0")
        //0�� ���� �ʴ´�
        continue;
      str += number[num] + smallUnit[i];
    }
    return str;
  }
  return result.join("");
}

//�ݾ� �ѱ� ��ȯ
function transHanPrice(event) {
  let contractPrice = event.target.value;

  let hanPrice = num2han(contractPrice);

  for (i = 0; i < $(".price_han").length; i++) {
    $(".price_han").eq(i).val(comma(hanPrice));
  }
}
function price_per(event) {
  let percent = event.target.value;
  let className = event.target.className;
  let price = $(".contract_price").val();

  if (className.includes("2")) {
    price = price.replace(",", "");
    price = Number(price);
    percent = percent * 0.01;

    $(".price_percent2").val(comma(price * percent));
  } else {
    price = price.replace(",", "");
    price = Number(price);
    percent = percent * 0.01;

    $(".price_percent").val(comma(price * percent));
  }

  transHanPricePercent(event);
}

function transHanPricePercent(event) {
  let className = event.target.className;

  if (className.includes("2")) {
    let contractPrice = $(".price_percent2").val();
    contractPrice = contractPrice.replace(",", "");
    contractPrice = Number(contractPrice);
    let hanPrice = num2han(contractPrice);

    for (i = 0; i < $(".price_percent_han2").length; i++) {
      $(".price_percent_han2").eq(i).val(hanPrice);
    }
  } else {
    let contractPrice = $(".price_percent").val();
    contractPrice = contractPrice.replace(",", "");
    contractPrice = Number(contractPrice);
    let hanPrice = num2han(contractPrice);

    for (i = 0; i < $(".price_percent_han").length; i++) {
      $(".price_percent_han").eq(i).val(hanPrice);
    }
  }
}

</script>