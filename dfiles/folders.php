<?php 
	//////////////////////////////////////// Load cây thư mục
	if($_Kieu == 1)
	{
		echo TreeView(DF_IMAGE_PATH);
	}
	//////////////////////////////////////// Tạo thư mục
	if($_Kieu == 2)
	{
		$dauFlash   = "";
		$folderPath = "";
		$thumPath   = "";
		$thumucCha  = $_GiaTri1;
		$tenThumuc  = $_GiaTri2;
		/////////////
		if($thumucCha != ""){ $dauFlash = "/";	}
		$folderPath = DF_IMAGE_PATH.$thumucCha.$dauFlash.$tenThumuc;
		$thumPath   = DF_THUMB_PATH.$thumucCha.$dauFlash.$tenThumuc;
		/////////////
		if(MkDirCheck($folderPath))
		{ 
			MkDirCheck($thumPath);
			echo "ok";
		}
	}
	//////////////////////////////////////// xóa thư mục
	if($_Kieu == 3)
	{
		$folderPath = DF_IMAGE_PATH.$_GiaTri1;
		$thumPath   = DF_THUMB_PATH.$_GiaTri1;
		if(rmdir($folderPath))
		{
			rmdir($thumPath); 
			echo "ok";
		}
	}
	////////////////////////////////////////
?>
