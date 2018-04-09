<div class="register-container">
    <div class="register-row">
        <div class="register-title">
            <h3><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Thông tin đăng ký</h3>
        </div>
        <div class="register-content">
            <form method="POST" action="" name="frmRegister" id="frmRegister">
                <div class="register-input-group">
                    <label>Tên đăng nhập <span class="sao">*</span></label>
                    <input type="text" name="txtregUser" id="txtregUser" placeholder="Tên đăng nhập" class="input-text"/>
                    <span class="err-register"></span>
                </div>
                <div class="register-input-group">
                    <label>Mật khẩu <span class="sao">*</span></label>
                    <input type="password" name="txtregPass" id="txtregPass" placeholder="Mật khẩu" class="input-text"/>
                    <span class="err-register"></span>
                </div>
                <div class="register-input-group">
                    <label>Họ và Tên <span class="sao">*</span></label>
                    <input type="text" name="txtregName" id="txtregName" placeholder="Họ và Tên" class="input-text"/>
                    <span class="err-register"></span>
                </div>
                <div class="register-input-group">
                    <label>Giới tính <span class="sao">*</span></label>
                    <div class="radioSex">
                        <input type="radio" name="rdSex" value="1" checked/><span style="margin-right:20px">Nam</span>
                        <input type="radio" name="rdSex" value="0"/><span>Nữ</span>
                    </div>
                </div>
                <div class="register-input-group">
                    <label>Email <span class="sao">*</span></label>
                    <input type="email" name="txtregEmail" id="txtregEmail" placeholder="Email" class="input-text"/>
                    <span class="err-register"></span>
                </div>
                <div class="register-input-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="txtregPhone" id="txtregPhone" placeholder="Số điện thoại" class="input-text"/>
                    <span class="err-register"></span>
                </div>
                <div class="register-input-group">
                    <label>Địa chỉ <span class="sao">*</span></label>
                    <input type="text" name="txtregAddress" id="txtregAddress" placeholder="Địa chỉ" class="input-text"/>
                    <span class="err-register"></span>
                </div>
                <div class="register-input-group">
                    <div class="imgCapt" style="margin: auto; width: 50%;">
                        <img src="./library/cool-captcha/captcha.php" id="captcha" title="captcha" style="display:block;"/>
                        <a href="javasrcipt:void(0)" onclick="
                                document.getElementById('captcha').src = './library/cool-captcha/captcha.php?' + Math.random();
                                document.getElementById('captcha-form').focus();"
                           id="change-image">Thay đổi hình ảnh.</a>
                    </div>
                    <input type="text" name="captcha-form" id="captcha-form" class="input-text" style="float: right; margin-right:20px; margin-top: 10px"/>
                    <span class="err-register"></span>
                    <div class="clr"></div>
                </div>
                <div class="btnRegister-row">
                    <input type="button" name="btnRegister" class="btnRegister" id="btnRegister" value="Đăng ký"/>
                    <input type="button" name="btnCancel" class="btnCancel" value="Hủy bỏ"/>
                    <div class="clr"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkemail(email) {
        var chuacong = email.indexOf("@");
        var daucham = email.lastIndexOf(".");
        if (chuacong < 1 || daucham < chuacong + 2 || daucham + 2 >= email.length) {
            return false;
        }
    }

    function Checkinput(username, password, email, fullname, sex, phone, address, captcha) {
        var output;

        //username
        if (username === "") {
            $("#txtregUser").next(".err-register").html("Tên đăng nhập không được rỗng.");
            output = false;
        } else if (/^[a-zA-Z- ]*$/.test(username) === false) {
            $("#txtregUser").next(".err-register").html("Tên đăng nhập có kí tự đặc biệt.");
            output = false;
        } else {
            $("#txtregUser").next(".err-register").html("");
        }

        //password
        if (password === "") {
            $("#txtregPass").next(".err-register").html("Mật khẩu không được rỗng.");
            output = false;
        } else if (password.length < 6) {
            $("#txtregPass").next(".err-register").html("Mật khẩu phải lớn hơn 6 kí tự.");
            output = false;
        } else {
            $("#txtregPass").next(".err-register").html("");
        }
        //full name
        if (fullname === "") {
            $("#txtregName").next(".err-register").html("Họ và tên không được rỗng.");
            output = false;
        } else {
            $("#txtregName").next(".err-register").html("");
        }

        //email
        if (email === "") {
            $("#txtregEmail").next(".err-register").html("Email không được rỗng.");
            output = false;
        } else if (checkemail(email) === false) {
            $("#txtregEmail").next(".err-register").html("Email không hợp lệ.");
            output = false;
        } else {
            $("#txtregEmail").next(".err-register").html("");
        }

        //Phone
        if (phone === "") {
            $("#txtregPhone").next(".err-register").html("Số điện thoại không được rỗng.");
            output = false;
        } else if (isNaN(phone)) {
            $("#txtregPhone").next(".err-register").html("Số điện thoại phải là số.");
        } else {
            $("#txtregPhone").next(".err-register").html("");
        }

        //address 
        if (address === "") {
            $("#txtregAddress").next(".err-register").html("Đia chỉ không được rỗng");
            output = false;
        } else {
            $("#txtregAddress").next(".err-register").html("");
        }

        //captcha
        if (captcha === "") {
            $("#captcha-form").next(".err-register").html("Captcha không được rỗng");
            output = false;
        } else {
            $("#captcha-form").next(".err-register").html("");
        }
        return output;
    }
    $(document).ready(function () {
        //Cancel onclick redirect home
        $(".btnCancel").click(function () {
            $(location).attr('href', 'index.php');
            return false;
        });
        //Submit

        $("#btnRegister").click(function () {
            $("#btnRegister").val("Connecting...");
            $("#btnRegister").css("background", "#46f110");
            var username = $("#txtregUser").val();
            var password = $("#txtregPass").val();
            var email = $("#txtregEmail").val();
            var fullname = $("#txtregName").val();
            var sex = $('input[name=rdSex]:checked', '#frmRegister').val();
            var phone = $("#txtregPhone").val();
            var address = $("#txtregAddress").val();
            var captcha = $("#captcha-form").val();
            var data_register = 'username=' + username + '&password=' + password + '&email=' + email + '&fullname=' + fullname + '&sex=' + sex + '&phone=' + phone + '&address=' + address + '&captcha=' + captcha;
            var check = Checkinput(username, password, email, fullname, sex, phone, address, captcha);
            if (check === false) {
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "./modules/xlRegister.php",
                    data: data_register,
                    success: function (data_sc) {
                        if (data_sc == "true") {
                            $(location).attr('href', 'index.php');
                        }
                        if (data_sc == "error") {
                            $("#txtregUser").next(".err-register").html("Tên đăng nhập tồn tại.");
                        }
                        if (data_sc == "false") {
                            $("#captcha-form").next(".err-register").html("Captcha không hợp lệ.");
                        }
                    }

                });
            }
            return false;
        });
    });
</script>