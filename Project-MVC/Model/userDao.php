<?php
function loginUser($email, $password){
    require_once "../Model/dbmanager.php";
    $statement = $pdo->prepare("SELECT COUNT(*) as broi FROM users WHERE email = ? AND password = ?");
    $statement->execute(array($email, $password));
    $result = $statement->fetch();
    return $result["broi"] > 0;
}


function registerUser($username, $email, $password)
{
    require_once "../Model/dbmanager.php";
    $statement = $pdo->prepare("INSERT INTO users (username, password, email)         VALUES (?,?,?)");

    if ($statement->execute(array($username, $password, $email))) {
        return true;
    } else {
        return false;
    }
}