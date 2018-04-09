<?php

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
        <span>Xe Cùng Hãng</span>
    </div>
	<form name="frmHang" id="frmHang" method="POST">
			<input type="hidden" name="proidhang" id="proidhang"/>
		 </form>
    <?PHP
    if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
    $idhang = $row["ID_Hang"];
    $sqlhang = "select * from products where id_hang = $idhang ORDER BY RAND() LIMIT 5";
    $result = read_db($sqlhang);
    if($result->num_rows > 0){
        while ($row2 = $result->fetch_assoc()){
         ?>
		 
            <div class="couple-item">
            <div class="pro-items">
                <img src="images/products/thumb/<?php echo $row2["ImageUrl"]; ?>" class="pro-img"/>
                <div class="pro-title">
                    <h2><?php echo $row2["ProName"]; ?></h2>
                </div>
                <div class="pro-price"><span class="sp-price"><?php echo number_format($row2["Gia"]);?> VNĐ</span></div>
            </div>
            <div class="item-hidden">
                <div class="pro-title">
                    <h2><?php echo $row2["ProName"]; ?></h2>
                </div>
                <div class="pro-price"><span class="sp-price"><?php echo number_format($row2["Gia"]);?> VNĐ</span></div>
                <div class="formbtn">
                    <div class="btnProducts">
                        <button type="button" name="btnDetail" class="items-btn"><span><a href="index.php?act=detail&id=<?php echo $row2["ProID"]; ?>">CHI TIẾT</a><span></button>
                        <?php
                        if (isAuthenticated() == true) {
                            ?>
                            <button type="button" name="btnAddcart" id="btnAddcart" class="items-btn"><span><a href="javascript:;" onclick="setID(<?php echo $row2["ProID"]; ?>)" class="ahangclick">MUA HÀNG</a><span></button>
                        <?php             
                            };
                        ?>
                    </div>
                </div>
            </div>
    </div>
            <?php
            }
        }
    }
    ?>
    
    <div class="clr"></div>
</div>
<script type="text/javascript"> 
    function setID(id){
        $("#proidhang").val(id);
    }
    $(document).ready( function() {
     $('.ahangclick').click(function (){
		var idhang = $("#proidhang").val();
        var soluonghang = 1;
        var data_addc = "id="+ idhang + "&soluong=" + soluonghang;
        $.ajax({
           url:"pages/add_cart.php",
           type:"POST",
           data:data_addc,
           success: function (data_succ) {
                if(data_succ == "true"){
                    location.reload();
                }
            }
        });
        return false;
    });
 });
</script>