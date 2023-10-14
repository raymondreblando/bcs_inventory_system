<?php
require_once '../../initialized.php';

$product_name = $functions->validate($_POST['product_name']);

$database->DBQuery("SELECT `inv_id`,`inv_price` FROM `inventory` WHERE `inv_id` = ? LIMIT 1", [$product_name]);
$getPrice = $database->fetch();

$data = array(
       'price' => number_format($getPrice->inv_price, 2)
);

header('Content-Type: application/json');
$json = json_encode($data);
echo $json;

$database->closeConnection();