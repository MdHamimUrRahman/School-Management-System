<?php
session_start();
if(empty($_SESSION['login_user']))
{
    header('Location: login.php');
    exit();
}
?>