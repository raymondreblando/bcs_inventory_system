<?php
require_once '../../initialized.php';

$product_name = $functions->validate($_POST['product_name']);
$category = $functions->validate($_POST['category']);
$price = str_replace(",", "", $functions->validate($_POST['price']));
$unit = $functions->validate($_POST['unit']);
$stock = $functions->validate($_POST['stock']);
$reorder_level = $functions->validate($_POST['reorder_level']);

if(empty($product_name) OR empty($category) OR empty($price) OR empty($unit) OR empty($stock) OR empty($reorder_level)){
    $functions->notification("Please fill up all the fields.", "error", 2500, "");
}else{
    $database->DBQuery("INSERT INTO `inventory` (`inv_id`,`inv_product`,`category_id`,`inv_price`,`inv_stocks`,`inv_reorder_level`,`inv_added_date`,`inv_unit`) VALUES (?,?,?,?,?,?,?,?)", [RANDOM_ID, $product_name, $category, $price, $stock, $reorder_level, TODAYS, $unit]);
    $functions->notification("Inventory successfully saved.", "success", 1500, "yes");
}

$database->closeConnection();