<?php
require_once '../../initialized.php';

$database->DBQuery("SELECT `receipt_no` FROM `sales` ORDER BY `s_no` DESC LIMIT 1");
if($database->rowCount() > 0){
       $recent_receipt_no = $database->fetch();
       $receipt_no = $recent_receipt_no->receipt_no + 1;
}else{
       $receipt_no = "1000001";
}

$database->DBQuery("SELECT * FROM `receipt`");
foreach($database->fetchAll() AS $row){
       $database->DBQuery("SELECT `inv_id`,`inv_stocks` FROM `inventory` WHERE `inv_id` = ?", [$row->inv_id]);
       $stocks = $database->fetch();

       $new_stocks = ($stocks->inv_stocks - $row->r_qty);

       $database->DBQuery("UPDATE `inventory` SET `inv_stocks`=? WHERE `inv_id` = ?", [$new_stocks, $row->inv_id]);
}

$database->DBQuery("INSERT INTO `sales` (`s_id`, `inv_id`, `s_qty`, `s_order_date`,`receipt_no`) SELECT ?, `inv_id`, `r_qty`, ?, ? FROM `receipt`", [RANDOM_ID, TODAYS, $receipt_no]);

$database->DBQuery("DELETE FROM `receipt`");

$database->closeConnection();