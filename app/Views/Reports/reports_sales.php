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
                         <th>Receipt No.</th>
                         <th>Item</th>
                         <th>Order Date</th>
                         <th>Unit Price</th>
                         <th>Quantity Sold</th>
                         <th>Sales Amount</th>
                    </thead>
                    <tbody>
                         <?php
                              $totalSales = 0;
                              $database->DBQuery("SELECT * FROM `sales` LEFT JOIN `inventory` ON sales.inv_id=inventory.inv_id WHERE sales.s_order_date BETWEEN ? AND ? ORDER BY sales.s_no DESC", [$start_date, $end_date]);
                              if($database->rowCount() > 0):
                                   foreach($database->fetchAll() AS $sale):

                                   $salesAmount = 0;
                                   $salesAmount += ($sale->inv_price * $sale->s_qty);

                                   $totalSales += $salesAmount;
                         ?>
                              <tr class="odd:bg-gray-50 even:bg-white sale-record">
                                   <td><?= $sale->receipt_no ?></td>
                                   <td><?= $sale->inv_product ?></td>
                                   <td><?= $functions->formatDateTime($sale->s_order_date, "M d, Y") ?></td>
                                   <td>&#8369; <?= number_format($sale->inv_price, 2) ?></td>
                                   <td><?= $sale->s_qty ?></td>
                                   <td>&#8369; <span class="sale"><?= number_format($salesAmount, 2) ?></span></td>
                                   <td>
                              </tr>
                         <?php endforeach ?>
                         <?php else: ?>
                                   <tr>
                                        <td colspan="6" class="txt-center">No Recent Sales Found</td>
                                   </tr>
                         <?php endif ?>
                         <tr class="border-t border-t-gray-300/40 border-b border-b-gray-300/40">
                              <td colspan="5" class="text-left border-r border-r-gray-300/40">Total Sales</td>
                              <td class="text-right">&#8369; <?php echo number_format($totalSales, 2) ?></td>
                         </tr>
                         <tr>
                              <td colspan="6">
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