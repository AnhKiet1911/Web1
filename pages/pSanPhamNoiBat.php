<?php 
    $sql = "select * from products ORDER BY `View` DESC limit 10";
    $rs = read_db($sql);
?>
<div class="pro-last">
    <div class="title-pro">
            <h2>Xem nhiều</h2>
    </div>
	<form name="frmAddview" id="frmAddview" method="POST">
        <input type="hidden" id="txtIDview" name="txtIDview"/>
    </form>
	<?php
		if($rs->num_rows > 0)
		{
			while($row = $rs->fetch_assoc())
			{
				?>
				<div class="couple-item">
					<div class="pro-items">
						<img src="images/products/thumb/<?php echo $row["ImageUrl"];?>" class="pro-img"/>
						<div class="pro-title">
							<h2><?php echo $row["ProName"];?></h2>
						</div>
						<div class="pro-price"><span class="sp-price"><?php echo number_format($row["Gia"]);?> VNĐ</span></div>
					</div>
					<div class="item-hidden">
						<div class="pro-title">
							<h2><?php echo $row["ProName"];?></h2>
						</div>
						<div class="pro-price"><span class="sp-price"><?php echo number_format($row["Gia"]);?> VNĐ</span></div>
						<div class="formbtn">
							<div class="btnProducts">
								<button type="button" name="btnDetail" class="items-btn"><span><a href="index.php?act=detail&id=<?php echo $row["ProID"]; ?>">CHI TIẾT</a><span></button>
								<?php
								if (isAuthenticated() == true) {
									?>
											<button type="button" name="btnAddcartnew" id="btnAddcartnew" class="items-btn" ><span><a href="javascript:void(0)" class="aviewclick" onclick="setIDview(<?php echo $row["ProID"]; ?>)">MUA HÀNG</a><span></button>
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
	?>
    
    <div class="clr"></div>
</div>
<script type="text/javascript"> 
    function setIDview(id){
        $("#txtIDview").val(id);
    }
    $(document).ready( function() {
     $('.aviewclick').click(function(){
		var idview = $("#txtIDview").val();
        var soluongview = 1;
        var data_addview = "id="+ idview + "&soluong=" + soluongview;
        $.ajax({
           url:"pages/add_cart.php",
           type:"POST",
           data:data_addview,
           success: function (data_sucv) {
                if(data_sucv == "true"){
                    location.reload();
                }
            }
        });
        return false;
    });
 });
</script>