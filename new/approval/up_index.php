<?php
include '../module/class/class.Msg.php';
include '../module/class/class.DbCon.php';
include '../head.php';
include '../array.php';
include '../header2.php';
if (!$type) {
    $type = 'list';
}
$subtit = '전자결재';
if ($GBL_USERID) {
    include 'mainhome.php';
}
?>
