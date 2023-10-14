<?php
require_once '../../initialized.php';

$id = $functions->validate($_POST['id']);

$database->DBQuery("SELECT `user_id`,`photo` FROM `users` WHERE `user_id` = ?", [$id]);
$user = $database->fetch();

if($database->rowCount() > 0){
       if($user->photo !== null){
              $current_profile = "../../uploads/profiles/".$user->photo;
              unlink($current_profile);
       }
       $database->DBQuery("DELETE FROM `users` WHERE `user_id` = ?", [$id]);
       $functions->notification("User successfully removed.", "success", 1500, "yes");
}else{
       $functions->notification("Sorry, there is a problem removing the selected account. Please try again later", "error", 2500, "");
}

$database->closeConnection();