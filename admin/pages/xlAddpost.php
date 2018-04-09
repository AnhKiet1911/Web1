<?php
require '../../library/inc_Connection.php';
if(isset($_POST["idHang"])){
    $idHang = $_POST["idHang"];
    $sql = "select TenLoai, ID_Loai from loaixe where ID_Hang = $idHang";
    $rsLoai = read_db($sql);
    if($rsLoai->num_rows > 0){
        while($row = $rsLoai->fetch_assoc()){
            $id = $row["ID_Loai"];
            $Ten = $row["TenLoai"];
            echo "<option value='$id'>$Ten</option>";
        }
    }
}

