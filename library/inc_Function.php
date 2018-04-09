<?php
ob_start();
if (!function_exists("redirect")) {

    function redirect($url) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
        ob_end_flush();
    }

}
if (!function_exists("isAuthenticated")) {

    function isAuthenticated() {
        if (isset($_SESSION["auth"]) && $_SESSION["auth"] == 1) {
            return true;
        }
        if (isset($_COOKIE["auth_user_id"])) {
            $id = $_COOKIE["auth_user_id"];

            $query = "select * from user where ID = $id";
            $rs = read_db($query);
            if ($rs->num_rows == 0) {
                return false;
            }
            $row = $rs->fetch_assoc();

            $user = array();
            $user["id"] = $row["ID"];
            $user["level"] = $row["Level"];
            $user["username"] = $row["Username"];
            $user["password"] = $row["Password"];
            $user["email"] = $row["Email"];
            $user["address"] = $row["Address"];
            $user["name"] = $row["Name"];
            $user["phone"] = $row["Phone"];
            $user["sex"] = $row["Sex"];

            $_SESSION["auth"] = 1;
            $_SESSION["auth_user"] = $user;
            return true;
        } else {
            if (isset($_SESSION["register_send"])) {
                $id = $_SESSION["register_send"];
                $query = "select * from user where ID = $id";
                $rs = read_db($query);
                if ($rs->num_rows == 0) {
                    return false;
                }
                $row = $rs->fetch_assoc();

                $user = array();
                $user["id"] = $row["ID"];
                $user["level"] = $row["Level"];
                $user["username"] = $row["Username"];
                $user["password"] = $row["Password"];
                $user["email"] = $row["Email"];
                $user["address"] = $row["Address"];
                $user["name"] = $row["Name"];
                $user["phone"] = $row["Phone"];
                $user["sex"] = $row["Sex"];

                $_SESSION["auth"] = 1;
                $_SESSION["auth_user"] = $user;
                unset($_SESSION["register_send"]);
                return true;
            }
        }
        return false;
    }

}

if (!function_exists("setCart")) {

    function setCart($id, $sluong) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        if (array_key_exists($id, $_SESSION["cart"])) {
            $_SESSION["cart"][$id] += $sluong;
        } else {
            $_SESSION["cart"][$id] = $sluong;
        }
    }

}
if (!function_exists("demgiohang")) {

    function demgiohang() {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        $sum = 0;
        foreach ($_SESSION["cart"] as $id => $soluong) {
            $sum += $soluong;
        }
        return $sum;
    }
}

function getCart() {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    return $_SESSION["cart"];
}

if (!function_exists("remove_cart_item")) {
function remove_cart_item($id) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    foreach ($_SESSION["cart"] as $proId => $quantity) {
        if ($proId == $id) {
            unset($_SESSION["cart"][$id]);
            return;
        }
    }
}
}