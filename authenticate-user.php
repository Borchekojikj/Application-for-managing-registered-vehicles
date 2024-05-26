<?php
session_start();
require_once './Classes/User.php';





if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('Location: login.php?method=getnotallowed');
    die();
}



if (!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
    header('Location: login.php?error=allfieldsarerequired');
    die();
}


$username = trim($_POST['username']);
$password = trim($_POST['password']);

$user = new User($username, $password);

$auth = $user->authUser();

if ($auth) {
    $_SESSION['loggedIn'] = true;
    header("Location: admin.php");
    die();
} else {
    $_SESSION['logginError'] = 'Wrong credentials';
    header('Location: login.php?error=wrongcredentials');
    die();
}
