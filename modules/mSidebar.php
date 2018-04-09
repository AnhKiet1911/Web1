<div class="wrapper">
    <div class="category">
        <?php
            $act = "home";
            if (isset($_GET["act"])) {
            $act = $_GET["act"];
        }
        require"mMenuleft.php";
        if($act !="login")
        {
            require"mKhuyenMai.php";
        }
        ?>
    </div>
