<?php
    session_start();
    ob_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="library/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/flexslider.css" type="text/css">
        <script src="javascript/jquery-3.1.1.min.js"></script>
              
        <title>Website bán hàng</title>
    </head>
    <body>
        <div id="container">
            <?php 
                include "./library/inc_Function.php";
                include "./library/inc_Connection.php";
                
                $act = "home";
                if (isset($_GET["act"])) {
                        $act = $_GET["act"];
                }
                require "./modules/mHeader.php";
                if($act != "login" && $act != "register" && $act != "profile" && $act != "detail" && $act != "products"  && $act != "cart")
                {
                    require "./modules/mSlide.php";
                }
            ?>
            <div class="wrapper">
            <?php
            if($act != "login" && $act != "register" && $act != "profile" )
            {
                require "./modules/mBannerTop.php";
            }
            ?>
                <div class="content">
                <?php        
                    switch ($act) {
                        case 'home':
                            require "./pages/pIndex.php";
                            break;
                        case 'login':
                            if(isset($_SESSION["auth_user"])){
                                redirect("index.php");
                            }
                            else{
                                require "./modules/mDangNhap.php";
                            }
                            break;
                        case 'register':
                            if(isset($_SESSION["auth_user"])){
                                redirect("index.php");
                            }
                            else{
                                require "./modules/mRegister.php";
                            }
                            break;
                        case 'profile':
                            require "./modules/mProfile.php";
                            break;
                        case 'detail':
                            require "./pages/pChitiet.php";
                            break;
                        case 'products':
                            require "./pages/pDanhSachSanPham.php";
                            break;
                        case 'cart':
                            require "./pages/pGioHang.php";
                            break;
                        default:
                            require "./pages/pIndex.php";
                        }
                        if ($act != "login" && $act != "cart" && $act != "register" && $act != "profile" && $act != "detail" && $act != "products" ) {
                            require "./pages/pSanPhamBanChay.php";
                        }
                        ?>
                </div>   
            </div>
                <?php
                    require "./modules/mBannerFoot.php";
                ?>
        </div>
        <?php
            require "./modules/mFooter.php";
        ?>
        <script src="javascript/jquery-slider.min.js"></script>
        <script src="javascript/jquery.flexslider.js"></script>
        <script src="javascript/jquery-webshop.js" type="text/javascript"></script>
        
        </script>
    </body>
</html>