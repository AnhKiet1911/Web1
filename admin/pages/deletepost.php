<?php
	require "../../library/inc_Connection.php";
	require "../../library/inc_Function.php";
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "delete from products where proid = $id";
		$iddel = write_db($sql, 1);
		redirect("../index.php?act=viewpost");
	}
	if(isset($_GET["idloai"])){
		$idloai = $_GET["idloai"];
		$sql = "delete from loaixe where ID_Loai = $idloai";
		$delrow = write_db($sql, 1);
		redirect("../index.php?act=viewloai");
	}
	if(isset($_GET["idloai"])){
		$idloai = $_GET["idloai"];
		$sql = "delete from loaixe where ID_Loai = $idloai";
		$delrow = write_db($sql, 1);
		redirect("../index.php?act=viewloai");
	}
?>