<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DFiles</title>
	<script src="assets/js/jquery-1.12.4.min.js"></script> 
	<script src="assets/js/function.js"></script>
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/boxicons.min.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	
	<link href="plug-in/tree/css/jquerysctipttop.css"  rel="stylesheet" type="text/css">
	<link href="plug-in/tree/css/file-explore.css"     rel="stylesheet" type="text/css">
	<script src="plug-in/tree/js/file-explore.js"></script> 
	
	<link href="plug-in/dsms/dsms.css"  rel="stylesheet" type="text/css">
	<script type="text/javascript" src="plug-in/dsms/dsms.js"  charset="utf-8"></script>
	
	<link href="plug-in/imgview/imgview.css"  rel="stylesheet" type="text/css">
	<script type="text/javascript" src="plug-in/imgview/imgview.js"  charset="utf-8"></script>
</head>
<body>

    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
		<img src="assets/images/logo.png" alt="">DFiles
		<a href="#" onclick="HomeData()"><img src="assets/images/home.png" alt=""></a>
      </div>

      <div class="search_bar">
		<a href="#" onclick="XoaThuMuc()"><img src="assets/images/fdelete.png" alt="" class="profile" /></a>&nbsp;
		<a href="#" onclick="TaoThuMuc()"><img src="assets/images/fadd.png" alt="" class="profile" /></a> &nbsp;
        <input type="text" placeholder="Name" id="InputTen"/>
      </div>

      <div class="navbar_content">
		
		<div><input type="image" src="assets/images/irename.png" alt="" width="40" height="40" onclick="DoiTenAnh()" /></div>
		<div><input type="image" src="assets/images/idelete.png" alt="" width="40" height="40" onclick="XoaFileAnh()"/></div>
		<form id="fileForm" method="post" enctype="multipart/form-data" style="display:nodne">
			<input type="hidden" name="upload_dir"  value="">
			<table>
				<tr>
					<td><input type="image" src="assets/images/iupload.png" alt="" width="40" height="40"/> </td>
					<td><input type="file" name="file" id="fileInput" class="inputUpload"> </td>
				</tr>
			</table>
		</form>
		</div>
      </div>
    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
		
		<div id="DirTree"> &nbsp; </div>
        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>
    </nav>

	<!-- Body -->
	<nav class="containdata">
		<div class="TopBody">
			<div class="TopTitle">
				<img src="assets/images/folder.png" alt="" width="30" height="30"> &nbsp;
				<div id="ThuMucChon"></div> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
				<img src="assets/images/image.png" alt="" width="30" height="30"> &nbsp;
				<div id="FileAnhChon"></div>
			</div>
		</div>
		<div id="AllFileImage"></div>
	</nav>
    <script src="assets/js/template.js"></script>
 </body>
</html>
