<?
	$n_url = "./";

	//include ��� �ȸԾ ����
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";


?>
 <div class="content_wrap"> 
	<div class="bill">
		<img src="/images/iweblogo.jpg" class="bill_logo" />
		<div class="bill_title">
			<input type="text" name="biil_title" value="" placeholder="Ȩ������ ������(�÷���)" />
		</div>
<?
include 'agree.php';
?>
		<div class="bill_select_wrap">
			<select class="bill_select">
				<option value="">����</option>
				<option value="�˶���">�˶���</option>
				<option value="������">������</option>
				<option value="������">������</option>
				<option value="�����">�����</option>
			</select>
		</div>

		<div class="bill_content">
			<div class="bill_top_content">
				<table>
					<tr>
						<th width="100px">������</th>
						<td><?=date("Y m d")?></td>
					</tr>
					<tr>
						<th>�����</th>
						<td>
							<input type="text" placeholder="����ڴ� ����" />
						</td>
					</tr>
					<tr>
						<th>������Ʈ</th>
						<td><input type="text" placeholder="������ Ȩ������ ����" /></td>
					</tr>
				</table>

				<table>
					<tr>
						<th rowspan="5" style="writing-mode: vertical-lr; padding: 5px;">
							������
						</th>
					</tr>
					<tr style="border-top: none;">
						<th width="100px">��Ϲ�ȣ</th>
						<td colspan="3"> <input type="text" id="bill_num" /></td>
					</tr>
					<tr>
						<th>��ȣ</th>
						<td width="130px">������</td>
						<th>����</th>
						<td>����</td>
					</tr>

					<tr>
						<th>��������</th>
						<td colspan="3">
							����� ������ �ź����37, DMC�������¿������� 605ȣ
						</td>
					</tr>

					<tr>
						<th>����</th>
						<td>���񽺾�</td>
						<th>����</th>
						<td>����Ʈ���� ����</td>
					</tr>
				</table>
			</div>

			<div class="bill_bottom_content">
				<div class="row_add_wrap">
					<button id="btn_design" data-name="design">������ +</button>
					<button id="btn_program" data-name="program">���α׷� +</button>
					<button id="btn_service" data-name="service">�ΰ����� +</button>
				</div>

				<table>
					<tr>
						<th style="width: 10%;">�ý��� ����</th>
						<th style="width: 15%;">���</th>
						<th>����</th>
						<th style="width: 5%;">����</th>
						<th style="width: 15%;">�ܰ�(��)</th>
						<th style="width: 15%;">���� �ܰ�(��)</th>
					</tr>
					<tr>
						<td class="bold" style="width: 10%;">
							<input type="text" name="sort1" id="sort1" value="��ȹ" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="func1" id="func1" value="��û����" />
						</td>
						<td>
							<input type="text" name="ment1" id="ment1" value="" />
						</td>
						<td style="width: 5%;">
							<input type="text" name="quantity1" id="quantity1" class="default_quantity" value="" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="price1" id="price1" class="default_price" value="" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="sup_price1" id="sup_price1" class="default_sup_price" value="" />
						</td>
					</tr>

					<tr>
						<td class="bold">
							<input type="text" name="sort2" id="sort2" value="���" />
						</td>
						<td>
							<input type="text" name="func2" id="func2" value="�ش���" />
						</td>
						<td>
							<textarea name="ment2" id="ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">�ѱ��� Ȩ������</textarea>
						</td>
						<td>
							<input type="text" name="quantity2" id="quantity2" class="default_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td>
							<input type="text" name="price2" id="price2" class="default_price" value="" onchange="transComma(); priceChange(id);" />
						</td>
						<td>
							<input type="text" name="sup_price2" id="sup_price2" class="default_sup_price price" value="" readonly/>
						</td>
					</tr>
				</table>

				<!-- ������ -->
				<table id="design_tbl">
					<tr id="design_clone_tr" class="design_tr">
						<td class="bold sort_td"  style="width: 10%;">
							<input type="text" name="design_sort1" id="design_sort1" value="������" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_func1" id="design_func1" value="���� ������" />
						</td>
						<td>
							<textarea name="design_ment1" id="design_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">���� ���̾ƿ� �� �ڵ�</textarea>
						</td>
						<td  style="width: 5%;">
							<input type="text" name="design_quantity1" id="design_quantity1" value="" class="design_quantity" onchange="quantityChange(id)" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_price1" id="design_price1" class="design_price" value="" onchange="transComma(); priceChange(id);" readonly/>
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_sup_price1" id="design_sup_price1" class="design_sup_price" value=""readonly />
						</td>
					</tr>

					<tr class="design_tr">
						<td class="bold">
							<input type="text" name="design_sort2" id="design_sort2" value="" />
						</td>
						<td>
							<input type="text" name="design_func2" id="design_func2" value="���� ������" />
						</td>
						<td>
							<textarea name="design_ment2" id="design_ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">�̹��� �� �ؽ�Ʈ, ���־� ������</textarea>
						</td>
						<td>
							<input type="text" name="design_quantity2" id="design_quantity2" class="design_quantity" value="" onchange="quantityChange(id)" />
						</td>
						<td>
							<input type="text" name="design_price2" id="design_price2" class="design_price" value="" onchange="transComma(); priceChange(id);"readonly />
						</td>
						<td>
							<input type="text" name="design_sup_price2" id="design_sup_price2" class="design_sup_price" value="" readonly/>
						</td>
					</tr>
				</table>

				<!-- ���α׷� -->
				<table id="program_tbl">
					<tr id="program_clone_tr" class="program_tr">
						<td class="bold"  style="width: 10%;">
							<input type="text" name="program_sort1" id="program_sort1" value="���α׷�" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_func1" id="program_func1" value="�Ϲ� �Խ��� " />
						</td>
						<td>
							<textarea name="program_ment1" id="program_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">�������� / Q&A / FAQ ��</textarea>
						</td>
						<td  style="width: 5%;">
							<input type="text" name="program_quantity1" id="program_quantity1" class="program_quantity" value="5" onchange="quantityChange(id)" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_price1" id="program_price1" class="program_price" value="" onchange="transComma(); priceChange(id);"readonly />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_sup_price1" id="program_sup_price1" class="program_sup_price" value="" readonly/>
						</td>
					</tr>

					<tr class="program_tr">
						<td class="bold">
							<input type="text" name="program_sort2" id="program_sort2" value="" />
						</td>
						<td>
							<input type="text" name="program_func2" id="program_func2" value="������ ������" />
						</td>
						<td>
							<textarea name="program_ment2" id="program_ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">�Խ���(�޴�)���� / �α׺м� / ȸ������ ���� </textarea>
						</td>
						<td>
							<input type="text" name="program_quantity2" id="program_quantity2" class="program_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td>
							<input type="text" name="program_price2" id="program_price2" class="program_price" value="" onchange="transComma(); priceChange(id);" readonly/>
						</td>
						<td>
							<input type="text" name="program_sup_price2" id="program_sup_price2" class="program_sup_price" value=""readonly />
						</td>
					</tr>
				</table>

				<!-- �ΰ����� -->
				<table id="service_tbl">
					<tr id="service_clone_tr" class="service_tr">
						<td class="bold"  style="width: 10%;">
							<input type="text" name="service_sort1" id="service_sort1" value="�ΰ�����" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="service_func1" id="service_func1" value="������" />
						</td>
						<td>
							<textarea name="service_ment1" id="service_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">Com / Co.kr / Net</textarea>
						</td>
						<td style="width: 5%;">
							<input type="text" name="service_quantity1" id="service_quantity1" class="service_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="service_price1" id="service_price1 " class="service_price"  value="22,000" onchange="transComma(); priceChange(id);" readonly/>
						</td>
						<td style="width: 15%;">
							<input type="text" name="service_sup_price1" id="service_sup_price1" class="service_sup_price price"readonly/>
						</td>
					</tr>

					<tr class="service_tr">
						<td class="bold">
							<input type="text" name="service_sort2" id="service_sort2" value="" />
						</td>
						<td>
							<input type="text" name="service_func2" id="service_func2" value="������(ȣ��������)" />
						</td>
						<td>
							<textarea name="service_ment2" id="service_ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">��������, DB ���� ���, Ʈ���Ȱ���, ���� �� </textarea>
						</td>
						<td>
							<select class="bill_select1">
							<option value="">����</option>
							<option value="100MB">100MB</option>
							<option value="500MB">500MB</option>
							<option value="1GB">1GB</option>
							<option value="3GB">3GB</option>
							</select>
							<!--<input type="text" name="service_quantity2" id="service_quantity2" class="service_quantity" value="�ſ�" onchange="quantityChange(id)" />!-->
						</td>
						<td>
							<input type="text" name="service_price2" id="service_price2 " class="service_price" onchange="transComma(); priceChange(id);"value="" readonly/>
						</td>
						<td>
							<input type="text" name="service_sup_price2" id="service_sup_price2" class="service_sup_price price" value="" readonly/>
						</td>
					</tr>
				</table>
			</div>
		</div>
	
		<div class="bill_pay">
		
			<div class="bill_total">
				<p>total(�ΰ��� ����)</p>
				<input type="text" id="bill_total_input" />
			</div>
			<div class="bill_custom">
				<p>���Ȱ�(�ΰ��� ����)</p>
				<input type="text" id="proposal_bill_input" />
			</div>
		</div>
			<div class="am">
			<script>
	function setUserID() {
		
		userid = $("#userid option:selected").val(); // userid�� select������ �ۿ�
		
		$('#name').val(''); 
		$('#tel').val('')

		if (userid) {
			$.post('./jsonTel.php',{'userid':userid}, function(req) { // json ������� �����Ͽ� ���ϰ� �ޱ�.
				
				parData = JSON.parse(req); // ���ڿ� ���� �м�, ��ü����
			
				name = parData['name']; // name�̶�� ��ü�� ����
				tel = parData['tel'];			

				

				$('#tel').val(tel); // ��ȭ
			});
		}
	}
</script>
		<select name='userid' id="userid" onchange="setUserID()">
			<option value=''>::�������::</option>
		<?
			for ($i=0; $i<count($arr_member); $i++) {
		?>
			<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>>
				<?=$arr_member[$i]?>
			</option>
		<?
			}
		?>
		</select>
		<table>
					<tr>
						<th>������ �����</th>
						<td>
							<input type="text" placeholder="�����" />
						</td>
					</tr>
					<tr>
						<th>���� ��ȣ</th>
						<td><input type="text" placeholder="���� ��ȣ" /></td>
					</tr>
			</table>
			</div>

	</div>
</div>