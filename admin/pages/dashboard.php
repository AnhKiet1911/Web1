<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>

<?php
	$sql = "select * from products ORDER BY PROID DESC limit 10";
	$rs = read_db($sql);
?>
<div class="w3l-table-info">
  <h3>10 Sản Phẩm Gần Đây</h3>
	<table id="table">
	<thead>
	  <tr>
		<th>Tên</th>
		<th>Hãng</th>
		<th>Loại</th>
		<th>Giá tiền</th>
	  </tr>
	</thead>
	<tbody>
	<?php
		if($rs->num_rows > 0)
		{
			while($row = $rs->fetch_assoc()){
				$idhang = $row["ID_Hang"];
				$sql = "select * from hangxe where ID_Hang = $idhang";
				$kq = read_db($sql);
				$rowhang = $kq->fetch_assoc();
				
				$idloai = $row["ID_Loai"];
				$sql = "select * from loaixe where ID_Loai = $idloai";
				$kq = read_db($sql);
				$rowloai = $kq->fetch_assoc();
				?>
				<tr>
					<td><?php echo $row["ProName"]; ?></td>
					<td><?php echo $rowhang["TenHang"]; ?></td>
					<td><?php echo $rowloai["TenLoai"]; ?></td>
					<td><?php echo number_format($row["Gia"]); ?></td>
					
				</tr>
				<?php
			}
		}
	?> 
	</tbody>
  </table>
</div>

<?php
	$sql = "select tenloai, id_loai from loaixe GROUP BY id_loai, tenloai";
	$rs = read_db($sql);
?>
<br> <br>
<div class="w3l-table-info">
  <h3>Các loại xe</h3>
	<table id="table">
	<thead>
	  <tr>
		<th>Tên</th>
	  </tr>
	</thead>
	<form name="frmLoai" id="frmLoai" method="POST">
		<input type="hidden" id="txtID" name="txtID"/>
		<input type="hidden" id="txtGT" name="txtGT"/>
	</form>
	<tbody>
	<?php
		if($rs->num_rows > 0)
		{
			while($row = $rs->fetch_assoc()){			
				?>
				<tr>
					<td><input type="text" class="form-control1" name="txttenloai_<?php echo $row["id_loai"]; ?>" id="txttenloai_<?php echo $row["id_loai"]; ?>" value="<?php echo $row["tenloai"]; ?>"></td>
				</tr>
				<?php
			}
		}
	?> 
	</tbody>
  </table>
</div>
<br> <br>
<?php
	$sql = "select * from hangxe";
	$rs = read_db($sql);
?>
<div class="w3l-table-info">
  <h3>Tất cả các hãng xe</h3>
	<table id="table">
	<thead>
	  <tr>
		<th>Tên</th>
	  </tr>
	</thead>
	<form name="frmHang" id="frmHang" method="POST">
		<input type="hidden" id="txtIDhang" name="txtIDhang"/>
		<input type="hidden" id="txtGThang" name="txtGThang"/>
	</form>
	<tbody>
	<?php
		if($rs->num_rows > 0)
		{
			while($row = $rs->fetch_assoc()){			
				?>
				<tr>
					<td>
					<input type="text" class="form-control1" name="txttenloai_<?php echo $row["ID_Hang"]; ?>" id="txttenhang_<?php echo $row["ID_Hang"]; ?>" value="<?php echo $row["TenHang"]; ?>"></td>
					</tr>
				<?php
			}
		}
	?> 
	</tbody>
  </table>
</div>
