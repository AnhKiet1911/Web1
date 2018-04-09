<?php
    session_start();
    require "../../library/inc_Connection.php";
    require "../../library/inc_Function.php";
     
    if (isset($_POST["name"]) && isset($_POST["email"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $sex = $_POST["sex"];
        if($sex == 1){
            $sex = 'Nam';
        }
        else{
            $sex = 'Nữ';
        }
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        if(isset($_SESSION["auth_user"])){  
            $checkpass = $_SESSION["auth_user"]["password"];
            $username = $_SESSION["auth_user"]["username"];
        }
        
        $sql = "UPDATE user SET name = '$name', sex = '$sex', email = '$email', phone = '$phone', address = '$address' WHERE username = '$username'";
        
        if(isset($_POST["passpre"]) && isset($_POST["passnew"])){
            $passpre = $_POST["passpre"];
            $passnew = $_POST["passnew"];
            
            $md_passpre = md5($passpre);
            $md_passnew = md5($passnew);
            
            if(strcmp($md_passpre, $checkpass) !== 0){
                echo "false";
                return false;
            } 
            else{
                $sql = "UPDATE user SET name = '$name', sex = '$sex', email = '$email', phone = '$phone', address = '$address', Password = '$md_passnew' WHERE username = '$username'";
            }
        }
        $id = write_db($sql, 1);
        unset($_SESSION["auth_user"]);
        unset($_SESSION["auth"]);
        unset($_SESSION["register_send"]);
        $_SESSION["register_send"] = $id;
        echo "true";
    }

