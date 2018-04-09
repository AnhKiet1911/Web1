<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trang quản trị website bán xe oto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- bootstrap-css -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <!-- //bootstrap-css -->
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <!-- font CSS -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <!-- font-awesome icons -->
        <link rel="stylesheet" href="css/font.css" type="text/css"/>
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <!-- //font-awesome icons -->
        <script src="js/jquery2.0.3.min.js"></script>
        <script src="js/modernizr.js"></script>
        <script src="js/jquery.cookie.js"></script>
        <script src="js/screenfull.js"></script>
        <script>
			function show_noti(){
				if(confirm("Bạn có chắc chắn xóa ?")){
					return true;
				}
				else{
					return false;
				}
			}
            $(function () {
                $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

                if (!screenfull.enabled) {
                    return false;
                }



                $('#toggle').click(function () {
                    screenfull.toggle($('#container')[0]);
                });
            });
        </script>
        <!-- charts -->
        <script src="js/raphael-min.js"></script>
        <script src="js/morris.js"></script>
        <link rel="stylesheet" href="css/morris.css">
        <!-- //charts -->
        <!--skycons-icons-->
        <script src="js/skycons.js"></script>
        <!--//skycons-icons-->
        <script type="text/javascript" src="../library/ckeditor/ckeditor.js"></script>
    </head>

    <body class="dashboard-page">
        <script>
            var theme = $.cookie('protonTheme') || 'default';
            $('body').removeClass(function (index, css) {
                return (css.match(/\btheme-\S+/g) || []).join(' ');
            });
            if (theme !== 'default')
                $('body').addClass(theme);
        </script>
        <?php
            require "./sidebar.php";
            require "../library/inc_Connection.php";
            require "../library/inc_Function.php";
        ?>
        <section class="wrapper scrollable">
            <?php 
                require "./top.php";
            ?>
            <div class="main-grid">
                 
                <?php
                    require "./statistics.php";
                    $act = "home";
                    if(isset($_GET["act"])){
                        $act = $_GET["act"];
                    }
                    switch ($act) {
                        case "home":
                           require "./pages/dashboard.php";
                            break;
                        case "addpost":
                            require "./pages/addpost.php";
                            break;
						case "editpost":
                            require "./pages/editpost.php";
                            break;
						case "viewpost":
                            require "./pages/showpost.php";
                            break;
						case "viewloai":
                            require "./pages/loaisanpham.php";
                            break;
						case "viewhang":
                            require "./pages/hangsanxuat.php";
                            break;
                        default:
                            require "./pages/dashboard.php";
                            break;
}
                ?>
            </div>
        </section>
        <script src="js/bootstrap.js"></script>
    </body>
</html>