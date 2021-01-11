<?php
if(isset($_POST)){
    include_once "connect.php";
    $statement = $dbh->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute([$_POST["username"]]);
    if($row = $statement->fetch()){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["username"] = $row["username"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["userlevel"] = $row["accesslevel"];
        echo "login succes!";
        header( "Refresh:2; ../", true, 303);
    }else{
        echo "brugeren findes ikke";
        header( "Refresh:2; ../", true, 303);
    }
}else{
    header("location: ../");
}