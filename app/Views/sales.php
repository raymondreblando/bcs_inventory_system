<?php

$page_title = "Sales";

$active_tab = "Sales";

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
          <p class="text-[15px] font-semibold text-black">Sales</p>
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
        <div class="flex flex-col md:flex-row gap-3 mb-4">
          <div class="flex gap-3">
            <div class="relative w-full md:w-[9rem] h-12 border border-gray-300/40 rounded-md px-4 py-2">
              <input type="date" id="date_from_filter" class="w-full h-full text-xs text-gray-500 uppercase outline-none" oninput="filterTable()">
              <img src="<?php echo SYSTEM_URL ?>/public/icons/calendar-linear.svg" alt="calendar" class="absolute top-1/2 -translate-y-1/2 right-4 w-4 h-4 bg-white pointer-events-none">
            </div>
            <div class="relative w-full md:w-[9rem] h-12 border border-gray-300/40 rounded-md px-4 py-2">
              <input type="date" id="date_to_filter" class="w-full h-full text-xs text-gray-500 uppercase outline-none" oninput="filterTable()">
              <img src="<?php echo SYSTEM_URL ?>/public/icons/calendar-linear.svg" alt="calendar" class="absolute top-1/2 -translate-y-1/2 right-4 w-4 h-4 bg-white pointer-events-none">
            </div>
          </div>
        </div>
        <div class="w-[calc(100vw-3rem)] md:w-[calc(100vw-18rem)] bg-white rounded-md overflow-x-auto">
          <table id="my-table" class="w-full border-collapse text-center whitespace-nowrap">
            <thead>
              <th class="hidden" hidden>Date</th>
              <th>Receipt No.</th>
              <th>Item</th>
              <th>Order Date</th>
              <th>Unit Price</th>
              <th>Quantity Sold</th>
              <th>Sales Amount</th>
              <th>Action</th>
            </thead>
            <tbody>
                  <?php
                        $database->DBQuery("SELECT * FROM `sales` LEFT JOIN `inventory` ON sales.inv_id=inventory.inv_id ORDER BY sales.s_no DESC");
                        if($database->rowCount() > 0):
                          foreach($database->fetchAll() AS $sale):

                            $salesAmount = 0;
                            $salesAmount += ($sale->inv_price * $sale->s_qty);

                ?>
                    <tr class="odd:bg-gray-50 even:bg-white sale-record">
                      <td class="hidden datetime" hidden><?= $functions->formatDateTime($sale->s_order_date, "Y-m-d") ?></td>
                      <td><?= $sale->receipt_no ?></td>
                      <td><?= $sale->inv_product ?></td>
                      <td><?= $functions->formatDateTime($sale->s_order_date, "M d, Y") ?></td>
                      <td>&#8369; <?= number_format($sale->inv_price, 2) ?></td>
                      <td><?= $sale->s_qty ?></td>
                      <td>&#8369; <span class="sale"><?= number_format($salesAmount, 2) ?></span></td>
                      <td>
                        <?php if($sale->s_status == "Completed"){ ?>
                          <a href="<?php echo SYSTEM_URL."/return/".$sale->s_no ?>" class="bg-primary text-white font-normal py-[3px] px-2 rounded-sm">Return</a>
                        <?php } else{ ?>
                          <a href="<?php echo SYSTEM_URL."/return/".$sale->s_no ?>" class="bg-rose-500 text-white font-normal py-[3px] px-2 rounded-sm">Returned</a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
              <?php else: ?>
                    <tr>
                        <td colspan="6" class="txt-center">No Recent Sales Found</td>
                    </tr>
              <?php endif ?>
              <tr class="border-t border-t-gray-300/40 border-b border-b-gray-300/40">
                <td colspan="5" class="text-left border-r border-r-gray-300/40">Total Sales</td>
                <td class="text-right">&#8369; <span class="totalSales"></span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>