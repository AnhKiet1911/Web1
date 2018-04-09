<div class="content-info">
    <div class="info-title">
        <h3>Cập nhật thông tin</h3>
    </div>
    <?php
    if (isset($_SESSION["auth_user"])) {
        ?>
        <div class="info">
            <div class="box-edit">
                <div class="box-formedit">
                    <form method="POST" name="frmEdit" id="frmEdit">
                        <div class="register-input-group">
                            <label>Họ và tên </label>
                            <input type="text" name="txtNameedit" id="txtNameedit" placeholder="Họ và tên" value="<?php echo $_SESSION["auth_user"]["name"] ?>" class="input-text"/>
                            <span class="err-register"></span>
                        </div>
                        <div class="register-input-group">
                            <label>Giới tính </label>
                            <div class="radioSex">
                                <input type="radio" name="rdSexedit" value="1" checked/><span style="margin-right:20px">Nam</span>
                                <input type="radio" name="rdSexedit" value="0"/><span>Nữ</span>
                            </div>
                        </div>
                        <div class="register-input-group">
                            <label>Email </label>
                            <input type="text" name="txtEmailedit" id="txtEmailedit" placeholder="Email" value="<?php echo $_SESSION["auth_user"]["email"] ?>" class="input-text"/>
                            <span class="err-register"></span>
                        </div>
                        <div class="register-input-group">
                            <label>Số điện thoại </label>
                            <input type="text" name="txtPhoneedit" id="txtPhoneedit" placeholder="Số điện thoại" value="<?php echo $_SESSION["auth_user"]["phone"] ?>" class="input-text"/>
                            <span class="err-register"></span>
                        </div>
                        <div class="register-input-group">
                            <label>Địa chỉ </label>
                            <input type="text" name="txtAddressedit" id="txtAddressedit" placeholder="Địa chỉ" value="<?php echo $_SESSION["auth_user"]["address"] ?>" class="input-text"/>
                            <span class="err-register"></span>
                        </div>
                        <div class="register-input-group">
                            <div style="width: 48%; text-align: right">
                                <label><input type="checkbox" name="ckbEditpass" id="ckbEditpass"/><span> Đổi mật khẩu</span><label>
                            </div>
                        </div>
                        <div class="editpass-hide">
                            <div class="register-input-group">
                                <label>Mật khẩu hiện tại </label>
                                <input type="password" name="txtPasspre" id="txtPasspre" placeholder="Mật khẩu" class="input-text"/>
                                <span class="err-register"></span>
                            </div>
                            <div class="register-input-group">
                                <label>Mật khẩu mới </label>
                                <input type="password" name="txtPassnew" id="txtPassnew" placeholder="Mật khẩu mới" class="input-text"/>
                                <span class="err-register"></span>
                            </div>
                            <div class="register-input-group">
                                <label>Nhập lại mật khẩu mới </label>
                                <input type="password" name="txtConpasss" id="txtConpasss" placeholder="Nhập lại" class="input-text"/>
                                <span class="err-register"></span>
                            </div>
                        </div>
                        <div class="btnRegister-row">
                            <input type="submit" name="btnEdit" class="btnRegister" id="btnEdit" value="Lưu"/>
                            <input type="button" name="btnCancel" class="btnCancel" value="Hủy"/>
                            <div class="clr"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
        redirect("index.php");
    }
    ?>
</div>

<script type="text/javascript">
    function checkemailedit(email) {
        var chuacong = email.indexOf("@");
        var daucham = email.lastIndexOf(".");
        if (chuacong < 1 || daucham < chuacong + 2 || daucham + 2 >= email.length) {
            return false;
        }
    }
    
    function CheckinputEdit(name, email, phone, address) {
        
        var kq;
        
        if(name === ""){
            $("#txtNameedit").next(".err-register").html("Họ và tên không được rỗng.");
            kq = false;
        }
        else{
            $("#txtNameedit").next(".err-register").html("");
        }
        
        //email
        if (email === '') {
            $("#txtEmailedit").next(".err-register").html("Email không được rỗng.");
            kq = false;
        } else if (checkemailedit(email) === false) {
            $("#txtEmailedit").next(".err-register").html("Email không hợp lệ.");
            kq = false;
        } else {
            $("#txtEmailedit").next(".err-register").html("");
        }
        
        if(phone === ""){
            $("#txtPhoneedit").next(".err-register").html("Họ và tên không được rỗng.");
            kq = false;
        }
        else if (isNaN(phone)) {
            $("#txtPhoneedit").next(".err-register").html("Số điện thoại phải là số.");
            kq = false;
        } else {
            $("#txtPhoneedit").next(".err-register").html("");
        }
        
        if(address === ""){
            $("#txtAddressedit").next(".err-register").html("Họ và tên không được rỗng.");
            kq = false;
        }
        else{
            $("#txtAddressedit").next(".err-register").html("");
        }
        return kq;
    }
    
    function Checkpassword(passpre, passnew, conpassnew){
        var kq = true;
        if(passpre === ''){
            $('#txtPasspre').next('.err-register').html("Mật khẩu không được rỗng.");
            kq = false;
        }
        else if(passpre.length < 6){
            $('#txtPasspre').next('.err-register').html("Mật khẩu không được nhỏ hơn 6 kí tự.");
            kq = false;
        }
        else{
            $('#txtPasspre').next('.err-register').html('');
            kq = true;
        }

        if(passnew === ''){
            $('#txtPassnew').next('.err-register').html("Mật khẩu mới không được rỗng.");
            kq = false;
        }
        else if(passnew.length < 6){
            $('#txtPassnew').next('.err-register').html("Mật khẩu không được nhỏ hơn 6 kí tự.");
            kq = false;
        }
        else{
            $('#txtPassnew').next('.err-register').html('');
            kq = true;
        }
        var compare = passnew.localeCompare(conpassnew);
        if(conpassnew === ''){
             $('#txtConpasss').next('.err-register').html('Nhập lại không được rỗng.');
             kq = false;
        }
        else if(compare !== 0){
            $('#txtConpasss').next('.err-register').html('Nhập lại không đúng.');
            kq = false;
        }  
        else{
            $('#txtConpasss').next('.err-register').html('');
            kq = true;
        }
        return kq;
    }
    
    $(document).ready(function () {
        
        var passpresent, passnew, Conpassnew, check;
        $('#ckbEditpass').click(function(){
            check = $('#ckbEditpass').is(":checked");
            if(check === true){
                $('.editpass-hide').slideDown();  
            }
            else{
               $('.editpass-hide').slideUp();
            }
        });
            
        $("#btnEdit").click(function(){
            $("#btnEdit").val("Connecting...");
            $("#btnEdit").css("background", "#46f110");
            var name = $("#txtNameedit").val();
            var email = $("#txtEmailedit").val();
            var sex = $('input[name=rdSexedit]:checked', '#frmEdit').val();
            var phone = $("#txtPhoneedit").val();
            var address = $("#txtAddressedit").val();
            if(check === true){ 
                passpresent = $('#txtPasspre').val();
                passnew = $('#txtPassnew').val();
                Conpassnew = $('#txtConpasss').val();
                var kq = Checkpassword(passpresent, passnew, Conpassnew);
                if(kq === false){
                    return kq;
                }
            } 
            
            var valid = CheckinputEdit(name, email, phone, address);
            if(valid === false){
                return valid;
            }else{
                data_edit = 'name=' + name + '&email=' + email + '&sex=' + sex + '&phone=' + phone + '&address=' + address;
                if(typeof (passpresent && passnew && Conpassnew) !== 'undefined'){
                    data_edit = 'name=' + name + '&email=' + email + '&sex=' + sex + '&phone=' + phone + '&address=' + address + '&passpre=' + passpresent + '&passnew=' + passnew;
                }
                $.ajax({
                    type:'POST',
                    url:'pages/account/xlDoithongtin.php',
                    data: data_edit,

                    success:function(data_success){
                        if(data_success == "false"){
                            $('#txtPasspre').next('.err-register').html("Mật khẩu hiện tại không đúng.");
                        }else{
                            alert(data_success);
                            $(location).attr('href', 'index.php?act=profile');
                        }
                    }
                });
            } 
            return false;
        });
        
    });
</script>