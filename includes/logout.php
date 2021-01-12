<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION["username"], $_SESSION["password"], $_SESSION["userlevel"]);
header("location: ../");