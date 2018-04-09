
    <div class="profile-title">
        <h3>Thông Tin Cá Nhân</h3>
    </div>
    <div class="profile-row">
        <div class="profile-menu">
            <h3>tài khoản</h3>
            <ul class="cls-ul menu-info">
                <li><a href="index.php?act=profile&prof=info">Thông tin chung</a></li>
                <li><a href="index.php?act=profile&prof=edit">Sửa đổi thông tin</a></li>
                <li><a href="index.php?act=profile&prof=bill">Đơn hàng</a></li>
            </ul>
        </div>
        <div class="profile-info">
            <?php
                $prof = "info";
                if(isset($_GET["act"]) == "profile"){
                    if( isset($_GET["prof"]))
                    {
                        $prof = $_GET["prof"];
                    }
                    switch ($prof) {
                        case 'info':
                            require "./pages/account/pThongtinuser.php";
                            break;
                        case 'edit':
                            require "./pages/account/pDoithongtin.php";
                            break;
                        case 'bill':
                            require "./pages/account/pDonhang.php";
                            break;
                        default:
                            require "./pages/account/pThongtinuser.php";
                            break;
                        
                    }
                }
            ?>
        </div>
        <div class="clr"></div>
    </div>