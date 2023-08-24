<?php

//////////////////////////////////////////////////////////////////////////////////
function MkDirCheck($Path)
{
	$kiemtra = file_exists($Path); 
	if($kiemtra == false){ mkdir($Path, 0755); }
	return !$kiemtra;
}
//////////////////////////////////////////////////////////////////////////////////
function ScanSubDir($dir) {
    $subDirectories = [];
    
    if (is_dir($dir)) 
    {
        $files = scandir($dir);
        foreach ($files as $file) 
        {
            if ($file === '.' || $file === '..' || $file === 'thumb') { continue; }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) { $subDirectories[] = $file; }
        }
        sort($subDirectories); // Sắp xếp mảng các thư mục con theo tên
    }
    return $subDirectories;
}
//////////////////////////////////////////////////////////////////////////////////
function ScanSubDir_2($directory) 
{
	$subdirectories = array();
	if ($handle = opendir($directory)) 
	{
		while (false !== ($entry = readdir($handle))) 
		{
			if ($entry != "." && $entry != ".." && $entry != "thumb") 
			{
				$path = $directory . "/" . $entry;
				if (is_dir($path)) { $subdirectories[] = $entry; }
			}
		}
		closedir($handle);
	}
	return $subdirectories;
}

//////////////////////////////////////////////////////////////////////////////////

?>

