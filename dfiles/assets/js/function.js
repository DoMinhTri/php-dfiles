
///////////////////////////////////////////////////////////////
function RemoveChar(sTring)
{
	let  Chuoi = "";
	/////////////////
	for(var i=0; i< sTring.length; i++)
	{
		let  sChar = sTring.substring(i, i+1);
		let  asciiCode = sChar.charCodeAt(0);
		if(asciiCode >32 ){	Chuoi = Chuoi + sChar; }
	}
	return Chuoi;
}
///////////////////////////////////////////////////////////////
function TaoChuoiGiaTri(GiaTri1,GiaTri2,GiaTri3,GiaTri4)
{
	var GiaTriGoi  = "ThuTu="    + encodeURIComponent(GiaTri1);
		GiaTriGoi += "&Kieu="    + encodeURIComponent(GiaTri2);
		GiaTriGoi += "&GiaTri1=" + encodeURIComponent(GiaTri3);
		GiaTriGoi += "&GiaTri2=" + encodeURIComponent(GiaTri4);
	return GiaTriGoi;
}	
///////////////////////////////////////////////////////////////
$(document).ready(function() {
   SysInforLoad();
   LoadAllDir();
   UpLoad();
});
///////////////////////////////////////////////////////////////
function TaoCayThuMuc(){ $(".file-tree").filetree(); }
///////////////////////////////////////////////////////////////
function SysInforLoad()
{
	var sData = TaoChuoiGiaTri(3, 1, "", "");
	$.ajax({ url: "sulytin.php", type: "POST", data: sData, cache: false, success: function (html){ } });
}
///////////////////////////////////////////////////////////////
function LayDiaChiThuMuc(SFolder)
{
	$("#ThuMucChon").html(SFolder);
	ShowAllImages(SFolder);
	$(".TopBody").show();
	$("#FileAnhChon").html("");
}
///////////////////////////////////////////////////////////////
function LoadAllDir()
{
	var sData = TaoChuoiGiaTri(1, 1, "", "");
	$.ajax({ url: "sulytin.php", type: "POST", data: sData, cache: false, success: function (html){ $("#DirTree").html(html); TaoCayThuMuc(); }});
}
///////////////////////////////////////////////////////////////
function HomeData()
{
	$("#ThuMucChon").html("");
	$("#FileAnhChon").html("");
	$(".TopBody").hide();
}
///////////////////////////////////////////////////////////////
function TaoThuMuc()
{
	let sDir  = $("#ThuMucChon").html();
	let sName = $("#InputTen").val();
	if(sName != "")
	{
		let sData = TaoChuoiGiaTri(1, 2, sDir, sName);
	    $.ajax({ url: "sulytin.php", type: "POST", data: sData, cache: false,
    		success: function (html){
				if(RemoveChar(html) == "ok")
			    {
					$("#InputTen").val("");
				    LoadAllDir();
			    }
				else{ MessageBox("Thư mục tồn tại."); }
		    }		
	    });
	}else{ MessageBox("Nhập tên thư mục."); }
}
///////////////////////////////////////////////////////////////
function XoaThuMuc()
{
	let sPath = $("#ThuMucChon").html();
	if(sPath != "")
	{
		var sData = TaoChuoiGiaTri(1, 3, sPath, "");
		$.ajax({ url: "sulytin.php", type: "POST", data: sData, cache: false,
			success: function (html){
				if(RemoveChar(html) == "ok")
				{
					LoadAllDir();
					$(".TopBody").hide();					
					$("#ThuMucChon").html("");
				}
			}		
		});
	}
}
///////////////////////////////////////////////////////////////
function UpLoad()
{
	//$("#UpLoadImageButton").click(function(e){
    //    var formData = new FormData(this);
    //    formData.append('upload_dir', $('#uploadDirInput').val());
    //    $.ajax({ type: "POST", url: "upload.php", processData: false, mimeType: "multipart/form-data", contentType: false, data: form,
    //        success: function (html) { MessageBox(html); ReShowImages(); },
    //        error: function (html) { MessageBox(html); }
    //    });
    //});

	$('#fileForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
		var sDir = $('#ThuMucChon').html();
        formData.append('upload_dir', sDir);
        $.ajax({ url: 'upload.php', type: 'POST', data: formData, cache: false, contentType: false, processData: false,
            success: function (html){ MessageBox(html); ShowAllImages(sDir); },
			error: function (html){	MessageBox(html); }
		});
    });
}
///////////////////////////////////////////////////////////////
function ShowAllImages(sDir)
{
	var sData = TaoChuoiGiaTri(2, 1, sDir, "");
	AjaxPost( "sulytin.php", sData, "AllFileImage");
}
/////////////////////////////////////////////////////////
function CopyText(sText)
{
   var temp = $("<input>");
   $("body").append(temp);
   temp.val(sText).select();
   document.execCommand("copy");
   temp.remove();
   ////////
   MessageBox(sText);
}
///////////////////////////////////////////////////////////////
function CopyImageUrl(sFile, sUrl)
{
	CopyText(sUrl);
	$("#FileAnhChon").html(sFile);
}
///////////////////////////////////////////////////////////////
function XoaFileAnh()
{
    var sDir    = $("#ThuMucChon").html();
	var imgFile = $("#FileAnhChon").html();
    if(imgFile != "")
    {
       var sData = TaoChuoiGiaTri(2, 2, sDir, imgFile);
       $.ajax({ url: "sulytin.php", type: "POST", data: sData, cache: false,
			success: function (html){
				if(RemoveChar(html) == "ok")
				{
					ShowAllImages(sDir);
					$("#FileAnhChon").html("");
				}
			}		
		});
    }
}
///////////////////////////////////////////////////////////////
function DoiTenAnh()
{
	var sDir    = $("#ThuMucChon").html();
	var image   = $("#FileAnhChon").html();
	var newname = $("#InputTen").val();
	var imgData = sDir + "#" + image + "#" + newname ;
	////////////
	if(newname != "" && image !="")
	{
		var sData = TaoChuoiGiaTri(2, 3, imgData, "");
	    $.ajax({ url: "sulytin.php", type: "POST", data: sData, cache: false,
    		success: function (html){
				if(RemoveChar(html) == "ok")
			    {
					$("#InputTen").val("");
					$("#FileAnhChon").html("")
				    ShowAllImages(sDir);			
			    }
		    }		
	    });
	    
	}else{ MessageBox("Chọn file ảnh và nhập tên thư mục."); }
}
///////////////////////////////////////////////////////////////