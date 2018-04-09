<?php
session_start();
require "../library/inc_Connection.php";
require "../library/inc_Function.php";
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = addslashes($_POST["username"]);
    $password = addslashes($_POST["password"]);
    $md5_pass = md5($password);
    $query = "select * from user where Username = '$username' and Password = '$md5_pass'";
    $rs = read_db($query);
    if ($rs->num_rows == 0) {
        $login_fail = 1;
        echo "false";
    } else {
        $row = $rs->fetch_assoc();       
        $user = array();
        $user["id"] = $row["ID"];
        $user["username"] = $row["Username"];
        $user["password"] = $row["Password"];
        $user["email"] = $row["Email"];
        $user["address"] = $row["Address"];
        $user["name"] = $row["Name"];
        $user["phone"] = $row["Phone"];
        $user["sex"] = $row["Sex"];
        $user["Level"] = $row["Level"];
        $_SESSION["auth"] = 1;
        $_SESSION["auth_user"] = $user;
        if($user["Level"] === '1'){
            echo "admin";
        }
        else{
            echo "user";
            
        }

        //set cookie

        if (isset($_POST["check"])) { 
			$check = $_POST["check"];
			if($check == "on"){
				$expire = time() + 7 * 24 * 60 * 60;
				setcookie("auth_user_id", $row["ID"], $expire);
			}
        }
    }
}
