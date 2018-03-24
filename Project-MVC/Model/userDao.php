<?php

function loginUser($email, $password){
    require_once "../Model/dbmanager.php";
    $statement = $pdo->prepare("SELECT COUNT(*) as broi FROM users WHERE email = ? AND password = ?");
    $statement->execute(array($email, $password));
    $result = $statement->fetch();
    return $result["broi"] > 0;
}


function registerUser($username, $email, $password){
    require_once "../Model/dbmanager.php";
    $statement = $pdo->prepare("INSERT INTO users (username, password, email)         VALUES (?,?,?)");

    if ($statement->execute(array($username, $password, $email))) {
        return true;
    } else {
        return false;
    }
}

function getLoggedUserFromDB ($email) {
    require_once "../Model/dbmanager.php";
    $statement = $pdo->prepare("SELECT * FROM users WHERE email= ? ");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function saveProfile($username, $email, $password,$id_user){
    require_once "../Model/dbmanager.php";
    $statement = $pdo->prepare("UPDATE users SET username = ?, email = ?, password =? WHERE id_user = ?");

    if ($statement->execute(array($username, $email, $password, $id_user))) {
        return true;
    } else {
        return false;
    }
}
