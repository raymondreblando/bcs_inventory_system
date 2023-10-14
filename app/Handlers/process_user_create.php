<?php
require_once '../../initialized.php';

$firstname = $functions->validate($_POST['firstname']);
$middlename = $functions->validate($_POST['middlename']);
$lastname = $functions->validate($_POST['lastname']);
$gender = $functions->validate($_POST['gender']);
$phone_number = $functions->validate($_POST['phone_number']);
$email_address = $functions->validate($_POST['email_address']);
$n_password = $functions->validate($_POST['n_password']);
$c_password = $functions->validate($_POST['c_password']);
$address = $functions->validate($_POST['address']);

if(empty($firstname) OR empty($middlename) OR empty($lastname) OR empty($gender) OR empty($phone_number) OR empty($email_address) OR empty($address) OR empty($n_password) OR empty($c_password)){
       $functions->notification("Please fill-up all the fields.", "error", 2500, "yes");
}elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
       $functions->notification("Invalid email address.", "error", 2500, "");
}elseif($n_password !== $c_password){
        $functions->notification("Passwords didn't match.", "error", 2500, "");
}elseif(strlen($n_password) < 6){
        $functions->notification("Password must be more than 6 characters.", "error", 2500, "");
}else{
        $database->DBQuery("SELECT `email` FROM `users` WHERE `email` = ?",[$email_address]);
        if($database->rowCount() > 0){
            $functions->notification("Email already exist.", "error", 2500, "");
        }else{
            if (!empty($_FILES["user_profile"])) {
                    $allowTypes = array('jpg', 'png', 'jpeg');
                    $filename = $_FILES["user_profile"]["name"];
                    $uploadDir = "../../uploads/profiles/";
                    $getFileExt = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFilename = $functions->randomString(20)  ."." . $getFileExt;
                    if(!in_array($getFileExt, $allowTypes)){
                        $functions->notification("Uploaded file not Supported.", "error", 2500, "");
                    }else{
                        move_uploaded_file($_FILES["user_profile"]["tmp_name"], $uploadDir . $newFilename);
                        $database->DBQuery("INSERT INTO `users` (`user_id`,`email`,`password`,`photo`,`fname`,`middle`,`lname`,`gender`,`contact`,`address`,`date_created`) VALUES (?,?,?,?,?,?,?,?,?,?,?)",[RANDOM_ID, $email_address, md5($n_password), $newFilename, $firstname, $middlename, $lastname, $gender, $phone_number, $address, TODAYS]);
                        $functions->notification("User account successfully created.", "success", 1500, "yes");
                    }
            }else{
                    $database->DBQuery("INSERT INTO `users` (`user_id`,`email`,`password`,`fname`,`middle`,`lname`,`gender`,`contact`,`address`,`date_created`) VALUES (?,?,?,?,?,?,?,?,?,?)",[RANDOM_ID, $email_address, md5($n_password), $firstname, $middlename, $lastname, $gender, $phone_number, $address, TODAYS]);
                    $functions->notification("User account successfully created.", "success", 1500, "yes");
            }
        }
       
}

$database->closeConnection();