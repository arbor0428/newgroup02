<?

session_cache_limiter('');
session_start();


//글로벌 변수 설정
$GBL_USERID  = $_SESSION['ses_id'];
$GBL_NAME  = $_SESSION['ses_name'];
$GBL_MTYPE = $_SESSION['ses_type'];
$GBL_MNAME = $_SESSION['ses_mname'];
$GBL_TEAM = $_SESSION['ses_team'];

$subRoot = '.';
$strRoot = '../';
$boardRoot = '../board/';

$SYSTEM_DATE = date('Y-m-d');

if (!$GBL_USERID) { ?>
  <script language='javascript'>
        alert('로그인 세션이 종료되었습니다\n재로그인해 주시기 바랍니다<?= $PHP_SELF ?>');
    location.href = '../loginNew.php';
  </script>
<?
  exit;
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html" charset="euc-kr">

<script language='javascript' src='/module/js/common.js'></script>
<script src="http://i-web.kr/skins/js/jquery-1.11.2.min.js"></script>
<script src="http://i-web.kr/skins/js/jquery.popupoverlay.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link type='text/css' rel='stylesheet' href='http://i-web.kr/skins/js/popupoverlay.css'>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

<link rel="stylesheet" href="/new/css/reset.css?v=1.1" />
<link rel="stylesheet" href="/new/css/main.css?v=1.3" />
<link rel="stylesheet" href="/new/css/bill.css?v=1.2" />
<link rel="stylesheet" href="/new/css/sub.css?v=1.4" />
<link rel="stylesheet" href="/new/css/mediaquery.css?v=5.7" />


<title>아이웹-그룹웨어(new)</title>
