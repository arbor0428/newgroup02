<?
//���б� ���Ѽ���

if(!$read_chk)	$read_chk = '��ü';



if($GBL_MTYPE == 'A' || $read_chk == '��ü'){	 //������ �Ǵ� �б������ ��ü�� ����� ������...
	$chk_type = 'ok';

}else{


	if($read_chk == '������' || $GBL_MTYPE == ''){		//���б� ������ ��ü�� �ƴϸ� ��ȸ���� ���б� ������ ����.

		$chk_type = 'no';


	}else{
		if($GBL_MTYPE <= $read_chk){	 //�α����� ȸ���׷췹���� �۾��� ���Ѻ��� �۰ų� ���� ���
			if($pwd_chk){	//��б��� ���
				if($GBL_USERID == $userid)	$chk_type = 'ok';
				else	$chk_type = 'no';

			}else{
				$chk_type = 'ok';

			}

		}else{
			$chk_type = 'no';

		}


	}



}



?>