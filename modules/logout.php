<?php
    session_start();
    require "../library/inc_Function.php";
    
    if(isAuthenticated() === true){
        unset($_SESSION["auth"]);
        unset($_SESSION["auth_user"]);
        
        if (isset($_COOKIE["auth_user_id"])) {
        setcookie("auth_user_id", '', time() - 3600);
        }
    }
    redirect("../index.php");
?>