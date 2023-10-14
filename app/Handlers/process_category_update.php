<?php
require_once '../../initialized.php';

$id = $functions->validate($_POST['id']);
$category_name = $functions->validate($_POST['category_name']);

if(empty($category_name)){
    $functions->notification("Please provide category name.", "error", 2500, "");
}else{
    $database->DBQuery("SELECT * FROM `category` WHERE `category_name` = ? AND `category_id` <> ?", [$category_name, $id]);
    if($database->rowCount() > 0){
       $functions->notification("Category name already exist.", "error", 2500, "");
    }else{
       $database->DBQuery("UPDATE `category` SET `category_name`=? WHERE `category_id` = ?", [$category_name, $id]);
       $functions->notification("Category successfully updated.", "success", 1500, "yes");
    }
    
}

$database->closeConnection();