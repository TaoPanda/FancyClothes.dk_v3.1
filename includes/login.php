<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST)){
    include_once "connect.php";
    $statement = $dbh->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute([$_POST["formUsername"]]);
    if($row = $statement->fetch()){
        if(password_verify($_POST["formPassword"], $row["password"])){
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["userlevel"] = $row["accesslevel"];
            unset($_SESSION["loginFail"]);
            header("location: ../");
        }else{
            $_SESSION["loginFail"] = "Forkert password";
            header("location: ../");
        }
    }else{
        $_SESSION["loginFail"] = "Brugernavn findes ikke";
        header("location: ../");
    }
}else{
    header("location: ../");
}