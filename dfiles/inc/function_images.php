<?php
//////////////////////////////////////////////////////////////////////////////////
// Hàm kiểm tra định dạng file ảnh
function KiemTraFileAnh($sType)
{
    $kiemtra = true;
	if ($sType != "jpg" && $sType != "png" && $sType != "jpeg" && $sType != "gif") 
	{
		$kiemtra = false;
	}
    return $kiemtra;
}
//////////////////////////////////////////////////////////////////////////////////
function LayTenFileAnh($imgPath)
{
	$ArrImage  = explode("/",$imgPath);
	$nCount    = count($ArrImage);
	$sTenAnh   = $ArrImage[$nCount-1];
	return $sTenAnh;
}
/////////////////////////////////////////////////////////////////////////////////////////////
// Tìm tất cả ảnh trong thư mục
function TimTatCaFileAnh($folderPath) 
{
	$imageFiles = array();
	if (is_dir($folderPath)) 
	{
		$files = scandir($folderPath);
		foreach ($files as $file) 
		{
			if ($file !== '.' && $file !== '..') 
			{
				$filePath = "$folderPath/$file";
				$fileType = LayFileType($file);
				if (KiemTraFileAnh($fileType)) {  $imageFiles[] = $filePath; }
			}
		}
	}
	return $imageFiles;
}
/////////////////////////////////////////////////////////////////////////////////////////////
// Tạo khung image
function TaoImageBox($folder, $imgPath)
{
	$imageSize = getimagesize($imgPath);
	$CRong     = $imageSize[0];
	$CCao      = $imageSize[1];
	$TileAnh   = $CRong."x".$CCao;
	$fileAnh   = LayTenFileAnh($imgPath);
	$TenThuGon = ChuoiTen8KyTu($fileAnh);
	////////////
	$thumbPath = DF_THUMB_PATH.$folder."/".$fileAnh;
	$imgUrl    = DF_IMAGE_URL.$folder."/".$fileAnh;
	$thumbUrl  = DF_THUMB_URL.$folder."/".$fileAnh;
	////////////
	$imgBox    = "<div  class='ImageBlock'>
					<table border='0' cellpadding='0' cellspacing='0' width='100%'>
						<tbody>
							<tr>
								<td rowspan='2' width='55'><a href='#' onclick=\"CopyImageUrl('$fileAnh','$imgUrl')\"><img src='$thumbPath'></a></td>
								<td>$TenThuGon</td>
							</tr>
							<tr>
								<td>
									<a href='#' onclick=\"ViewImage('$imgPath','$CRong','$CCao')\"><img src='assets/images/view.png' width='22' height='22'></a>
									$TileAnh
									<a href='#' onclick=\"CopyImageUrl('$fileAnh','$thumbUrl')\"><img src='assets/images/copy.png' width='22' height='22'></a>
								</td>
							</tr>
						</tbody>
					</table></div>";
	return $imgBox;
}
//////////////////////////////////////////////////////////////////////////////////
function MakeImageResize($sourcePath, $destinationPath, $targetWidth, $targetHeight) 
{
    if (!file_exists($sourcePath)) {  return false;  } // Kiểm tra xem file tồn tại hay không
    list($sourceWidth, $sourceHeight, $sourceType) = getimagesize($sourcePath); // Lấy thông tin về ảnh gốc
    // Tính tỷ lệ giữa chiều rộng và chiều cao của ảnh gốc
    $aspectRatio = $sourceWidth / $sourceHeight;
    // Tạo ảnh với kích thước mới
    $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);
    // Dựa vào loại ảnh, tạo ảnh mới từ ảnh gốc
    switch ($sourceType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        default:
            // Nếu loại ảnh không được hỗ trợ, không thể resize
            return false;
    }
    // Resize ảnh gốc vào ảnh mới
    imagecopyresampled(
        $targetImage, // Ảnh mới
        $sourceImage, // Ảnh gốc
        0, 0, 0, 0,   // Tọa độ và vùng chọn ảnh gốc (chọn toàn bộ ảnh)
        $targetWidth, $targetHeight, // Kích thước mới
        $sourceWidth, $sourceHeight // Kích thước cũ
    );
    // Lưu ảnh mới vào đường dẫn đích
    imagejpeg($targetImage, $destinationPath, 90); // 90 là chất lượng ảnh (0-100)
    // Giải phóng bộ nhớ
    imagedestroy($targetImage);
    imagedestroy($sourceImage);
    return true;
}
//////////////////////////////////////////////////////////////////////////////////
function TaoThumbImage($sourcePath, $imgPath)
{
	MakeImageResize($sourcePath, $imgPath, 50, 50);
}
//////////////////////////////////////////////////////////////////////////////////

?>

