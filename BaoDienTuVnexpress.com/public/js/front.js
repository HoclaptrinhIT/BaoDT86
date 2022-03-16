

$('#btnSendSub').click(function(){
	var txtEmailSub = $('#txtEmailSub').val();
	var _token = $('#_token').val();

	 //check email có trống hay không
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(txtEmailSub) == false) {
            alert('Email này không hợp lệ, xin vui lòng kiểm tra lại !');
            return false;
        }

        $.ajax({
	      type: 'POST',
	      url: url + "/Dang-ki-nhan-tin",
	      data: { 
	        txtEmailSub: txtEmailSub, 	        
	        _token : _token 
	      },
	      success: function(data) {
	      	if(data == 'error_exit_email') {
	      		alert('Email này đã tồn tại, vui lòng kiểm tra lại !');
	      	}else if (data == 'error'){
	      		alert('Lỗi khi thêm Email, vui lòng kiểm tra lại !');

	      	}else{
	      		alert('Đăng kí nhận tin thành công !');
	      	}
	      }
	  });

});

 $('#btnSendContact').click(function(){
      
 	var _token = $('#_token').val();

    var txtName = $('#txtName').val();
	var txtEmail = $('#txtEmail').val();
	var txtPhone = $('#txtPhone').val();
	var txtMessage = $('#txtMessage').val();

	if(txtEmail == '' || txtName == '' || txtPhone == '' || txtMessage == '' ||){
		alert('vui lòng điền đầu đủ thông tin')
		return false;
	}


	 //check email có trống hay không
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(txtEmail) == false) {
            alert('Email này không hợp lệ, xin vui lòng kiểm tra lại !');
            return false;
        }

        $.ajax({
	      type: 'POST',
	      url: url + "/Lien-he",
	      data: { 
	        txtEmail: txtEmail, 	        
	        _token : _token 
	      },
	      success: function(data) {
	      	if(data == 'error_exit_email') {
	      		alert('Email này đã tồn tại, vui lòng kiểm tra lại !');
	      	}else if (data == 'error'){
	      		alert('Lỗi khi thêm Email, vui lòng kiểm tra lại !');

	      	}else{
	      		alert('Đăng kí nhận tin thành công !');
	      	}
	      }
	  });
  });