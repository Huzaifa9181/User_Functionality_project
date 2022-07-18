<?php

session_start();
session_unset();
session_destroy();

if(empty($_SESSION['loggedin'])){
    header("location: login.php");
}




?>