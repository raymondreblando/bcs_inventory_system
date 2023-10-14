<?php
require_once '../../initialized.php';

$product_name = $functions->validate($_POST['product_name']);
$supplier = $functions->validate($_POST['supplier']);
$order_quantity = $functions->validate($_POST['order_quantity']);

if(empty($product_name) OR empty($supplier) OR empty($order_quantity)){
    $functions->notification("Please fill up all the fields.", "error", 2500, "");
}else{
    $database->DBQuery("INSERT INTO `purchases` (`p_id`,`inv_id`,`p_supplier`,`p_order_qty`,`p_date_added`) VALUES (?,?,?,?,?)", [RANDOM_ID, $product_name, $supplier, $order_quantity, TODAYS]);
    $functions->notification("Purchase successfully saved.", "success", 1500, "yes");
}

$database->closeConnection();