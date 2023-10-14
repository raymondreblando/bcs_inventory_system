<?php
require_once '../../initialized.php';

$id = $functions->validate($_POST['id']);
$firstname = $functions->validate($_POST['firstname']);
$middlename = $functions->validate($_POST['middlename']);
$lastname = $functions->validate($_POST['lastname']);
$gender = $functions->validate($_POST['gender']);
$phone_number = $functions->validate($_POST['phone_number']);
$email_address = $functions->validate($_POST['email_address']);
$address = $functions->validate($_POST['address']);

$check_email_exist = 0;

if(empty($firstname) OR empty($lastname) OR empty($gender) OR empty($phone_number) OR empty($email_address) OR empty($address)){
       $functions->notification("Please fill-up all the fields.", "error", 2500, "yes");
}elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
       $functions->notification("Invalid email address.", "error", 2500, "");
}elseif (!empty($_POST['pass']) && strlen($_POST['pass']) < 6) {
       $functions->notification("Password must be more than 6 characters.", "error", 2500, "");
}else{
        $database->DBQuery("SELECT `user_id`,`email`,`photo` FROM `users` WHERE `user_id` = ?",[$id]);
        $user = $database->fetch();

        if($user->email !== $email_address){
              $database->DBQuery("SELECT `email` FROM `users` WHERE `email` = ?",[$email_address]);

              if($database->rowCount() > 0){
                     $check_email_exist = 0;
                     $functions->notification("Email address already used by other users.", "error", 2500, "");
              }else{
                     $check_email_exist = 1;
              }
       }else{
              $check_email_exist = 1;
       }


       if($check_email_exist == 1){
              if (!empty($_FILES["user_profile"])) {
                     $allowTypes = array('jpg', 'png', 'jpeg');
                     $filename = $_FILES["user_profile"]["name"];
                     $uploadDir = "../../uploads/profiles/";
                     $getFileExt = pathinfo($filename, PATHINFO_EXTENSION);
                     $newFilename = $functions->randomString(20)  ."." . $getFileExt;
                     if(!in_array($getFileExt, $allowTypes)){
                            $functions->notification("Uploaded file not Supported.", "error", 2500, "");
                     }else{
                            if($user->photo !== null){
                                   $current_profile = "../../uploads/profiles/".$user->photo;
                                   unlink($current_profile);
                            }

                            move_uploaded_file($_FILES["user_profile"]["tmp_name"], $uploadDir . $newFilename);

                            $database->DBQuery("UPDATE `users` SET `email`=?,`photo`=?,`fname`=?,`middle`=?,`lname`=?,`gender`=?,`contact`=?,`address`=? WHERE `user_id` = ?",[$email_address, $newFilename, $firstname, $middlename, $lastname, $gender, $phone_number, $address, $id]);

                            if(!empty($_POST['pass'])){
                                   $database->DBQuery("UPDATE `users` SET `password` = ? WHERE `user_id` = ?", [md5($_POST['pass']), $id]);
                            }

                            $functions->notification("User account successfully updated.", "success", 1500, "yes");
                     
                     }
              }else{
                     $database->DBQuery("UPDATE `users` SET `email`=?,`fname`=?,`middle`=?,`lname`=?,`gender`=?,`contact`=?,`address`=? WHERE `user_id` = ?",[$email_address, $firstname, $middlename, $lastname, $gender, $phone_number, $address, $id]);

                     if(!empty($_POST['pass'])){
                            $database->DBQuery("UPDATE `users` SET `password` = ? WHERE `user_id` = ?", [md5($_POST['pass']), $id]);
                     }

                     $functions->notification("User account successfully updated.", "success", 1500, "yes");
              }
       }
   
}

$database->closeConnection();