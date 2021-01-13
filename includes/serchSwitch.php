<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$check = true;
foreach($_SESSION["category"] as $category){
    if($category == $_GET["type"]){
        $check = false;
    }
}
if($check){
    $_SESSION["category"][] = $_GET["type"];
}else{
    $target = array_search($_GET["type"], $_SESSION["category"]);
    unset($_SESSION["category"][$target]);
}
header("location: ../");