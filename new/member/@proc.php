<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";

error_reporting( E_ALL );
   ini_set( "display_errors", 1 );

if($idate01 && $idate02 && $idate03)   $itime = mktime(0,0,0,$idate02,$idate03,$idate01);
      else   $itime = date('Ymd');
      
   if($type == 'write'){
      $sql = "select * from wo_member where userid='$userid'";
         $result = mysql_query($sql);
         $num = mysql_num_rows($result);
         if($num){
            Msg::backMsg('�̹� ��ϵ� ���̵��Դϴ�');
            exit;
         }

         $sql = "insert into wo_member  (userid,pwd,name,securi,securi2,team,mtype,mname,mobile,telephone,email,bir01,bir02,bir03,account,enable,idate01,idate02,idate03,itime,sex,zipcode,addr01,addr02,affil) values ";
         $sql .= "('$userid','$pwd','$name','$securi','$securi2','$team','$mtype','$mname','$mobile','$telephone','$email','$bir01','$bir02','$bir03','$account','$enable','$idate01','$idate02','$idate03','$itime','$sex','$zipcode','$addr01','$addr02','$affil')";
         $result = mysql_query($sql);
         $msg = '��ϵǾ����ϴ�';
   }else if($type == 'edit'){
      $sql = "update wo_member set ";
         $sql .= "pwd='$pwd', ";
         $sql .= "name='$name', ";
         $sql .= "securi='$securi', ";
         $sql .= "securi2='$securi2', ";
         $sql .= "team='$team', ";
        // $sql .= "mtype='$mtype', ";
         $sql .= "mname='$mname', ";
         $sql .= "mobile='$mobile', ";
         $sql .= "telephone='$telephone', ";
         $sql .= "email='$email', ";
         $sql .= "bir01='$bir01', ";
         $sql .= "bir02='$bir02', ";
         $sql .= "bir03='$bir03', ";
         $sql .= "zipcode='$zipcode', ";
         $sql .= "addr01='$addr01', ";
         $sql .= "addr02='$addr02', ";
         $sql .= "idate01='$idate01', ";
         $sql .= "idate02='$idate02', ";
         $sql .= "idate03='$idate03', ";
         $sql .= "itime='$itime', ";
         $sql .= "sex='$sex', ";
         $sql .= "affil='$affil', ";
         $sql .= "account='$account', ";
         $sql .= "enable='$enable' ";
         $sql .= "where uid='$uid'";

         $result = mysql_query($sql);

         $msg = '�����Ǿ����ϴ�';

   }else if($type == 'del'){
      $sql = "delete from wo_member where uid='$uid'";
         $result = mysql_query($sql);

         $msg = '�����Ǿ����ϴ�';
   }else{
      
   }

unset($objProc);
unset($dbconn);
$query = "select * from wo_member where uid = 40";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

Msg::goMsg($msg,$next_url);

exit;


switch($type){
   case 'write' 
   case 'edit' :

      if($idate01 && $idate02 && $idate03)   $itime = mktime(0,0,0,$idate02,$idate03,$idate01);
      else   $itime = '';

      if($type=='write'){
         $sql = "select * from wo_member where userid='$userid'";
         $result = mysql_query($sql);
         $num = mysql_num_rows($result);
         if($num){
            Msg::backMsg('�̹� ��ϵ� ���̵��Դϴ�');
            exit;
         }

         $sql = "insert into wo_member  (userid,pwd,name,securi,securi2,team,mtype,mname,mobile,telephone,email,bir01,bir02,bir03,account,enable,idate01,idate02,idate03,itime,sex,zipcode,addr01,addr02,affil) values ";
         $sql .= "('$userid','$pwd','$name','$securi','$securi2','$team','$mtype','$mname','$mobile','$telephone','$email','$bir01','$bir02','$bir03','$account','$enable','$idate01','$idate02','$idate03','$itime','$sex','$zipcode','$addr01','$addr02','$affil')";
         $result = mysql_query($sql);
         $msg = '��ϵǾ����ϴ�';

      }else{
         $sql = "update wo_member set ";
         $sql .= "pwd='$pwd', ";
         $sql .= "name='$name', ";
         $sql .= "securi='$securi', ";
         $sql .= "securi2='$securi2', ";
         $sql .= "team='$team', ";
         $sql .= "mtype='$mtype', ";
         $sql .= "mname='$mname', ";
         $sql .= "mobile='$mobile', ";
         $sql .= "telephone='$telephone', ";
         $sql .= "email='$email', ";
         $sql .= "bir01='$bir01', ";
         $sql .= "bir02='$bir02', ";
         $sql .= "bir03='$bir03', ";
         $sql .= "zipcode='$zipcode', ";
         $sql .= "addr01='$addr01', ";
         $sql .= "addr02='$addr02', ";
         $sql .= "idate01='$idate01', ";
         $sql .= "idate02='$idate02', ";
         $sql .= "idate03='$idate03', ";
         $sql .= "itime='$itime', ";
         $sql .= "sex='$sex', ";
         $sql .= "affil='$affil', ";
         $sql .= "account='$account', ";
         $sql .= "enable='$enable' ";
         $sql .= "where userid=$userid";
         $result = mysql_query($sql);

         $msg = '�����Ǿ����ϴ�';
         

      }

   break;

   case 'del' :
         $sql = "delete from wo_member where uid='$uid'";
         $result = mysql_query($sql);

         $msg = '�����Ǿ����ϴ�';

         break;

}

unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
