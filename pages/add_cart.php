<?php
   session_start();
require '../library/inc_Function.php';
if(isset($_POST["id"]) && isset($_POST["soluong"]))
{
    $id = $_POST["id"];
    $soluong = $_POST["soluong"];
    setCart($id, $soluong);
    $sum_cart = demgiohang();
    echo "true";
}else{
    echo "false";
}
