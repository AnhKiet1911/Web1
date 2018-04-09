<div id="top">	
    <?php
    if (isAuthenticated() === false) {
        ?>
        <div id="top-left">
            <div id="arrow-topleft">
                <div id="content-topleft">
                    <ul class="cls-ul">
                        <li class="parname"><a href="index.php?act=register"><i class="fa fa-registered" aria-hidden="true"></i> ĐĂNG KÝ</a></li>							
                        <li class="parname">|</li>
                        <li class="parname"><a href="index.php?act=login"><i class="fa fa-sign-in" aria-hidden="true"></i> ĐĂNG NHẬP</a></li>
                        <li class="parname">|</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div id="top-left">
            <div id="arrow-topleft">
                <div id="content-topleft">
                    <ul class="cls-ul">
                        <li class="parname">welcome</li>
                        <li class="parname"><a href="#" class="topleft-name"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $_SESSION["auth_user"]["name"] ?></a>
                            <ul class="cls-ul">
                                <li><a href="index.php?act=profile"><i class="fa fa-users" aria-hidden="true"></i> Thông tin cá nhân</a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng</a></li>
                                <li><a href="./modules/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a></li>
                            </ul>
                        </li>							
                        <li class="parname">|</li>
                        <li class="parname"><a href="./modules/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a></li>
                        <li class="parname">|</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div id="top-right">
        <p class="email"><i class="fa fa-envelope-o" aria-hidden="true"></i>support@14ck.com</p>
        <p class="sodt"><i class="fa fa-phone" aria-hidden="true"></i> 08.0012344</p>
    </div>
</div>
<!-- Header website -->
<header>
    <div id="header">
        <div id="logo-site">
            <a href="/"><img src="./images/nameShop.png" alt=""/></a>

        </div>
        <div id="detail-cart">
            <div id="shopcart">
                <a href="index.php?act=cart"><img src="images/shopcart.png" title="shop cart"/></a>
                <div id="info-card">
                    <p><?php if (isAuthenticated() == false) {
                        echo '0'; 
                    }
                    else{
                        echo demgiohang();
                    }
                    ?>
                      sản phẩm</p>
                    
                </div>
            </div>
        </div>
        <div id="phone-search">
            <div id="search-box">
                <form id="search-form" method="GET" action="pages/pTimKiem.php" name="search-form">
                    <input type="text" placeholder="Search for..." id="text-search" name="text-search"/>
                    <button type="submit" id="btnSearch"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
			
        </div>
		<div class="clr"></div>
		<div id="rs-search">
			<ul class="cls-ul list-search">
				
				
			</ul>
			
		</div>
			
    </div>
</header>
<!-- Menu website -->   
<div class="menu">
    <ul class="nav cls-ul">
        <li><a href="index.php"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a></li>
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="index.php?atc=intro">Giới thiệu</a></li>


        <li><a href="javascript:void(0)">Hãng Sản Xuất</a>
            <ul class="sub-nav cls-ul">
                <?php
                $sql = "select * from hangxe";
                
                $rshang = read_db($sql);
                if (is_object($rshang) && $rshang->num_rows > 0) {
                    while($row = $rshang->fetch_assoc())
                    {
                    ?>
                        <li><a href="index.php?act=products&cat=hang&subid=<?php echo $row["ID_Hang"]; ?>"><?php echo $row["TenHang"]; ?></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </li>

        <li><a href="javascript:void(0)">Các Loại Xe</a>
            <ul class="sub-nav cls-ul">
                <?php 
                    $sql = "SELECT DISTINCT TenLoai, ID_Loai FROM loaixe WHERE ID_Loai IS NOT NULL ORDER BY TenLoai, ID_Loai";
                    $rsLoai = read_db($sql);
                    if(is_object($rsLoai) && $rsLoai->num_rows)
                    {
                        while($row = $rsLoai->fetch_assoc())
                        {
                ?>
                            <li><a href="index.php?act=products&cat=loai&subid=<?php echo $row["ID_Loai"]; ?>"><?php echo $row["TenLoai"]; ?></a></li>
                <?php
                        }
                    }
                ?>
            </ul>
        </li>
        <li><a href="index.php?atc=contact">Liên Hệ </a></li>

    </ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#text-search" ).keyup(function() {
		var keysearch = $("#text-search").val();
		var key = "key=" + keysearch;
		var strview = "<a href='pages/pTimKiem.php?text-search=" +keysearch+ "'><p style='background:#fff; height:30px; color:#3FB4FB; line-height:30px; border-radius:5px; padding-left:8px; text-align:center'>Xem thêm</p></a>";
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
					$(".list-search").append(strview);
					$(".list-search").css("display", "block");
					
				}
				
			}
		 });
		return false;
		}
	});
});
</script>