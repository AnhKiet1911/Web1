<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>

<?php
	$sql = "select * from hangxe";
	$rs = read_db($sql);
	if(isset($_POST["txtIDhang"]) && isset($_POST["txtGThang"])){
		$idhang = $_POST["txtIDhang"];
		$gthang = $_POST["txtGThang"];
		
		$sql = "update hangxe set Tenhang = '$gthang' where ID_hang = $idhang";
		echo $sql;
		$upidh = write_db($sql, 1);
		redirect("index.php?act=viewhang");
	}
?>
<div class="w3l-table-info">
  <h3>Tất cả các hãng xe</h3>
	<table id="table">
	<thead>
	  <tr>
		<th>Tên</th>
		<th>Sửa</th>
		<th>Xóa</th>
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
					<td><input type="text" class="form-control1" name="txttenloai_<?php echo $row["ID_Hang"]; ?>" id="txttenhang_<?php echo $row["ID_Hang"]; ?>" value="<?php echo $row["TenHang"]; ?>"></td>
					<td><a href="javascript:;" onclick="setID(<?php echo $row["ID_Hang"]; ?>)">Sửa</a></td>
					<td><a href="pages/deletepost.php?idhang=<?php echo $row["ID_Hang"]; ?>" onclick="return show_noti();">Xóa</a></td>
				</tr>
				<?php
			}
		}
	?> 
	</tbody>
  </table>
</div>
<script type="text/javascript">
	function setID(id){
		frmHang.txtIDhang.value = id;
		var value = "txttenhang_" + id;
		
		var name = document.getElementById(value);
		var gt = name.value;
		frmHang.txtGThang.value = gt;
		frmHang.submit();
	}
</script>
