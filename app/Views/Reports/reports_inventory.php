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
                         <th>Category</th>
                         <th>Price</th>
                         <th>Unit</th>
                         <th>Quantity in Stock</th>
                         <th>Reorder Level</th>
                         <th>Quantity in Reorder</th>
                    </thead>
               <tbody>
               <?php
                         $database->DBQuery("SELECT * FROM `inventory` LEFT JOIN `category` ON inventory.category_id=category.category_id WHERE inventory.inv_added_date BETWEEN ? AND ? ORDER BY inventory.inv_no DESC", [$start_date, $end_date]);
                         if($database->rowCount() > 0):
                         foreach($database->fetchAll() AS $inventory):
                         $inventory_value = ($inventory->inv_price * $inventory->inv_stocks);
               ?>
                         <tr class="odd:bg-gray-50 even:bg-white">
                              <td><?= $inventory->inv_product ?></td>
                              <td><?= $inventory->category_name ?></td>
                              <td>&#8369; <?= number_format($inventory->inv_price, 2) ?></td>
                              <td><?= $inventory->inv_unit ?></td>
                              <td><?= $inventory->inv_stocks ?></td>
                              <td><?= $inventory->inv_reorder_level ?></td>
                              <td><?= $inventory->inv_qty_reorder ?></td>
                         </tr>
                         <?php endforeach ?>
               <?php else: ?>
                         <tr>
                         <td colspan="9" class="txt-center">No Record Found</td>
                         </tr>
               <?php endif ?>
               <tr>
                    <td colspan="7">
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