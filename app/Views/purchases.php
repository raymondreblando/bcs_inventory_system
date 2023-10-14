<?php

$page_title = "Purchases";

$active_tab = "Purchases";

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
          <p class="text-[15px] font-semibold text-black">Purchases</p>
        </div>
        <div class="w-max md:w-[14rem] h-full flex items-center gap-3 border-0 md:border md:border-gray-300/40 rounded-md px-4 cursor-pointer">
          <i class="search-btn ri-search-line text-gray-500"></i>
          <div class="searchbar fixed md:static top-3 left-1/2 -translate-x-1/2 md:translate-x-0 w-[95%] md:w-full h-12 md:h-auto hidden md:flex items-center bg-gray-100 md:bg-transparent gap-3 px-6 md:px-0 rounded-md">
            <i class="block md:hidden ri-search-line"></i>
            <input type="text" id="searchTable" class="w-full text-xs text-gray-500 placeholder:text-gray-500 bg-transparent outline-none" id="search-input" placeholder="Search here..." autocomplete="off">
          </div>
        </div>
      </div>
      <div class="py-6 px-6">
        <div class="flex flex-col sm:flex-row justify-between gap-3 mb-4">
          <div class="flex gap-3">
            <div class="relative w-[9rem] h-12 border border-gray-300/40 rounded-md px-4 py-2">
              <input type="date" id="filterDate" class="w-full h-full text-xs text-gray-500 uppercase outline-none">
              <img src="<?php echo SYSTEM_URL ?>/public/icons/calendar-linear.svg" alt="calendar" class="absolute top-1/2 -translate-y-1/2 right-4 w-4 h-4 bg-white pointer-events-none">
            </div>
            <div class="relative w-[9rem] h-12 border border-gray-300/40 rounded-md px-4 py-2">
              <select id="filterPrchasesDropdownStatus" class="appearance-none w-full h-full text-xs text-gray-500 outline-none">
                <option value="all">All Status</option>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
              </select>
              <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
            </div>
          </div>
          <a href="<?php echo SYSTEM_URL."/add-entry" ?>" class="h-12 text-xs font-medium text-white bg-primary flex justify-center items-center gap-2 px-6 rounded-md uppercase">
            <i class="ri-add-line text-base"></i>
            Add Entry
          </a>
        </div>
        <div class="w-[calc(100vw-3rem)] md:w-[calc(100vw-18rem)] bg-white rounded-md overflow-x-auto">
          <table id="my-table" class="w-full border-collapse text-center whitespace-nowrap">
            <thead>
              <th class="hidden" hidden>Date</th>
              <th class="hidden" hidden>Status</th>
              <th>Name</th>
              <th>Unit</th>
              <th>Supplier</th>
              <th>Status</th>
              <th>Order Quantity</th>
              <th>Received Quantity</th>
              <th>Unit Cost</th>
              <th>Total Cost</th>
              <th>PO Date</th>
              <th></th>
            </thead>
            <tbody>
                <?php
                      $database->DBQuery("SELECT * FROM `purchases` LEFT JOIN `inventory` ON purchases.inv_id=inventory.inv_id ORDER BY purchases.p_no DESC");
                      if($database->rowCount() > 0):
                        foreach($database->fetchAll() AS $purchases):
                          $p_total_cost = 0;
                          $p_total_cost = ($purchases->inv_price * $purchases->p_order_qty);
                ?>
                    <tr class="odd:bg-gray-50 even:bg-white">
                      <td class="hidden" hidden><?= $functions->formatDateTime($purchases->p_date_added, "Y-m-d") ?></td>
                      <td class="hidden" hidden><?= $purchases->p_status ?></td>
                      <td><?= $purchases->inv_product ?></td>
                      <td><?= $purchases->inv_unit ?></td>
                      <td><?= $purchases->p_supplier ?></td>
                      <td>
                        <span class="status status-<?= strtolower($purchases->p_status) ?>"><?= $purchases->p_status ?></span>
                      </td>
                      <td><?= $purchases->p_order_qty ?></td>
                      <td><?= $purchases->p_received_qty ?></td>
                      <td>&#8369; <?= number_format($purchases->inv_price, 2) ?></td>
                      <td>&#8369; <?= number_format($p_total_cost, 2) ?></td>
                      <td><?= $functions->formatDateTime($purchases->p_date_added, "M d, Y") ?></td>
                      <td>
                        <a href="<?= SYSTEM_URL."/update-entry/".$purchases->p_id ?>"><i class="ri-refresh-line"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
              <?php else: ?>
                    <tr>
                        <td colspan="9" class="txt-center">No Recent Purchase Found</td>
                    </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>