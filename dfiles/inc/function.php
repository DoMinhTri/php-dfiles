<?php
//////////////////////////////////////////////////////////////////////////////////
include("config.php");
include("function_files.php");
include("function_images.php");
include("function_folders.php");
//////////////////////////////////////////////////////////////////////////////////
// Gở bỗ path thư mục hệ thống
function RemoveRootPath($Path)
{
	$nCount  = strlen(DF_IMAGE_PATH);
	$pCount  = strlen($Path);
	$newPath = substr($Path, $nCount + 1, $pCount);
	return $newPath;
}
//////////////////////////////////////////////////////////////////////////////////
function ChuoiTen8KyTu($imgName)
{
	$tenFile = LayFileName($imgName);
	$nCount  = strlen($tenFile);
	$newName = $imgName;
	if($nCount > 12) $newName = substr($tenFile, 0, 12)."...";
	return $newName;
}
//////////////////////////////////////////////////////////////////////////////////
function XaoTronKyTu($sData){ return str_shuffle($sData); }  // Sử dụng hàm str_shuffle để xáo trộn các ký tự của chuỗi
//////////////////////////////////////////////////////////////////////////////////
function MaHoa8KyTu($sData) {
    $sMaHoa = md5($sData);
    $sChuoiMoi = substr($sMaHoa, 0, 8);
    return $sChuoiMoi;
}
//////////////////////////////////////////////////////////////////////////////////
function MaHoa8KyTuTron($sData) {
    $sChuoiMoi = MaHoa8KyTu($sData);
    return XaoTronKyTu($sChuoiMoi);
}
//////////////////////////////////////////////////////////////////////////////////
function TimeXaoTron(){	return MaHoa8KyTuTron(date('YmdHis'));}
//////////////////////////////////////////////////////////////////////////////////
function TongMang($mang,$dau)
{
	$value = "";
	$cnt   = count($mang);
	for($i=0; $i< $cnt; $i++)
	{  
		$value.= "$mang[$i]$dau";
	}
	return $value;
} 
//////////////////////////////////////////////////////////////////////////////////
function TreeViewLever($CapDir, $sDir)
{
	$CapDir++;
	$sTree  = "";
	$ArrDir = ScanSubDir($sDir);
	$nCount = count($ArrDir);
	////////////////////////
	$sTree = "<ul class='file-tree'>";
	if($CapDir > 1) $sTree = "<ul>";
	////////////////////////
	for($i=0; $i < $nCount;$i++)
	{
		$curDir  = $ArrDir[$i];
		$subDir  = "$sDir/$curDir";
		$nSCount = count(ScanSubDir($subDir));
		$showDir = RemoveRootPath($subDir);
		////////////////
		$arrow = "";
		if($nSCount >0) $arrow = "<img src='assets/images/arrow.png' width='10' height='10' />";
		$sTree .= "<li> <a href='#' onclick=\"LayDiaChiThuMuc('$showDir')\">&nbsp;$arrow $ArrDir[$i]</a>".TreeViewLever($CapDir, $subDir)."</li>";
	}
	$sTree .= "</ul>";
	////////////////////////
	return $sTree;
}
//////////////////////////////////////////////////////////////////////////////////
function TreeView($sDir)
{
	return TreeViewLever(0, $sDir);
}
//////////////////////////////////////////////////////////////////////////////////
function resizePNG($sourceImage, $targetHeight, $ImagePath) 
{
	list($sourceWidth, $sourceHeight) = getimagesize($sourceImage);    // Lấy thông tin kích thước ban đầu của ảnh
	//$targetHeight = ($targetWidth / $sourceWidth) * $sourceHeight;   // Tính toán chiều cao mới dựa trên tỷ lệ của chiều rộng mới
	$targetWidth  = ($targetHeight / $sourceHeight) * $sourceWidth;    // Tính toán rộng mới dựa trên tỷ lệ của chiều cao mới
	$targetImage  = imagecreatetruecolor($targetWidth, $targetHeight); // Tạo một ảnh mới với kích thước đã thay đổi
	$sourceImage  = imagecreatefrompng($sourceImage);                  // Tạo ảnh từ tệp nguồn
	imagealphablending($targetImage, false);                           // Cho phép độ trong suốt cho ảnh PNG
	imagesavealpha($targetImage, true);
	// Thay đổi kích thước ảnh gốc thành ảnh mới với kích thước đã chỉ định
	imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight);
	imagepng($targetImage, $ImagePath);  // Lưu ảnh mới vào thư mục đích hoặc xuất ra màn hình
	imagedestroy($sourceImage);          // Giải phóng bộ nhớ
	imagedestroy($targetImage);
}
//////////////////////////////////////////////////////////////////////////////////
function resizeJPEG($sourceImage, $targetHeight, $ImagePath) 
{
	list($sourceWidth, $sourceHeight) = getimagesize($sourceImage);   // Lấy thông tin kích thước ban đầu của ảnh
	//$targetHeight = ($targetWidth / $sourceWidth) * $sourceHeight;  // Tính toán chiều cao mới dựa trên tỷ lệ của chiều rộng mới
	$targetWidth = ($targetHeight / $sourceHeight) * $sourceWidth;    // Tính toán rộng mới dựa trên tỷ lệ của chiều cao mới
	$targetImage = imagecreatetruecolor($targetWidth, $targetHeight); // Tạo một ảnh mới với kích thước đã thay đổi
	$sourceImage = imagecreatefromjpeg($sourceImage);                 // Tải ảnh gốc vào bộ nhớ
	// Thay đổi kích thước ảnh gốc thành ảnh mới với kích thước đã chỉ định
	imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight);
	imagejpeg($targetImage, $ImagePath); // Lưu ảnh mới vào thư mục đích hoặc xuất ra màn hình
	imagedestroy($sourceImage);          // Giải phóng bộ nhớ
	imagedestroy($targetImage);
}
//////////////////////////////////////////////////////////////////////////////////
?>

