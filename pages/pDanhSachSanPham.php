<?php
    if(isset($_GET["cat"]) && isset($_GET["subid"])){
        $cat = $_GET["cat"];
        $id = $_GET["subid"];
               
        $query = '';       
        $sql = '';
        $check = 0;
        if($cat == "loai"){
			if(isset($_GET["start"])){
				$pos = $_GET["start"];
			}
			else{
				$pos = 0;
			}
			$display = 5;	
			$sql = "select * from products where id_loai = $id";
			$rssum = read_db($sql);
			$sum_post = $rssum->num_rows;
			$sum_pages = ceil($sum_post/$display);	
			
            $sql = "select * from products where id_loai = $id ORDER BY proid DESC limit $pos, $display";
			
            $query = "select * from loaixe where id_loai = $id";
            $check = 1;
        }
        if($cat == "hang"){
			if(isset($_GET["start"])){
				$pos = $_GET["start"];
			}
			else{
				$pos = 0;
			}
			$display = 5;	
			$sql = "select * from products where id_hang = $id";
			$rssum = read_db($sql);
			$sum_post = $rssum->num_rows;
			$sum_pages = ceil($sum_post/$display);	
			
            $sql = "select * from products where id_hang = $id ORDER BY proid DESC limit $pos, $display";
            $query = "select * from hangxe where id_hang = $id";
            $check = 2;
        }
        $rs = read_db($query);
        $content = read_db($sql);
    }
    else{
        redirect("index.php");
    }
?>

<div class="detail-row">
    <div class="detail-box">
        <span><?php 
            if($check == 1){
                if($rs->num_rows > 0){
                    $row = $rs->fetch_assoc();
                    echo "SẢN PHẨM LOẠI ".$row["TenLoai"];
                }
            }
            else if($check == 2){
                if($rs->num_rows > 0){
                    $row = $rs->fetch_assoc();
                    echo "SẢN PHẨM HÃNG ".$row["TenHang"];
                }
            }
        ?></span>
    </div>
    <div class="list-pro">
        <?php 
            if($content->num_rows > 0){
                while ($row = $content->fetch_assoc()){
                    ?>
                    <div class="listpro-item">
                        <img src="<?php echo "images/products/thumb/".$row["ImageUrl"];?>" alt=""/>
                        <div class="listpro-info">
                            <div class="listpro-name">
                                <a href="index.php?act=detail&id=<?php echo $row["ProID"]; ?>"><h2><?php echo $row["ProName"] ;?></h2></a>
                            </div>
                            <div class="listpro-price">
                                <span><?php echo number_format($row["Gia"]);?>đ</span>
                            </div>
                            <div class="clr"></div>
                            <h3><em><?php echo $row["TinyDes"] ;?></em></h3>
                            <em>Xuất xứ: <?php echo $row["XuatXu"] ;?></em><br>
                            <em>Lượt xem: <?php echo $row["View"] ;?></em><br>
                            <?php
                                if($check == 1){
                                    $idhang = $row["ID_Hang"];
                                    $sql = "select TenHang from hangxe where ID_Hang = $idhang";
                                    $gethang = read_db($sql);
                                    if($gethang->num_rows > 0)
                                    {
                                        $rowh = $gethang->fetch_assoc();
                                    ?>
                                        <em>Hãng: <?php echo $rowh["TenHang"]; ?></em><br>
                            <?php
                                    }
                                }else{
                                    $idloai = $row["ID_Loai"];
                                    $sql = "select TenLoai from loaixe where ID_Loai = $idloai";
                                    $getloai = read_db($sql);
                                    if($getloai->num_rows > 0)
                                    {
                                        $rowl = $getloai->fetch_assoc();
                                    ?>
                                    <em>Loại: <?php echo $rowl["TenLoai"]; ?></em><br>
                                    <?php
                                    }
                                }
                            ?>

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
					echo "<li class='pages'><a href='index.php?act=products&cat=$cat&subid=$id&start=$pre'>Prev</a></li>";
				}
				
				for($page = 1; $page <= $sum_pages; $page++){
					$start = ($page - 1) * $display;
					if($hientai == $page){
						echo "<li class='pages' style='background:#3fb4fb'><a href='index.php?act=products&cat=$cat&subid=$id&start=$start' style='color:#fff'>$page</a></li>";
					}
					else{
						echo "<li class='pages'><a href='index.php?act=products&cat=$cat&subid=$id&start=$start'>$page</a></li>";
					}	
				}
				
				if($hientai != $sum_pages){
					$next = $pos + $display;
					echo "<li class='pages'><a href='index.php?act=products&cat=$cat&subid=$id&start=$next'>Next</a></li>";
				}
		}
		?>
	
		<div class="clr"></div>
	</ul>
</div>
