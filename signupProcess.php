<?php
session_start();
include_once 'UserRepository.php';

$name = $_POST["name"];
$email = $_POST["email"];
$pwd = $_POST["password"];
$UserRepository = new UserRepository('user');
$user1 = $UserRepository->findByEmail($email);
$user2 = $UserRepository->findByName($name);

if($user1) {
    $_SESSION["erreur"] = 'This email address is already taken! Try again.';
    header("location:signUp.php");
} elseif ($user2){
    $_SESSION["erreur"] = 'This display name is already taken! Try again.';
    header("location:signUp.php");
} else {
    $hash = password_hash($pwd, PASSWORD_DEFAULT);

    $UserRepository->Create(['email' => $email,'pwd'=>$hash,'name'=>$name]);
    $_SESSION["user"] = $email;
    $_SESSION["name"] = $name;
    header("location:index.php");
}

?>
