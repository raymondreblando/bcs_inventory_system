<?php

$page_title = "Inventory";

$active_tab = "Inventory";

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
          <p class="text-[15px] font-semibold text-black">Inventory</p>
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
        <div class="flex justify-between mb-4">
          <div class="flex gap-4">
            <div class="relative w-[13rem] h-12 border border-gray-300/40 rounded-md px-4 py-2">
              <select id="filterInventoryDropdown" class="appearance-none w-full h-full text-xs text-gray-500 outline-none">
                <option value="all">All Products</option>
                <?php 
                    $database->DBQuery("SELECT * FROM `category`");
                    foreach ($database->fetchAll() as $category) {
                      echo '<option value="'.$category->category_name.'">'.$category->category_name.'</option>';
                    };
                ?>
              </select>
              <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
            </div>
          </div>
          <a href="<?php echo SYSTEM_URL ?>/add-item" class="h-12 text-xs font-medium text-white bg-primary flex justify-center items-center gap-2 px-6 rounded-md uppercase">
            <i class="ri-add-line text-base"></i>
            <p class="hidden md:block">Add Item</p>
          </a>
        </div>
        <div class="w-[calc(100vw-3rem)] md:w-[calc(100vw-18rem)] bg-white rounded-md overflow-x-auto">
          <table id="my-table" class="w-full border-collapse text-center whitespace-nowrap">
            <thead>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Unit</th>
              <th>Quantity in Stock</th>
              <th>Reorder Level</th>
              <th>Quantity in Reorder</th>
              <th></th>
            </thead>
            <tbody>
              <?php
                    $database->DBQuery("SELECT * FROM `inventory` LEFT JOIN `category` ON inventory.category_id=category.category_id ORDER BY inventory.inv_no DESC");
                    if($database->rowCount() > 0):
                      foreach($database->fetchAll() AS $inventory):
                        $inventory_value = ($inventory->inv_price * $inventory->inv_stocks);
              ?>
                        <tr class="odd:bg-gray-50 even:bg-white">
                          <td><?= $inventory->inv_product ?></td>
                          <td><?= $inventory->category_name ?></td>
                          <td>&#8369; <?= number_format($inventory->inv_price, 2) ?></td>
                          <td><?= $inventory->inv_unit ?></td>
                          <td class="inv-stocks"><?= $inventory->inv_stocks ?></td>
                          <td class="inv-reorder-level"><?= $inventory->inv_reorder_level ?></td>
                          <td><?= $inventory->inv_qty_reorder ?></td>
                          <td>
                            <a href="<?= SYSTEM_URL."/update-item/".$inventory->inv_id ?>"><i class="ri-refresh-line"></i></a>
                          </td>
                        </tr>
                    <?php endforeach ?>
              <?php else: ?>
                    <tr>
                        <td colspan="9" class="txt-center">No Record Found</td>
                    </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>