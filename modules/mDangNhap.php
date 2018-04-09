<div class="login-container">
    <div class="flogin">
            <div class="title-pro">
                <h2>đăng nhập</h2>
            </div>
    </div>
    <div class="form-container">    
        <form method="POST" action="" name="frmLogin" id="frmLogin" autocomplete="off">
            <fieldset>
                <legend>Thông Tin</legend>
                <div class="group-input">
                    <span class="error-login login-fail">Tên đăng nhập hoặc mật khẩu không hợp lệ</span>
                    <label>
                        <p>Tên đăng nhập <label class="sao">*</label></p>
                        <input type="text" name="txtUser" id="txtUser" placeholder="Tên đăng nhập" autocomplete="off"/>
                        <span class="error-login">Tên đăng nhập không được rỗng</span>
                    </label>
                </div>

                <div class="group-input">
                    <label>
                        <p>Mật khẩu <label class="sao">*</label></p>
                        <input type="password" name="txtPass" id="txtPass" placeholder="Tên đăng nhập" autocomplete="off" />
                        <span class="error-login">Mật khẩu không được rỗng</span>
                    </label>
                </div>
                <div class="dangnhapbtn">
                    <label><input type="checkbox" name="ckbRemember" id="ckbRemember" /><p style="display: inline-block; margin-left: 5px; margin-top:8px">Nhớ mật khẩu</p></label>
                    <input type="button" name="btnLogin" value="Đăng nhập" id="btnLogin" class="btnLogin"/>
                </div>
             </fieldset>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {    
        $("#btnLogin").click(function(){
           $("#btnLogin").val("Connecting...");
           $("#btnLogin").css("background", "#46f110");
           var username = $("#txtUser").val();
           var password = $("#txtPass").val();
		   var remember = $('#ckbRemember:checked').val();
		   if(remember == "on"){
			   var data_login = 'username=' + username + '&password=' + password + '&check=' + remember;
		   }
		   else{
			   var data_login = 'username=' + username + '&password=' + password;
		   }       
           if(username === "" && password === ""){
               $("#txtUser").next(".error-login").show();
               $("#txtPass").next(".error-login").show();
               return false;
           }
           if(username === ""){
               $("#txtUser").next(".error-login").show();
               $("#txtUser").focus();
               return false;
           }
           else{
               $("#txtUser").next(".error-login").hide();
           }
           if(password === ""){
               $("#txtPass").next(".error-login").show();
               $("#txtPass").focus();
               return false;
           }
           else{
               $("#txtPass").next(".error-login").hide();
           }
           $.ajax({
                    type: "POST",
                    url: "./modules/xlDangNhap.php",
                    data: data_login,
                    success: function(data_success) {
                        if(data_success == "user") {    
                            $(location).attr('href', 'index.php');
                        }
                        else if(data_success == "admin")
                        {
                            $(location).attr('href', 'admin/index.php');
                        }
						
                        else {
                            $(".login-fail").show();
                            $("#btnLogin").val("Đăng nhập");
                        }
                    }
                });
           return false;
        });
    });
</script>
