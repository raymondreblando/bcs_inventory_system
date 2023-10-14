<?php
require_once '../../../initialized.php';

$report_type = $functions->validate($_POST['report_type']);
$start_date = $functions->validate($_POST['start_date']);
$end_date = $functions->validate($_POST['end_date']);

if(empty($report_type) OR empty($start_date) OR empty($end_date)){
    $functions->notification("Please fillup all the required field.", "error", 2500, "");
}else{
     ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Reports</title>
    </head>
    <body>
          <div class="mb-4">
               <div class="shrink-0 w-10 h-10 grid place-items-center rounded-full bg-primary text-white font-semibold mx-auto">
                    <img src="<?= SYSTEM_URL . '/public/images/icon.svg' ?>" alt="bcs logo" class="w-full h-full object-contain">
               </div>
               <p class="text-center">Balogo Construction Supplies</p>
               <p class="text-center">Inventory Management System</p>
               <p class="text-center uppercase"><?php echo $report_type ?></p>
               <p class="text-center"><?php echo $functions->formatDateTime($start_date, "M d, Y") ." to ". $functions->formatDateTime($end_date, "M d, Y") ?></p>
          </div>
          
          
          <div class="w-full bg-white">
               <table id="my-table" class="w-full border-collapse text-center whitespace-nowrap">
               <thead>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Order Quantity</th>
                    <th>Received Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total Cost</th>
                    <th>PO Date</th>
               </thead>
               <tbody>
                    <?php
                         $database->DBQuery("SELECT * FROM `purchases` LEFT JOIN `inventory` ON purchases.inv_id=inventory.inv_id WHERE purchases.p_date_added BETWEEN ? AND ? ORDER BY purchases.p_no DESC", [$start_date, $end_date]);
                         if($database->rowCount() > 0):
                         foreach($database->fetchAll() AS $purchases):
                    ?>
                         <tr class="odd:bg-gray-50 even:bg-white">
                              <td><?= $purchases->inv_product ?></td>
                              <td><?= $purchases->inv_unit ?></td>
                              <td><?= $purchases->p_supplier ?></td>
                              <td>
                              <span class="status status-<?= strtolower($purchases->p_status) ?>"><?= $purchases->p_status ?></span>
                              </td>
                              <td><?= $purchases->p_order_qty ?></td>
                              <td><?= $purchases->p_received_qty ?></td>
                              <td>&#8369; <?= number_format($purchases->p_unit_cost, 2) ?></td>
                              <td>&#8369; <?= number_format($purchases->p_total_cost, 2) ?></td>
                              <td><?= $functions->formatDateTime($purchases->p_date_added, "M d, Y") ?></td>
                         </tr>
                    <?php endforeach ?>
               <?php else: ?>
                         <tr>
                         <td colspan="9" class="txt-center">No Recent Purchase Found</td>
                         </tr>
               <?php endif ?>
               <tr>
                    <td colspan="9">
                         <div class="flex justify-between">
                              <p>Date/Time Generated: <?php echo date("M d, Y - h:s A") ?></p>
                              <p>Prepared By: <?php echo $_SESSION['fullname'] ?></p>
                         </div>
                    </td>
               </tr>
               </tbody>
               </table>
        </div>
    </body>
    </html>
<?php 

     $htmlContent = ob_get_clean();

     echo $htmlContent;

}
$database->closeConnection(); 

?>