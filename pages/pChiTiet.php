<?php
if (isAuthenticated() == false) {
    $check = 0;
} else {
    $check = 1;
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "select * from products where proid = $id";
    $rs = read_db($sql);
} else {
    redirect("index.php");
}
?>

<div class="detail-row">
    <div class="detail-box">
        <span>Chi Tiết</span>
    </div>
<?php
if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc();
    $count = $row["View"] + 1;
    $upview = "update products set View = $count where proid = $id";
    $idup = write_db($upview, 1);

    $idhang = $row["ID_Hang"];
    $idloai = $row["ID_Loai"];
    $sqlhang = "select tenhang from hangxe where id_hang = $idhang";
    $data = read_db($sqlhang);
    $datahang = $data->fetch_assoc();
    $sqlloai = "select tenloai from loaixe where id_loai = $idloai";
    $data = read_db($sqlloai);
    $dataloai = $data->fetch_assoc();
    ?>
        <div class="detail-top">
            <img src="images/products/thumb/<?php echo $row["ImageUrl"]; ?>" alt="<?php echo $row["ProName"]; ?>"/>
            <div class="detail-right">
                <p style="color: red; font-weight: 600; margin-top: 0px; margin-bottom: 7px; display: none;" id="err-detail">Vui lòng đăng nhập để mua sản phẩm.</p>
                <h2 class="detail-namepro"> <?php echo $row["ProName"]; ?></h2>
                <div class="detail-addcart">
                    <p><em>Giá: <?php echo number_format($row["Gia"]); ?> VNĐ</em></p>
                    <form method="POST" name="frmAdd-detail" id="frmAdd-detail">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $row["ProID"]; ?>"/>
                        <input type="hidden" name="txtChecklogin" id="txtChecklogin" value="<?php echo $check; ?>"/>
                        <span><em>Số lượng:</em> </span>
                        <select name="txtSoluong" id="txtSoluong">
    <?php
    for ($i = 1; $i <= 20; $i++) {
        echo "<option value='$i'>$i</option>";
    }
    ?>
                        </select>

                        <input type="button" name="btnSubmitCart" id="btnSubmitCart" class="btnSubmitCart" value="Thêm vào giỏ"/>  
                    </form>
                    <p><em>Xuất xứ: <?php echo $row["XuatXu"]; ?></em></p>
                    <p><em>Lượt xem: <?php echo $row["View"]; ?></em></p>
                    <p><em>Hãng: <a href="index.php?act=products&cat=hang&subid=<?php echo $idhang; ?>"><?php echo $datahang["tenhang"]; ?></a></em></p>
                    <p><em>Loại: <a href="index.php?act=products&cat=loai&subid=<?php echo $idloai; ?>"><?php echo $dataloai["tenloai"]; ?></a></em></p>
                </div>
            </div>

            <div class="clr"></div>
        </div>

        <div class="detail-content">
            <div class="detail-boxct">
                <span>Chi tiết sản phẩm</span>
            </div>
            <div class="detail-boxcontent">
                <h3><?php echo $row["TinyDes"]; ?></h3>
    <?php echo $row["FullDes"]; ?>
            </div>
        </div>
                <?php
            }
            ?>
</div>
    <?php
    require './pages/pSanPhamCungLoai.php';
    require './pages/pSanPhamCungHang.php';
    ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btnSubmitCart").click(function () {
            var id = $("#txtID").val();
            var soluong = $("#txtSoluong").val();
            var checklogin = $("#txtChecklogin").val();
			var data_cart = 'id=' + id + '&soluong=' + soluong;
            if (checklogin === '0') {
                $("#err-detail").show();
                return false;
            } else {
                
                $.ajax({
                    type: "POST",
                    url: "./pages/add_cart.php",
                    data: data_cart,
                    success: function (data_success) {
                        if(data_success == "true"){
                            location.reload();
                        }
                    }
                });
                return false;
            }
        });
    });
</script>