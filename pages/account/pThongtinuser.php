
<div class="content-info">
    <div class="info-title">
        <h3>Thông tin chung</h3>
    </div>
    <div class="info">
        <p>
            <?php
            if (isset($_SESSION["auth_user"])) {
                ?>

            Username: <strong><?php echo $_SESSION["auth_user"]["username"] ?></strong></br><hr color="#e0d7f7" size="1" style="margin-left: -20px; margin-bottom: 8px">
            Họ và Tên: <strong><?php echo $_SESSION["auth_user"]["name"] ?></strong></br><hr color="#e0d7f7" size="1" style="margin-left: -20px; margin-bottom: 8px">
            Giới tính: <strong><?php echo $_SESSION["auth_user"]["sex"] ?></strong></br><hr color="#e0d7f7" size="1" style="margin-left: -20px; margin-bottom: 8px">
            Email: <strong><?php echo $_SESSION["auth_user"]["email"] ?></strong></br><hr color="#e0d7f7" size="1" style="margin-left: -20px; margin-bottom: 8px">
            Địa chỉ: <strong><?php echo $_SESSION["auth_user"]["address"] ?></strong></br><hr color="#e0d7f7" size="1" style="margin-left: -20px; margin-bottom: 8px">
            số điện thoại: <strong><?php echo $_SESSION["auth_user"]["phone"] ?></strong></br>
            <?php
        } else {
            redirect("index.php");
        }
        ?>
        </p>
    </div>
</div>
