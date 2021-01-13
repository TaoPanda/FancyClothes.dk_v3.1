<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST)){
    include_once "connect.php";
    $usernameStatement = $dbh->prepare("SELECT username FROM users WHERE username = ?");
    $usernameStatement->execute([$_POST["username"]]);
    if($row = $usernameStatement->fetch()){
        $_SESSION["userCreationFail"] = "Brugernavn taget af anden bruger";
        header("location: ../register.php");
    }else{
        if($_POST["password"] == $_POST["passwordConfirmation"]){
            $insertStatement = $dbh->prepare("INSERT INTO `users`(`username`, `password`) VALUES (?,?)");
            $insertStatement->execute([$_POST["username"], password_hash($_POST["password"], PASSWORD_ARGON2ID)]);
            unset($_SESSION["userCreationFail"]);
            header("location: ../");
        }else{
            $_SESSION["userCreationFail"] = "Passwords er ikke ens";
            header("location: ../register.php");
        }
    }
}else{
    header("location: ../");
}