<?php
    session_start();
    require '../library/inc_Function.php';
    //cập nhật
    if(isset($_POST["soluong"]) && isset($_POST["id"])){
        $soluongup = $_POST["soluong"];
        $id = $_POST["id"];
        $_SESSION['cart'][$id] = $soluongup;
        return;
    }    
    //xóa
    if(isset($_GET["idxoa"])){
        $idxoa = $_GET["idxoa"];
        remove_cart_item($idxoa);
        redirect("../index.php?act=cart");
    }
    