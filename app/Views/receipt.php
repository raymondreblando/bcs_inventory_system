<?php

$page_title = "POS";

$active_tab = "POS";

require_once("./initialized.php");

include 'Partials/header.php';

$redirect->checkLoggedIn(SYSTEM_URL);

?>
<body>
  <main class="min-h-screen grid md:grid-cols-[15rem_auto]">

    <?php include 'Partials/sidebar.php';  ?>

    <main>
      <div class="h-[4.55rem] flex items-center justify-between gap-4 bg-white border-b border-b-gray-300/40 py-3 px-6">
        <div class="flex items-center gap-3">
          <button class="menu-btn block md:hidden text-xl font-semibold"><i class="ri-menu-fill"></i></button>
          <p class="text-[15px] font-semibold text-black">Point of Sale</p>
        </div>
      </div>
      <div class="py-6 px-6">
        <div class="grid md:grid-cols-3 gap-16 max-w-[1000px] mx-auto">
          <div>
            <form autocomplete="off">
              <div class="flex items-end justify-between gap-4 mb-4">
                <div>
                  <p class="text-base font-semibold uppercase">Purchased Items</p>
                  <p class="text-sm text-gray-500">Kindly provide the purchase item details</p>
                </div>
              </div>
              <div class="mb-4">
                <label for="product_name" class="block text-sm font-medium text-gray-800 mb-2">Product Name</label>
                <div class="custom-select relative group flex items-center justify-between gap-4 border border-gray-300/40 px-4 rounded-sm">
                  <input type="text" class="search-product w-full h-12 text-sm text-gray-500 outline-none rounded-sm placeholder:text-gray-500" placeholder="Enter product name">
                  <i type="button" class="remove-search hidden ri-close-line cursor-pointer"></i>
                  
                  <div class="select-wrapper hidden max-h-[125px] absolute top-[110%] inset-x-0 bg-white py-2 shadow-md rounded-sm overflow-y-auto">
                    <input type="hidden" class="select-value" id="product_name">
                    <?php 
                        $database->DBQuery("SELECT `inv_id`,`inv_product`,`inv_price` FROM `inventory` ORDER BY `inv_product` ASC");
                        foreach ($database->fetchAll() as $inventory) {
                                echo '<li class="select-option text-xs font-medium text-gray-500 hover:bg-gray-50 cursor-pointer py-1 px-2" data-value="'.$inventory->inv_id.'" data-price="'.$inventory->inv_price.'">'.$inventory->inv_product.'</li>';
                        }
                    ?>
                  </div>
                </div>
              </div>
              <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-800 mb-2">Price</label>
                <input type="text" id="price" class="money w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter the price" readonly>
              </div>
              <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-800 mb-2">Quantity</label>
                <input type="text" id="quantity" class="num_only w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter the quantity">
              </div>
              <button type="button" id="saveItemsReceipt" class="h-max bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md mt-auto mb-12">Add Item</button>
            </form>

            <div>
              <label for="payment" class="block text-sm font-medium text-gray-800 mb-2">Cash Payment</label>
              <input type="text" id="payment" class="money w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter the payment" autocomplete="off">
            </div>
          </div>
          <div class="md:col-span-2">
            <div class="w-[calc(100vw-3rem)] md:w-full bg-white rounded-md overflow-x-auto p-12 border border-gray-300/40 mb-4">
              <div id="printArea">
                <p class="d-none text-xl font-bold text-center">Balogo Construction Supplies</p>
                <p class="d-none font-medium text-center mb-12">Balogo, Oas, Albay</p>
    
                <table id="my-table" class="w-full border-collapse text-center">
                  <thead>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="print-hidden">Action</th>
                  </thead>
                  <tbody>
                    <?php
                        $database->DBQuery("SELECT `receipt_no` FROM `sales` ORDER BY `s_no` DESC LIMIT 1");
                        if($database->rowCount() > 0){
                               $recent_receipt_no = $database->fetch();
                               $receipt_no = $recent_receipt_no->receipt_no + 1;
                        }else{
                               $receipt_no = "1000001";
                        }

                          $total_amount = 0;
                          $item_count = 0;
                          $database->DBQuery("SELECT * FROM `receipt` LEFT JOIN `inventory` ON receipt.inv_id=inventory.inv_id ORDER BY receipt.r_no DESC");
                          if($database->rowCount() > 0):
                            foreach($database->fetchAll() AS $receipt):
                              $total_amount += ($receipt->inv_price * $receipt->r_qty);
                              $item_count += $receipt->r_qty;
                    ?>
                              <tr class="">
                                <td><?= $receipt->inv_product ?></td>
                                <td>&#8369; <?= number_format($receipt->inv_price, 2) ?></td>
                                <td><?= $receipt->r_qty ?></td>
                                <td class="print-hidden"><button><img src="<?php echo SYSTEM_URL ?>/public/icons/minus-cirlce-linear.svg" alt="remove" data-id="<?=  $receipt->r_id ?>" class="removeItemsReceipt w-4 h-4" title="Remove Item"></button></td>
                              </tr>
                          <?php endforeach ?>
                          <tr>
                            <td colspan="3" class="text-left"></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Item Purchased</td>
                            <td class="text-right py-2"><?php echo $item_count ?></td>
                          </tr>
                          <tr>
                            <td colspan="4" class="py-3"></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Receipt Number</td>
                            <td class="text-right py-2"><?php echo $receipt_no ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Total Amount</td>
                            <td class="text-right py-2">&#8369; <span id="totalAmmount"><?php echo number_format($total_amount, 2) ?></span></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Cash</td>
                            <td class="text-right py-2">&#8369; <span id="paymentPay">0</span></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Change</td>
                            <td class="text-right py-2">&#8369; <span id="change">0</span></td>
                          </tr>
                          <tr>
                            <td colspan="4" class="py-6"></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Cashier</td>
                            <td class="text-right py-2"><?php echo $user_info->fname." ".$user_info->lname ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left py-2">Date / Time</td>
                            <td class="text-right py-2"><?php echo date("M d, Y - h:s A") ?></td>
                          </tr>
                    <?php else: ?>
                          <tr>
                              <td id="noRecordRow" colspan="9" class="txt-center">No Record Found</td>
                          </tr>
                    <?php endif ?>
                  </tbody>
                </table>
                <p class="d-none font-medium text-center mb-12">Thank You Come Again!</p>
              </div>
            </div>
            <button type="button" id="printBtn" class="block w-full md:w-max bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md ml-auto">Print Receipt</button>
          </div>
        <div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>