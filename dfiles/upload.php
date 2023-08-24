<?php
//////////////////////////////////////////////////////////////////////////////////
include("inc/function.php");
//////////////////////////////////////////////////////////////////////////////////
$uploadDir = $_POST['upload_dir']; // Lấy thư mục đích từ tham số truyền xuống
//////////////////////////////////////////////////////////////////////////////////
if (!isset($_FILES['file']) || empty($uploadDir)) {	echo "Vui lòng chọn tệp và nhập thư mục đích."; exit; }
$uploadOk   = 1;
$timeString = TimeXaoTron();
$targetDir  = DF_IMAGE_PATH.$uploadDir  . "/";
$thumbDir   = DF_THUMB_PATH.$uploadDir . "/";
$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$thumbPath  = $thumbDir  . basename($_FILES["file"]["name"]);
$imageType  = LayFileType($targetFile);
$imgName    = LayFileName($targetFile);
//////////////////////////////////////////////////////////////////////////////////
if (file_exists($targetFile)) // Kiểm tra xem tệp đã tồn tại chưa
{ 
	$targetFile = "$targetDir/$imgName"."_". $timeString . "." . $imageType;
	$thumbPath  = "$thumbDir/$imgName" ."_". $timeString . "." . $imageType;
} 				  
if ($_FILES["file"]["size"] > 5000000) { echo "Kích thước tệp quá lớn."; $uploadOk = 0;	} // Kiểm tra kích thước tệp
if( KiemTraFileAnh($imageType) == false){ $uploadOk = 0; };                                  // Kiểm tra file là file ảnh
if ($uploadOk == 0) { echo " lỗi upload.";	} 
else 
{
	// Di chuyển tệp tải lên vào thư mục đích
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile))
	{ 
		TaoThumbImage($targetFile, $thumbPath) ;
		echo "$targetFile";
	} 
	else { echo "Có lỗi xảy ra khi tải lên tệp."; }
}
//////////////////////////////////////////////////////////////////////////////////
?>
