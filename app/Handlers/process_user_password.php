<?php
require_once '../../initialized.php';

$current_password = $functions->validate($_POST['current_password']);
$new_password = $functions->validate($_POST['new_password']);
$confirm_password = $functions->validate($_POST['confirm_password']);

if(empty($current_password)){
       $functions->notification("Please provide your current password.", "error", 2500, "");
}elseif(empty($new_password)){
       $functions->notification("Please provide new password.", "error", 2500, "");
}elseif(empty($confirm_password)){
       $functions->notification("Please confirm your new password.", "error", 2500, "");
}else{
       $database->DBQuery("SELECT * FROM `users` WHERE `password`=? AND `user_id`=?",[md5($current_password), $_SESSION['uid']]);
       if($database->rowCount() > 0){
              if(strlen($new_password) < 6){
                     $functions->notification("Password must be more than 6 characters.", "error", 2500, "");
              }elseif($new_password !== $confirm_password){
                     $functions->notification("Passwords didn't match.", "error", 2500, "");
              }else{
                     $database->DBQuery("UPDATE `users` SET `password`=? WHERE `user_id`=?",[md5($new_password), $_SESSION['uid']]);
                     $functions->notification("Password successfully change.", "success", 1500, "yes");
              }
       }else{
              $functions->notification("Incorrect current password.", "error", 2500, "");
       }
}

$database->closeConnection();