<?php
require_once '../../initialized.php';

$id = $functions->validate($_POST['id']);
$product_name = $functions->validate($_POST['product_name']);
$supplier = $functions->validate($_POST['supplier']);
$order_quantity = $functions->validate($_POST['order_quantity']);
$receive_quantity = $functions->validate($_POST['receive_quantity']);
$status = $functions->validate($_POST['status']);

if(empty($product_name) OR empty($supplier) OR empty($order_quantity) OR empty($receive_quantity) OR empty($status)){
    $functions->notification("Please fill up all the fields.", "error", 2500, "");
}else{
    $database->DBQuery("SELECT `inv_id`,`inv_price`,`inv_qty_reorder` FROM `inventory` WHERE `inv_id` = ?", [$product_name]);
    $inv_info = $database->fetch();

    $cost = ($inv_info->inv_price * $receive_quantity);

    $qty_in_reorder = ($inv_info->inv_qty_reorder + $receive_quantity);

    $database->DBQuery("UPDATE `purchases` SET `inv_id`=?,`p_supplier`=?,`p_order_qty`=?,`p_received_qty`=?,`p_unit_cost`=?,`p_total_cost`=?,`p_status`=? WHERE `p_id` = ?", [$product_name, $supplier, $order_quantity, $receive_quantity, $cost,$cost, $status, $id]);

    if($status === "Completed"){
        $database->DBQuery("SELECT `inv_id`,`inv_stocks` FROM `inventory` WHERE `inv_id` = ?", [$product_name]);
        $row = $database->fetch();

        $new_stocks = ($row->inv_stocks + $receive_quantity);
        $database->DBQuery("UPDATE `inventory` SET `inv_stocks`=?,`inv_qty_reorder`=? WHERE `inv_id` = ?", [$new_stocks,$qty_in_reorder, $product_name]);
    }
    
    $functions->notification("Purchase successfully updated.", "success", 1500, "yes");
}

$database->closeConnection();