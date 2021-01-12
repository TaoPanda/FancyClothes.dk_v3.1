<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST)){
    if($_POST["password"] == $_POST["passwordConfirmation"]){
        include_once "connect.php";
        $statement = $dbh->prepare("INSERT INTO `users`(`username`, `password`) VALUES (?,?)");
        //$hash = password_hash($_POST["password"], PASSWORD_ARGON2ID)
        $statement->execute([$_POST["username"], password_hash($_POST["password"], PASSWORD_ARGON2ID)]);
        unset($_SESSION["passwordMissmatch"]);
        header("location: ../");
    }else{
        $_SESSION["passwordMissmatch"] = "Passwords er ikke ens";
        header("location: ../register.php");
    }
}else{
    header("location: ../");
}