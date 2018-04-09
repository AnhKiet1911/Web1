<?php
require "../library/inc_Function.php";
require "../library/inc_Connection.php";
if(isset($_GET["key"])){
	
	$key = $_GET["key"];
	if($key !== '')
	{
		$sql = "SELECT * FROM products WHERE ProName LIKE '%$key%' limit 5";
		$rs = read_db($sql);
	}
}
if(isset($rs) && $rs->num_rows > 0){
	while($row = $rs->fetch_assoc()){
		$img = $row["ImageUrl"];
		$name = $row["ProName"];
		$id = $row["ProID"];
		echo "<li>
				<img src='../images/products/thumb/$img' width='90px' height='60px'/>
				<p><a href='../index.php?act=detail&id=$id'>$name</a></p>				
			</li>";
	}
}else{
	echo "false";
}
?>