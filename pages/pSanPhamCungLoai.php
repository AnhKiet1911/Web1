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
        <span>Xe Cùng Loại</span>
    </div>
	<form name="frmLoai" id="frmLoai" method="POST">
			<input type="hidden" name="proidloai" id="proidloai"/>
		 </form>
    <?PHP
    if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
    $idloai = $row["ID_Loai"];
    $sqlloai = "select * from products where id_loai = $idloai ORDER BY RAND() LIMIT 5";
    $result = read_db($sqlloai);
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
                        <button type="button" name="btnAddcart" id="btnAddcart" class="items-btn"><span><a href="javascript:;" onclick="setIDloai(<?php echo $row2["ProID"]; ?>)" class="aloaiclick">MUA HÀNG</a><span></button>
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
	function setIDloai(id){  
		$("#proidloai").val(id);
    }
	
	$(document).ready( function() {
     $('.aloaiclick').click(function(){
		var proidloai = $("#proidloai").val();
        var soluongloai = 1;
        var data_addloai = "id="+ proidloai + "&soluong=" + soluongloai;
        $.ajax({
           url:"pages/add_cart.php",
           type:"POST",
           data:data_addloai,
           success: function (data_sucl) {
                if(data_sucl == "true"){
                    location.reload();
                }
            }
        });
        return false;
    });
 });
   
</script>