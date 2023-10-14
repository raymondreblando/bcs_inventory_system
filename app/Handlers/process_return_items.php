<?php
require_once '../../initialized.php';

$id = $functions->validate($_POST['id']);
$return_qty = $functions->validate($_POST['return_qty']);

if(empty($return_qty)){
    $functions->notification("Please enter items quatity.", "error", 2500, "");
}else{

     $database->DBQuery("SELECT * FROM `sales` WHERE sales.s_no = ?", [$id]);
     $receipt_info = $database->fetch();

     $receipt_recent_qty = $receipt_info->s_qty;

     if($return_qty > $receipt_recent_qty){
          $functions->notification("Please provide return quatity not more than the total item quantity.", "error", 2500, "");
     }else{
          $database->DBQuery("SELECT `inv_stocks` FROM `inventory` WHERE `inv_id` = ? LIMIT 1", [$receipt_info->inv_id]);
          $inventory = $database->fetch();

          $newstocks = ($inventory->inv_stocks + $return_qty);

          $new_sale_qty = ($receipt_recent_qty - $return_qty);

          $database->DBQuery("UPDATE `inventory` SET `inv_stocks` = ? WHERE `inv_id` = ? LIMIT 1", [$newstocks, $receipt_info->inv_id]);

          $database->DBQuery("UPDATE `sales` SET `s_qty` = ?, `s_status` = ? WHERE `s_no` = ? LIMIT 1", [$new_sale_qty, 'Returned', $id]);
          
          $functions->notification("Item successfully returned.", "success", 1500, "yes");
     }
}

$database->closeConnection();