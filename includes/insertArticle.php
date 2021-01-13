<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST)){
    include_once "connect.php";
    $statement = $dbh->prepare("INSERT INTO `products`(`overskrift`, `imgPath`, `imgAlt`, `infotext`, `userid`, `starAmount`, `kategori`) VALUES (?,?,?,?,?,?,?)");
    $statement->execute([$_POST["heading"], $_POST["imgSrc"], $_POST["imgAlt"], $_POST["content"], $_SESSION["userid"], $_POST["stars"], $_POST["category"]]);
    header("location: ../");
}else{
    header("location: ../");
}