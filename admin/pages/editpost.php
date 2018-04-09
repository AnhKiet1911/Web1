<?php
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "select * from products where proid = $id";
		$rs = read_db($sql);
		$row = $rs->fetch_assoc();
	}
	$hangxe = "select * from hangxe";
	$resultHang = read_db($hangxe);
	
	if (isset($_POST["btnEditpost"])) {
    $userid = $_SESSION["auth_user"]["id"];
    $tieude = $_POST["txtTieude"];
    $idHangsx = $_POST["sltNSX"];
    $idLoaisp = $_POST["sltLoai"];
    $xuatxu = $_POST["txtXuatXu"];
    $giatien = $_POST["txtGia"];
	
	if($_FILES["imgavata"]["error"] > 0){
		$nameimg = "none";
	}else{
		$nameimg = $_FILES["imgavata"]["name"];
	}
	

    $baseName = pathinfo($nameimg, PATHINFO_FILENAME);
    $extension = pathinfo($nameimg, PATHINFO_EXTENSION);
    $mota = $_POST["txtTinydes"];
    $noidung = $_POST["txtFulldes"];
	
    if ($tieude && $idHangsx && $idLoaisp && $nameimg && $mota && $noidung && $xuatxu && $giatien) {
		if($nameimg == "none"){
			$sql = "update products set proname = '$tieude', tinydes = '$mota', fulldes = '$noidung', id_loai = $idLoaisp, id_hang=$idHangsx, gia = '$giatien', xuatxu = '$xuatxu', userid = $userid where proid = $id";
			$idup = write_db($sql, 1);
			$inserted = true;
			redirect("index.php?act=editpost&id=$id");
		}else{
			$sql = "update products set proname = '$tieude', tinydes = '$mota', imageurl = '$nameimg', fulldes = '$noidung', id_loai = $idLoaisp, id_hang=$idHangsx, gia = '$giatien', xuatxu = '$xuatxu', userid = $userid  where proid = $id";
			$idup = write_db($sql, 1);
			$inserted = true;
			$dem = 0;
			while (file_exists("../images/products/thumb/" . $nameimg)) {
				$nameimg = $baseName . $dem . '.' . $extension;
				$dem++;
			};
			move_uploaded_file($_FILES["imgavata"]["tmp_name"], "../images/products/thumb/" . $nameimg);
			$inserted = true;
			redirect("index.php?act=editpost&id=$id");
		}
    } else {
        $inserted = false;
    }
}
?>

<div class="forms-grids">
    <div class="w3agile-validation">
        <div class="panel panel-widget agile-validation" >
            <div class="my-div">
                <form method="post" action="" enctype="multipart/form-data" class="valida" autocomplete="off" novalidate="novalidate">

                    <div class="input-info">
                        <h3>Cập nhật bài viết</h3>
                    </div>
                    <?php
                    if (isset($inserted) && $inserted === true) {
                        ?>
                        <p style="margin-left: 5px; color: #27ae61">Cập nhật bài viết thành công !</p>
                        <?php
                    } else if(isset($inserted) && $inserted === false){
                        ?>
                        <p style="margin-left: 5px; color: #EF0A2B">Cập nhật bài KHÔNG thành công !</p>
                        <?php
                    }
                    ?>
                    <div class="group-f">
			
                        <label for="txtTieude">Tiêu đề<span class="at-required-highlight"> *</span></label>
                        <div class="form-group col-md-5">
                            <input type="text" name="txtTieude" id="txtTieude" required="true" class="form-control" value="<?php echo $row["ProName"];?>">
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="group-f">
                        <label for="sltNSX">Nhà sản xuất<span class="at-required-highlight">*</span></label>
                        <div class="form-group col-md-2">
                            <select name="sltNSX" id="sltNSX" required="true" class="form-control">
                                <option value="none">Vui lòng chọn</option>
                                <?php
                                if ($resultHang->num_rows > 0) {
                                    while ($rowh = $resultHang->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $rowh["ID_Hang"] ?>"><?php echo $rowh["TenHang"] ?></option>         
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>

                    <div class="group-f">
                        <label for="sltLoai">Loại sản phẩm <span class="at-required-highlight">*</span></label>
                        <div class="form-group col-md-2">
                            <select name="sltLoai" id="sltLoai" required="true" class="form-control">
                                <option value='none'>Vui lòng chọn</option>
                            </select>
                        </div>
                        <div style="clear: both;"></div>
                    </div>

                    <div class="group-f">
                        <label for="txtXuatXu">Xuất xứ<span class="at-required-highlight"> *</span></label>
                        <div class="form-group col-md-2">
                            <input type="text" name="txtXuatXu" id="txtXuatXu" required="true" class="form-control" value="<?php echo $row["XuatXu"];?>">
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="group-f">
                        <label for="txtXuatXu">Giá tiền<span class="at-required-highlight"> *</span></label>
                        <div class="form-group col-md-2">
                            <input type="text" name="txtGia" id="txtGia" required="true" class="form-control" value="<?php echo $row["Gia"];?>">
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
					<div class="group-f">
                        <label for="txtXuatXu">Ảnh cũ<span class="at-required-highlight"></span></label>
                        <img src="../images/products/thumb/<?php echo $row["ImageUrl"];?>" width="200px" height="150px"/>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="group-f">
                        <div class="form-group col-md-5"> 
                            <label for="imgavata">Ảnh đại diện</label> 
                            <input type="file" name="imgavata" id="imgavata"> 
                            <span class="err-register"></span>
                            <p class="help-block">Lựa chọn hình ảnh upload</p> 

                        </div> 
                    </div>
                    <div style="clear: both;"></div>
                    <div class="group-f">
                        <label for="txtTinydes">Mô tả ngắn <span class="at-required-highlight">*</span></label>
                        <div class="form-group col-md-7">
                            <textarea name="txtTinydes" id="txtTinydes" required="true" class="form-control"><?php echo $row["TinyDes"];?></textarea>
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="group-f">
                        <label for="txtFulldes">Nội dung <span class="at-required-highlight">*</span></label>
                        <div class="form-group col-md-10">
                            <textarea name="txtFulldes" id="txtFulldes" required="true" class="form-control" value="<?php echo $row["FullDes"];?>"></textarea>
                            <span class="err-register contenterr"></span>
                            <script type="text/javascript">
                                CKEDITOR.replace('txtFulldes');
                            </script>

                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="submit" name="btnEditpost" id="btnEditpost" value="Thêm" class="btn btn-primary">
                    </div>
                    <div style="clear: both;"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
	$("#sltNSX").change(function () {
		var id = $("#sltNSX").val();
		$.ajax({
			url: "pages/xlAddpost.php",
			type: "POST",
			data: "idHang=" + id,
			async: true,
			success: function (data_sc) {
				$("#sltLoai").html(data_sc);
			}
		});
		return false;
	});
});
</script>
