<?php

$page_title = "Dashboard";

$active_tab = "Dashboard";

require_once("./initialized.php");

include 'Partials/header.php';

$redirect->checkLoggedIn(SYSTEM_URL);
$redirect->redirectNotAdmin(SYSTEM_URL);

$database->DBQuery("SELECT * FROM `inventory`");
$total_inventory = $database->rowCount();
$database->DBQuery("SELECT * FROM `purchases` WHERE `p_status` = 'Completed'");
$total_completed = $database->rowCount();
$database->DBQuery("SELECT * FROM `purchases` WHERE `p_status` = 'Cancelled'");
$total_unsuccessful = $database->rowCount();
$database->DBQuery("SELECT * FROM `users`");
$total_users = $database->rowCount();

?>
<body>
 
  <main class="min-h-screen grid md:grid-cols-[15rem_auto]">

    <?php include 'Partials/sidebar.php';  ?>

    <main>
      <div class="h-[4.55rem] flex items-center justify-between gap-4 bg-white border-b border-b-gray-300/40 py-3 px-6">
        <div class="flex items-center gap-3">
          <button class="menu-btn block md:hidden text-xl font-semibold"><i class="ri-menu-fill"></i></button>
          <p class="text-[15px] font-semibold text-black">Dashboard</p>
        </div>
      </div>
      <div class="py-6 px-6">
        <p class="text-sm text-gray-800 font-semibold leading-tight mb-4">Overview</p>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
          <div class="border border-gray-300/40 py-5 px-6 rounded-md">
            <div class="flex items-center justify-between gap-3 mb-4">
              <div class="flex items-center gap-2">
                <div class="w-10 h-10 grid place-items-center bg-blue-100 text-primary rounded-md">
                  <i class="ri-box-3-line text-xl"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-800 font-semibold leading-tight">Total <br> Inventory Supplies</p>
                </div>
              </div>
            </div>
            <p class="text-2xl text-black font-bold leading-tight"><?php echo $total_inventory; ?> <span class="text-xs text-gray-500 font-normal">Records</span></p>
          </div>
          <div class="border border-gray-300/40 py-5 px-6 rounded-md">
            <div class="flex items-center justify-between gap-3 mb-4">
              <div class="flex items-center gap-2">
                <div class="w-10 h-10 grid place-items-center bg-emerald-100 text-emerald-700 rounded-md">
                  <i class="ri-truck-line text-xl"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-800 font-semibold leading-tight">Completed <br> Purchases</p>
                </div>
              </div>
            </div>
            <p class="text-2xl text-black font-bold leading-tight"><?php echo $total_completed; ?> <span class="text-xs text-gray-500 font-normal">Records</span></p>
          </div>
          <div class="border border-gray-300/40 py-5 px-6 rounded-md">
            <div class="flex items-center justify-between gap-3 mb-4">
              <div class="flex items-center gap-2">
                <div class="w-10 h-10 grid place-items-center bg-rose-100 text-rose-600 rounded-md">
                  <i class="ri-truck-line text-xl"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-800 font-semibold leading-tight">Unsuccessful <br> Purchases</p>
                </div>
              </div>
            </div>
            <p class="text-2xl text-black font-bold leading-tight"><?php echo $total_unsuccessful; ?> <span class="text-xs text-gray-500 font-normal">Records</span></p>
          </div>
          <div class="border border-gray-300/40 py-5 px-6 rounded-md">
            <div class="flex items-center justify-between gap-3 mb-4">
              <div class="flex items-center gap-2">
                <div class="w-10 h-10 grid place-items-center bg-purple-100 text-purple-600 rounded-md">
                  <i class="ri-user-3-line text-xl"></i>
                </div>
                <div>
                  <p class="text-sm text-gray-800 font-semibold leading-tight">Total System <br> Users</p>
                </div>
              </div>
            </div>
            <p class="text-2xl text-black font-bold leading-tight"><?php echo $total_users; ?> <span class="text-xs text-gray-500 font-normal">Records</span></p>
          </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
          <div class="border border-gray-300/40 rounded-md">
            <div class="py-4 px-6">
              <p class="text-sm text-gray-600 font-medium leading-tight">Recent Added Item</p>
            </div>
            <div class="w-[calc(100vw-3rem)] md:w-auto bg-white rounded-md overflow-x-auto">
              <table class="w-full border-collapse text-center whitespace-nowrap">
                <thead>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity in Stock</th>
                  <th>Inventory Value</th>
                </thead>
                <tbody>
                  <?php
                        $database->DBQuery("SELECT * FROM `inventory` ORDER BY inventory.inv_no DESC LIMIT 5");
                        if($database->rowCount() > 0):
                          foreach($database->fetchAll() AS $inventory):
                            $inventory_value = ($inventory->inv_price * $inventory->inv_stocks);
                  ?>
                        <tr class="odd:bg-gray-50 even:bg-white">
                          <td><?= $inventory->inv_product ?></td>
                          <td>&#8369; <?= $inventory->inv_price ?></td>
                          <td><?= $inventory->inv_stocks ?></td>
                          <td>&#8369; <?= $inventory_value ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                      <tr>
                          <td colspan="4" class="txt-center">No Recent Item Found</td>
                      </tr>
                <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="border border-gray-300/40 rounded-md">
            <div class="py-4 px-6">
              <p class="text-sm text-gray-600 font-medium leading-tight">Recent Purchase Item</p>
            </div>
            <div class="w-[calc(100vw-3rem)] md:w-auto bg-white rounded-md overflow-x-auto">
              <table class="w-full border-collapse text-center whitespace-nowrap">
                <thead>
                  <th>Name</th>
                  <th>Supplier</th>
                  <th>Order Quantity</th>
                  <th>Received Quantity</th>
                  <th>Unit Cost</th>
                </thead>
                <tbody>
                  <?php
                        $database->DBQuery("SELECT `inv_product`,`p_supplier`,`p_order_qty`,`p_received_qty`,`p_unit_cost` FROM `purchases` LEFT JOIN `inventory` ON purchases.inv_id=inventory.inv_id ORDER BY purchases.p_no DESC LIMIT 5");
                        if($database->rowCount() > 0):
                          foreach($database->fetchAll() AS $purchases):
                  ?>
                      <tr class="odd:bg-gray-50 even:bg-white">
                        <td><?= $purchases->inv_product ?></td>
                        <td><?= $purchases->p_supplier ?></td>
                        <td><?= $purchases->p_order_qty ?></td>
                        <td><?= $purchases->p_received_qty ?></td>
                        <td>P<?= $purchases->p_unit_cost ?></td>
                      </tr>
                  <?php endforeach ?>
                <?php else: ?>
                      <tr>
                          <td colspan="5" class="txt-center">No Recent Purchase Found</td>
                      </tr>
                <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>