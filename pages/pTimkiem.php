<?php
    session_start();
    ob_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="../images/favicon.png">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../library/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="../css/flexslider.css" type="text/css">
        <script src="../javascript/jquery-3.1.1.min.js"></script>
              
        <title>Website</title>
    </head>
    <body>
        <div id="container">
            <?php 
                include "../library/inc_Function.php";
                include "../library/inc_Connection.php";    
                require "pHeaderSearch.php";
				
				
				if(isset($_GET["text-search"])){
					$key = $_GET["text-search"];
					
					if(isset($_GET["start"])){
						$pos = $_GET["start"];
					}
					else{
						$pos = 0;
					}
					$display = 5;	
					$sql = "select * from products where ProName LIKE '%$key%'";
					$rssum = read_db($sql);
					$sum_post = $rssum->num_rows;
					$sum_pages = ceil($sum_post/$display);	
					
					$sql = "select * from products where ProName LIKE '%$key%' limit $pos, $display";
					$rs = read_db($sql);
					
				}
				?>
			<div class="wrapper">
				<div class="content">
					<div class="detail-row">
						<div class="detail-box">
							<span>Kết quả tìm kiếm với "<?php echo $key; ?>"</span>
						</div>
						<div class="list-pro">
							<?php 
								if($rs->num_rows > 0){
									while ($row = $rs->fetch_assoc()){
										?>
										<div class="listpro-item">
											<img src="<?php echo "../images/products/thumb/".$row["ImageUrl"];?>" alt=""/>
											<div class="listpro-info">
												<div class="listpro-name">
													<a href="../index.php?act=detail&id=<?php echo $row["ProID"]; ?>"><h2><?php echo $row["ProName"] ;?></h2></a>
												</div>
												<div class="listpro-price">
													<span><?php echo number_format($row["Gia"]);?>đ</span>
												</div>
												<div class="clr"></div>
												<h3><em><?php echo $row["TinyDes"] ;?></em></h3>
												<em>Xuất xứ: <?php echo $row["XuatXu"] ;?></em><br>
												<em>Lượt xem: <?php echo $row["View"] ;?></em><br>
												<?php												
														$idhang = $row["ID_Hang"];
														$idloai = $row["ID_Loai"];
														$sql = "select TenHang from hangxe where ID_Hang = $idhang";
														$rshang = read_db($sql);
														$rowhang = $rshang->fetch_assoc();
														
														$sql = "select TenLoai from loaixe where ID_Loai = $idloai";
														$rsloai = read_db($sql);
														$rowloai = $rsloai->fetch_assoc();
														
														
												?>
														<em>Hãng: <?php echo $rowhang["TenHang"]; ?></em><br>
														<em>Loại: <?php echo $rowloai["TenLoai"]; ?></em><br>
											</div>        
											<div class="clr"></div>           
										</div>
										<?php
									}
								}else{
									?>
							<h4 style="color:red; border-bottom: 1px solid red">CHƯA CÓ SẢN PHẨM NÀO</h4>
							<?php
								}
							?>
						</div>
						
						<ul class="cls-ul list-page">
							<?php
								
								if($sum_pages > 1){
									$hientai = ($pos/$display) + 1;
									if($hientai != 1){
										$pre = $pos - $display;
										echo "<li class='pages'><a href='pTimKiem.php?text-search=$key&start=$pre'>Prev</a></li>";
									}
									
									for($page = 1; $page <= $sum_pages; $page++){
										$start = ($page - 1) * $display;
										if($hientai == $page){
											echo "<li class='pages' style='background:#3fb4fb'><a href='pTimKiem.php?text-search=$key&start=$start' style='color:#fff'>$page</a></li>";
										}
										else{
											echo "<li class='pages'><a href='pTimKiem.php?text-search=$key&start=$start'>$page</a></li>";
										}	
									}
									
									if($hientai != $sum_pages){
										$next = $pos + $display;
										echo "<li class='pages'><a href='pTimKiem.php?text-search=$key&start=$next'>Next</a></li>";
									}
							}
							?>
						
							<div class="clr"></div>
						</ul>
					</div>
					
				</div>   
            </div>
                <?php
                    require "../modules/mBannerFoot.php";
                ?>
        </div>
        <?php
            require "../modules/mFooter.php";
        ?>
        <script src="../javascript/jquery-slider.min.js"></script>
        <script src="../javascript/jquery.flexslider.js"></script>
        <script src="../javascript/jquery-webshop.js" type="text/javascript"></script>
        
        </script>
    </body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$("#text-search" ).keyup(function() {
		var keysearch = $("#text-search").val();
		var key = "key=" + keysearch;
		if(keysearch == ''){
			$(".list-search").html('');
			$(".list-search").css("display", "none");
		}else{
		 $.ajax({
			type: "GET",
			url: "./pages/xuly_quicksearch.php",
			data: key,
			success: function(kqsearch) {
				if(kqsearch === "false"){
					$(".list-search").html("<p style='background:#fff; height:30px; color:red; line-height:30px; border-radius:5px; padding-left:8px'>Không có sản phẩm</p>");
				}
				else{
					$(".list-search").html(kqsearch);
					$(".list-search").append("<a href='pages/pTimKiem.php?text-search=keysearch'><p style='background:#fff; height:30px; color:#3FB4FB; line-height:30px; border-radius:5px; padding-left:8px'>Xem thêm</p></a>");
					$(".list-search").css("display", "block");
					
				}
				
			}
		 });
		return false;
		}
	});
});
</script>