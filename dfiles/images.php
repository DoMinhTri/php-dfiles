<?php
	//////////////////////////////////////// Load tất cả ảnh thư mục chọn
	if($_Kieu == 1)
	{
		$folder   = $_GiaTri1;                   // Thư mục chọn
		$scanPath = DF_IMAGE_PATH.$folder;       // Đường dẫn thư mục để scan
		$AImages  = TimTatCaFileAnh($scanPath);
		foreach ($AImages as $imageFile) 
		{
			echo TaoImageBox($folder, $imageFile);
		}
	}
	//////////////////////////////////////// Xóa file ảnh được chọn
	if($_Kieu == 2)
	{
		$folder    = $_GiaTri1;
		$imgfile   = $_GiaTri2;
		$imgPath   = DF_IMAGE_PATH.$folder."/".$imgfile;
		$thumbPath = DF_THUMB_PATH.$folder."/".$imgfile;
		if (file_exists($imgPath)) 
		{  
			unlink($imgPath);
			unlink($thumbPath);
			echo "ok"; 
		}
	}
	//////////////////////////////////////// Đổi tên file ảnh
	if($_Kieu == 3)
	{
		$arrData = explode("#",$_GiaTri1);
		$folder  = $arrData[0];
		$imgname = $arrData[1];
		$newname = $arrData[2];
		$imgtype = LayFileType($imgname);
		/////////////
		$imgpath    = DF_IMAGE_PATH.$folder ."/".$imgname;
		$imgnewpath = DF_IMAGE_PATH.$folder ."/".$newname.".".$imgtype;
		/////////////
		$thumbpath    = DF_THUMB_PATH.$folder."/".$imgname;
		$thumbnewpath = DF_THUMB_PATH.$folder."/".$newname.".".$imgtype;
		/////////////
		if (!file_exists($imgnewpath)) 
		{
			if (rename($imgpath, $imgnewpath)) 
			{
				rename($thumbpath, $thumbnewpath);
				echo "ok";
			} 
		} 
	}
   ////////////////////////////////////////
?>

