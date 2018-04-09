<?php
	$sql = "SELECT ProID, SUM(SoLuong) AS TongSoLuong FROM orderdetails GROUP BY ProID ORDER BY SUM(SoLuong) DESC LIMIT 9";
	$rsdetails = read_db($sql);
	
?>

<div class="spcapnhat">
    <div class="titlesp">
        <div class="title-pro">
            <h2>Bán chạy</h2>
        </div>
        <div class="icon-slider">
            <div class="btn-prev" id="btn-prev">
                <i class="fa fa-angle-double-left fa-lg" aria-hidden="true"></i>
            </div>
            <div class="btn-next" id="btn-next">
                <i class="fa fa-angle-double-right fa-lg" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <form name="frmAddbc" id="frmAddbc" method="POST">
        <input type="hidden" id="txtIDbc" name="txtIDbc"/>
    </form>
    <div class="sliderpro">
        <div class="list-capnhat" id="list-capnhat">
               <?php
					if($rsdetails->num_rows > 0){
						while($rowdt = $rsdetails->fetch_assoc()){
							$id = $rowdt["ProID"];
							$sql = "select * from Products where ProID = $id";
							$rs = read_db($sql);
							$row = $rs->fetch_assoc();
						?>
							<div class="cn-item">
								<div class="cn-img" style="width:48%; height:100%;float:left">
									<img src="images/products/thumb/<?php echo $row["ImageUrl"];?>" style="width:100%; height:100%"/>
								</div>
								<div class="cn-info" style="float:left; width:40%; height:100%">
									<div class="txtInfo">
										<div class="pro-title">
											<h2><a href="index.php?act=detail&id=<?php echo $row["ProID"]; ?>"><?php echo $row["ProName"];?></a></h2>
										</div>
										<div class="pro-price"><span class="sp-price"><?php echo number_format($row["Gia"]);?> VNĐ</span></div>
									</div>
									<div class="cnhat-btn">
										<?php
											if (isAuthenticated() == true) {
												?>
														<button type="button" name="btnAddcartnew" id="btnAddcartnew" class="items-btn" ><span><a href="javascript:void(0)" class="abcclick" onclick="setIDnew(<?php echo $row["ProID"]; ?>)">MUA HÀNG</a><span></button>
												<?php             
													};
												?>
									</div>
								</div>
							</div>
						
						<?php
						}
					}
					
			   ?>
                
                          
            <div class="clr"></div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    function setIDnew(id){
        $("#txtIDbc").val(id);
    }
    $(document).ready( function() {
     $('.abcclick').click(function(){
		var idhang = $("#txtIDbc").val();
        var soluonghang = 1;
        var data_addbc = "id="+ idhang + "&soluong=" + soluonghang;
        $.ajax({
           url:"pages/add_cart.php",
           type:"POST",
           data:data_addbc,
           success: function (data_sucbc) {
                if(data_sucbc == "true"){
                    location.reload();
                }
            }
        });
        return false;
    });
 });
</script>
