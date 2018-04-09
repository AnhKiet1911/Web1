<?php
if (!isset($_SESSION["auth_user"])) {
    redirect("../index.php");
}
$hangxe = "select * from hangxe";
$resultHang = read_db($hangxe);

if (isset($_POST["btnAddpost"])) {
    $userid = $_SESSION["auth_user"]["id"];
    $tieude = $_POST["txtTieude"];
    $idHangsx = $_POST["sltNSX"];
    $idLoaisp = $_POST["sltLoai"];
    $xuatxu = $_POST["txtXuatXu"];
    $giatien = $_POST["txtGia"];
    $nameimg = $_FILES["imgavata"]["name"];
    $baseName = pathinfo($nameimg, PATHINFO_FILENAME);
    $extension = pathinfo($nameimg, PATHINFO_EXTENSION);
    $mota = $_POST["txtTinydes"];
    $noidung = $_POST["txtFulldes"];
    if ($tieude && $idHangsx && $idLoaisp && $nameimg && $mota && $noidung && $xuatxu && $giatien) {
        $sql = "insert into products(Proname, imageurl, tinydes, fulldes, UserID, ID_Loai, ID_Hang, XuatXu, Gia) values('$tieude', '$nameimg', '$mota', '$noidung', '$userid', '$idLoaisp', '$idHangsx', '$xuatxu', '$giatien')";
        $id = write_db($sql, 0);
        $dem = 0;
        while (file_exists("../images/products/thumb/" . $nameimg)) {
            $nameimg = $baseName . $dem . '.' . $extension;
            $dem++;
        };
        move_uploaded_file($_FILES["imgavata"]["tmp_name"], "../images/products/thumb/" . $nameimg);
        $inserted = true;
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
                        <h3>Thêm bài viết</h3>
                    </div>
                    <?php
                    if (isset($inserted) && $inserted === true) {
                        ?>
                        <p style="margin-left: 5px; color: #27ae61">Thêm bài viết thành công !</p>
                        <?php
                    } else if(isset($inserted) && $inserted === false){
                        ?>
                        <p style="margin-left: 5px; color: #EF0A2B">Thêm bài KHÔNG thành công !</p>
                        <?php
                    }
                    ?>
                    <div class="group-f">
                        <label for="txtTieude">Tiêu đề<span class="at-required-highlight"> *</span></label>
                        <div class="form-group col-md-5">
                            <input type="text" name="txtTieude" id="txtTieude" required="true" class="form-control">
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
                                    while ($row = $resultHang->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row["ID_Hang"] ?>"><?php echo $row["TenHang"] ?></option>         
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
                            <input type="text" name="txtXuatXu" id="txtXuatXu" required="true" class="form-control">
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="group-f">
                        <label for="txtXuatXu">Giá tiền<span class="at-required-highlight"> *</span></label>
                        <div class="form-group col-md-2">
                            <input type="text" name="txtGia" id="txtGia" required="true" class="form-control">
                            <span class="err-register"></span>
                        </div>
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
                            <textarea name="txtTinydes" id="txtTinydes" required="true" class="form-control"></textarea>
                            <span class="err-register"></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="group-f">
                        <label for="txtFulldes">Nội dung <span class="at-required-highlight">*</span></label>
                        <div class="form-group col-md-10">
                            <textarea name="txtFulldes" id="txtFulldes" required="true" class="form-control"></textarea>
                            <span class="err-register contenterr"></span>
                            <script type="text/javascript">
                                CKEDITOR.replace('txtFulldes');
                            </script>

                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="submit" name="btnAddpost" id="btnAddpost" value="Thêm" class="btn btn-primary">
                    </div>
                    <div style="clear: both;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function CheckPost(title, tinydes, fulldes, img, nhasx, xuatxu, giatien)
    {
        var kq;
        if (title === "") {
            $("#txtTieude").next(".err-register").html("Tiêu đề bài viết không được rỗng.");
            kq = false;
        } else {
            $("#txtTieude").next(".err-register").html("");
        }

        if (tinydes === "") {
            $("#txtTinydes").next(".err-register").html("Mô tả không được rỗng.");
            kq = false;
        } else {
            $("#txtTinydes").next(".err-register").html("");
        }
        if (fulldes === "") {
            $(".contenterr").html("Nội dung không được rỗng.");
            kq = false;
        } else {
            $(".contenterr").html("");
        }
        if (img.length === 0) {
            $("#imgavata").next(".err-register").html("Vui lòng chọn hình ảnh.");
            kq = false;
        } else {
            $("#imgavata").next(".err-register").html("");
            var fileup = $("#imgavata");
            var lg = fileup[0].files.length; // get length
            var items = fileup[0].files;
            if (lg > 0) {
                for (var i = 0; i < lg; i++) {
                    var fileName = items[i].name; // get file name
                    var fileSize = items[i].size; // get file size 
                    var fileType = items[i].type; // get file type
                }
                if (fileSize > 1048576) {
                    $("#imgavata").next(".err-register").html("Kích thước file lớn hơn 1MB.");
                    kq = false;
                } else {
                    $("#imgavata").next(".err-register").html("");
                }
                if (fileType !== "image/jpeg" && fileType !== "image/gif" && fileType !== "image/png" && fileType !== "image/JPEG" && fileType !== "image/GIF" && fileType !== "image/PNG")
                {
                    $("#imgavata").next(".err-register").html("Vui lòng chỉ chọn file hình ảnh.");
                    kq = false;
                } else {
                    $("#imgavata").next(".err-register").html("");
                }
            }
        }
        if (nhasx === "none") {
            $("#sltNSX").next(".err-register").html("Vui lòng chọn hãng sản xuất");
            kq = false;
        } else {
            $("#sltNSX").next(".err-register").html("");
        }
        
        if (xuatxu === "") {
            $("#txtXuatXu").next(".err-register").html("Xuất xứ không được rỗng.");
            kq = false;
        } else {
            $("#txtXuatXu").next(".err-register").html("");
        }
        if (giatien === "") {
            $("#txtGia").next(".err-register").html("Giá tiền không được rỗng.");
            output = false;
        } else if (isNaN(giatien)) {
            $("#txtGia").next(".err-register").html("Giá tiền phải là số.");
            output = false;
        } else {
            $("#txtGia").next(".err-register").html("");
        }
        return kq;
    }

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
        $("#btnAddpost").click(function () {
            var title = $("#txtTieude").val();
            var tinydes = $("#txtTinydes").val();
            var fulldes = CKEDITOR.instances.txtFulldes.getData();
            var imgName = $("#imgavata").val().replace(/C:\\fakepath\\/i, '');
            var loaixe = $("#sltLoai").val();
            var nhasx = $("#sltNSX").val();
            var xuatxu = $("#txtXuatXu").val();
            var giatien = $("#txtGia").val();
            $("#btnAddpost").val("Add...");
            var kt = CheckPost(title, tinydes, fulldes, imgName, nhasx, xuatxu, giatien);
            if (kt === false)
                return kt;
            else {
                return true;
            }
        });
    });
</script>
