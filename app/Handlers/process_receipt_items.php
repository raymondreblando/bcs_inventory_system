<?php
require_once '../../initialized.php';

$product_name = $functions->validate($_POST['product_name']);
$quantity = $functions->validate($_POST['quantity']);

if(empty($product_name) OR empty($quantity)){
    $functions->notification("Please fill up all the fields.", "error", 2500, "");
}else{
    $database->DBQuery("INSERT INTO `receipt` (`r_id`,`inv_id`,`r_qty`,`r_date_created`,`user_id`) VALUES (?,?,?,?,?)", [RANDOM_ID, $product_name, $quantity, TODAYS, $_SESSION['uid']]);

    $database->DBQuery("SELECT `inv_id`,`inv_product`,`inv_price` FROM `inventory` WHERE `inv_id` = ? LIMIT 1",[$product_name]);
    $productName = $database->fetch();

    $functions->notification("Item successfully added.", "success", 500, "yes");
}

$database->closeConnection();