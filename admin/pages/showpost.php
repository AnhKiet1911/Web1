<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>

<?php
	$sql = "select * from products";
	$rs = read_db($sql);
?>
<div class="w3l-table-info">
  <h3>Tất Cả Sản Phẩm</h3>
	<table id="table">
	<thead>
	  <tr>
		<th>Tên</th>
		<th>Hãng</th>
		<th>Loại</th>
		<th>Giá tiền</th>
		<th>Sửa</th>
		<th>Xóa</th>
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
					<td><a href="index.php?act=editpost&id=<?php echo $row["ProID"]; ?>">Sửa</a></td>
					<td><a href="pages/deletepost.php?id=<?php echo $row["ProID"]; ?>" onclick="return show_noti();">Xóa</a></td>
				</tr>
				<?php
			}
		}
	?> 
	</tbody>
  </table>
</div>
