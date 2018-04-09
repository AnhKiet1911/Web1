<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>

<?php
	$sql = "select tenloai, id_loai from loaixe GROUP BY id_loai, tenloai";
	$rs = read_db($sql);
	if(isset($_POST["txtID"]) && isset($_POST["txtGT"])){
		$idloai = $_POST["txtID"];
		$gtLoai = $_POST["txtGT"];
		
		$sql = "update loaixe set TenLoai = '$gtLoai' where ID_Loai = $idloai";
		$upid = write_db($sql, 1);
		redirect("index.php?act=viewloai");
	}
?>
<div class="w3l-table-info">
  <h3>Tất cả các loại xe</h3>
	<table id="table">
	<thead>
	  <tr>
		<th>Tên</th>
		<th>Sửa</th>
		<th>Xóa</th>
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
					<td><a href="javascript:;" onclick="setID(<?php echo $row["id_loai"]; ?>)">Sửa</a></td>
					<td><a href="pages/deletepost.php?idloai=<?php echo $row["id_loai"]; ?>" onclick="return show_noti();">Xóa</a></td>
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
		frmLoai.txtID.value = id;
		var value = "txttenloai_" + id;
		
		var name = document.getElementById(value);
		var gt = name.value;
		frmLoai.txtGT.value = gt;
		frmLoai.submit();
	}
</script>
