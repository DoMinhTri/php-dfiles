//////////////////////////////////////////////////////////////////////////////////
function AjaxPost(_urlFileSuLy,_GiaTriChuoiGoi,_IDNameKetQua)
{
	//$('#'+_IDNameKetQua).html(imgLoad);
	$.ajax({
		url: _urlFileSuLy,	
		type: "POST",		
		data: _GiaTriChuoiGoi,		
		cache: false,
		success: function (html) 
		{	
			if(_IDNameKetQua != "")
			{
				$('#'+_IDNameKetQua).hide();	
				$('#'+_IDNameKetQua).html(html);
				$('#'+_IDNameKetQua).slideToggle('slow');		
			}
		}		
	});
}
//////////////////////////////////////////////////////////////////////////////////
function AjaxPostFunction(_urlFileSuLy,_TenHam, _GiaTriChuoiGoi)
{
	$.ajax({
		url: _urlFileSuLy,	
		type: "POST",		
		data: _GiaTriChuoiGoi,		
		cache: false,
		success: function (html) {	
			//setTimeout(_TenHam + "(" + html + ")"),0);
		}		
	});
}
//////////////////////////////////////////////////////////////////////////////////
function AjaxPostValue(_urlFileSuLy,_GiaTriChuoiGoi)
{
	$.ajax({
		url: _urlFileSuLy,	
		type: "POST",		
		data: _GiaTriChuoiGoi,		
		cache: false,
		success: function (html) {	return html; }});
}
//////////////////////////////////////////////////////////////////////////////////
function AjaxGet(_urlFileSuLy,_GiaTriChuoiGoi,_IDNameKetQua)
{
	$('#'+_IDNameKetQua).html(imgLoad);
	$.ajax({
		url: _urlFileSuLy,	
		type: "GET",		
		data: _GiaTriChuoiGoi,		
		cache: false,
		success: function (html) {	
			$('#'+_IDNameKetQua).hide();	
			$('#'+_IDNameKetQua).html(html);
			$('#'+_IDNameKetQua).fadeIn('slow');		
		}		
	});
}
