<?php
session_start();
require "../library/inc_Connection.php";
require "../library/inc_Function.php";
if(isset($_POST["captcha"])){
    if (empty($_SESSION['captcha']) || trim(strtolower($_POST["captcha"])) != $_SESSION['captcha']) {
        echo "false";
    } else {
        $username = addslashes($_POST["username"]);
        $sqlcheck = "select * from user where Username = '$username'";
        $rs = read_db($sqlcheck);
        if ($rs->num_rows > 0) {
            echo "error";
        } else {
            $password = addslashes($_POST["password"]);
            $md_password = md5($password);
            $email = $_POST["email"];
            $fullname = $_POST["fullname"];
            $sex = $_POST["sex"];
            if ($sex == 1) {
                $sex = "Nam";
            } else {
                $sex = "Nữ";
            }
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $captcha = $_POST["captcha"];

            $query = "insert into User(Username, Password, Name, Email, Phone, Address, Sex, Level) values('$username', '$md_password', '$fullname', '$email', '$phone', '$address', '$sex', 0)";         
            $id = write_db($query, 0);
            $_SESSION["register_send"] = $id;
            echo "true";
        }
    }
}