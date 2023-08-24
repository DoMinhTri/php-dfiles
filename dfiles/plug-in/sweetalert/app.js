$(document).ready(function(){
 
	$(document).on('click', '#TaoThuMuc', function(){
		
		swal.fire({
		  	title: 'Tạo thư mục ?',
		  	text: "",
		  	icon: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'OK',
		}).then((result) => {
			if (result.value)
			{
				TaoThuMuc();
				//swal.fire('', 'Tạo thành công', 'success');
			}
		})
	});
	////////////////////////////////////
	$(document).on('click', '#XoaThuMuc', function(){
		
		swal.fire({
		  	title: 'Xóa thư mục ?',
		  	text: "",
		  	icon: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'OK',
		}).then((result) => {
			if (result.value)
			{
				XoaThuMuc();
				//swal.fire('', 'Tạo thành công', 'success');
			}
		})
	});
	////////////////////////////////////
});
 
