<?php
if (isset($_POST["btnThanhToan"])) {
    $tongtien = $_SESSION["tongtien"];
    $iduser = $_SESSION["auth_user"]["id"];
    $ngaylap = date('Y-m-d H:i:s', time());

    $sql = "insert into orders(Ngaylap, IDUser, Tongtien) values('$ngaylap', $iduser, $tongtien)";
    $mahoadon = write_db($sql, 0);

    foreach ($_SESSION["cart"] as $id => $soluong) {
		$list_id[] = "'" . $id . "'";
	}
	$listid = implode(",", $list_id);
	$sql = "select * from products where proid in ($listid)";
    $rs = read_db($sql);
        
	if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
        $giatien = $row["Gia"];
		$id = $row["ProID"];
		$soluong = $_SESSION['cart'][$row["ProID"]];
        $thanhtien = $giatien * $soluong;
        $sql = "insert into orderdetails(Mahoadon, proid, soluong, giatien, thanhtien) values($mahoadon, $id, $soluong, $giatien, $thanhtien)";
        write_db($sql, 0);
		}
		$check = 1;
	}
	unset($_SESSION["tongtien"]);
	unset($_SESSION["cart"]);
	unset($tongtien);
}
?>

<div class="info-cart">
    <div class="detail-box">
        <span>Giỏ hàng</span>
    </div>
    <table class="banggiohang">
        <tr>
            <th>Sản phẩm</th> 
            <th>Giá</th>
            <th>Số lượng</th> 
            <th>Thành tiền</th> 
            <th>Xóa</th> 
        </tr>
        <?php
		if(isset($check) && $check == 1)
		{
			echo "<tr>Giỏ hàng đã được thanh toán thành công.</tr>";
			$check = 0;
		}
        require './library/inc_Connection.php';
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION["cart"] as $id => $soluong) {
                $arr_id[] = "'" . $id . "'";
            }
            $listid = implode(",", $arr_id);
            $sql = "select * from products where proid in ($listid)";
            $rs = read_db($sql);
            $tongtien = 0;
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
                    $soluong = $_SESSION['cart'][$row["ProID"]];
                    $thanhtien = $soluong * $row["Gia"];
                    $tongtien += $thanhtien;
                    $_SESSION["tongtien"] = $tongtien;
                    ?>
                    <tr>
                        <td><?php echo $row["ProName"]; ?></td>
                        <td><?php echo number_format($row["Gia"]); ?></td>
                        <td>
                            <select name="sltSoluong" id="sltSoluong" class="sltSoluong" data-id="<?php echo $row["ProID"]; ?>" style="border: 1px solid #CCC">
                                <?php
                                for ($i = 1; $i <= 100; $i++) {
                                    if ($i == $soluong) {
                                        echo "<option value='$i' selected='selected'>$i</option>";
                                    } else {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><?php echo number_format($thanhtien); ?></td>
                        <td>
                            <a href="pages/xuly_giohang.php?idxoa=<?php echo $row["ProID"]; ?>"<button type="button" name="btnXoa" id="btnXoa"><i class="fa fa-times"></i></button>
                        </td> 
                    </tr>                   
            <?php
        }
    }
}else if(isset($_SESSION['cart']) && empty($_SESSION['cart'])){
    echo "<tr><td colspan='5'><strong>Không có sản phẩm nào trong giỏ</strong></td></tr>";
}
?>

        <tr>
            <td></td>
            <td></td>
            <td><strong>TỔNG TIỀN </strong></td>
            <td><?php if(isset($tongtien)){echo number_format($tongtien);} ?></td>
            <td></td>
        </tr>       
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <form name="frmThanhtoan" id="frmThanhtoan" method="POST">
                    <a href="index.php"><button type="button" name="btnThanhToan" id="btnBack">Tiếp Tục Mua Hàng</button></a>
                    <?php
						if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
					?>
					<button type="submit" name="btnThanhToan" id="btnThanhToan">Thanh Toán</button>
					<?php
						}
					?>
                </form>
            </td>
        </tr>
    </table>   
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".sltSoluong").change(function () {
            var soluong = $(this).val();
            var id = $(this).attr("data-id");
            var data_change = "soluong=" + soluong + "&id=" + id;
            $.ajax({
                url: "pages/xuly_giohang.php",
                type: "POST",
                data: data_change,
                async: true,
                success: function (data_success) {
                    location.reload();
                }
            });
        });
        
    });
</script>