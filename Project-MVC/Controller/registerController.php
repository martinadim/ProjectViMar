<?php


session_start();
require_once "../Model/userDao.php";

if(isset($_POST["register"])) {
    $error = false;
    $user = array();
    $email = htmlentities($_POST["email"]);
    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password1"]);  //две пароли ли ще имаме при регистрация??
    $regErr = [];
    if (empty($email) || empty($username) || empty($pass1)) {
        $regErr[] = "All fields must be filled";
    }
    if (mb_strlen($username) < 2){
        $regErr[] = "Min length for user  name  is  2 chars!";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $regErr[] = "Invalid  Email!";
    }
    try {
        if (registerUser($username, $email, sha1($password))) {
            header("Location: ../Controller/indexController.php?page=login");
        } else {
            require_once "../View/registerFail.html";
        }
    }
    catch (PDOException $e){
        require_once "../View/error.html";
    }
}