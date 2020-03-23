function signup(){
	$("#signupModal").modal();
}
function reload(){
	 window.location.href = site_url+"/home";
}

function load_signup_form(type){
	$("#chose_type").empty();
	var html = '<div class="form-group">'	
                +'Họ tên: <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Họ tên" required autofocus>'
			   +'</div>'+'<div id="error5" style="color: red;">'+'</div>'
	            +'<div class="form-group">'	
                +'Email: <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>'
			   +'</div>'+'<div id="error1" style="color: red;">'+'</div>'
			    +'<div class="form-group">'	
                +'Mật khẩu: <input type="password" id="inputPassword1" name="password" class="form-control" placeholder="Mật khẩu" required >'
			   +'</div>'+'<div id="error2" style="color: red;">'+'</div>'
			    +'<div class="form-group">'	
                +'Xác nhận mật khẩu: <input type="password" id="inputPasswordcfm" name="passwordcfm" class="form-control" placeholder="Xác nhận mật khẩu" required >'
			   +'</div>'+'<div id="error3" style="color: red;">'+'</div>'
			   +'<div id="error4" style="color: red;">'+'</div>'
			   +'<input type="number" id="su" name="su" class="form-control" value="'+type+'" style="display:none">';
	   $("#chose_type").append(html);
	   $("#captcha").attr("style","display:block");
	   $("#btn_sm").attr("style","display:block");
}

