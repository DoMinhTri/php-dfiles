<?php 
include("inc/function.php");
/////////////////////////////////////////////
if ($_SERVER["REQUEST_METHOD"] <> "POST") die("You can only reach this page by posting from the html form");
$_ThuTu   = @$_REQUEST["ThuTu"];
$_Kieu    = @$_REQUEST["Kieu"];
$_GiaTri1 = @$_REQUEST["GiaTri1"];
$_GiaTri2 = @$_REQUEST["GiaTri2"];
/////////////////////////////////////////////
//TaoThuMucCon($GFolder);
/////////////////////////////////////////////
$MangTenFile  = array("","folders","images","infor","","","","","","","");
include("$MangTenFile[$_ThuTu].php");
?>
