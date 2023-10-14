<?php
require_once '../../initialized.php';

$email = $functions->validate($_POST['email']);
$password = $functions->validate($_POST['password']);

if(empty($email) OR empty($password)){
    $functions->notification("Please provide your email and password.", "error", 2500, "");
}else{
    $database->DBQuery("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?", [$email, md5($password)]);
    $user = $database->fetch();
    if($database->rowCount() > 0){
        $_SESSION["login"] = true;
        $_SESSION["uid"] = $user->user_id;
        $_SESSION["role"] = $user->role_id;
        $_SESSION["fullname"] = $user->fname." ".$user->lname;
        $functions->html_fetch('<script>window.location.href = "'.SYSTEM_URL.'/home";</script>');
    }else{
        $functions->notification("Wrong username and password.", "error", 2500, "");
    }
}

$database->closeConnection();