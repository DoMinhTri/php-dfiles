
$(document).ready(function() {
	$("body").append( "<div class='ImageViewBG'><img src='' class='ImageView' /></div>" );
});
///////////////////////////////////////////////////////////////
function ViewImage(imgPath, imgWidth, imgHeight)
{
	var wWidth    = $(window).width();
	var wHeight   = $(window).height();
	$(".ImageView").attr("src", imgPath);
	var bgImage   = $(".ImageViewBG");
	////////
	var NewHeight = 400;
	var NewWidth  = NewHeight*(imgWidth/imgHeight);
	//var NewHeight = NewWidth*(imgHeight/imgWidth);
	var pLeft     = (wWidth - NewWidth)/2   + "px";
	var pTop      = (wHeight - NewHeight)/2 + "px";
	////////
	bgImage.width(NewWidth);
	bgImage.height(NewHeight);
	bgImage.css("top",  "10px");
	bgImage.css("left", pLeft);
	bgImage.show();
	bgImage.on( "click", function() { bgImage.hide(); });
}
///////////////////////////////////////////////////////////////