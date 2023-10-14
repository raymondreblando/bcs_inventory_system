<?php
require_once '../../initialized.php';

$category_name = $functions->validate($_POST['category_name']);

if(empty($category_name)){
    $functions->notification("Please provide category name.", "error", 2500, "");
}else{
    $database->DBQuery("SELECT * FROM `category` WHERE `category_name` = ?", [$category_name]);
    if($database->rowCount() > 0){
       $functions->notification("Category name already exist.", "error", 2500, "");
    }else{
       $database->DBQuery("INSERT INTO `category` (`category_id`,`category_name`) VALUES (?,?)", [RANDOM_ID, $category_name]);
       $functions->notification("Category successfully saved.", "success", 1500, "yes");
    }
    
}

$database->closeConnection();