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
          <p class="text-[15px] font-semibold text-black">Add Purchase</p>
        </div>
      </div>
      <div class="py-8 px-10">
        <div class="max-w-[800px] border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <a href="<?php echo SYSTEM_URL."/purchases" ?>" class="w-fit flex items-center gap-2 text-gray-500 mb-6">
            <i class="ri-arrow-left-s-line text-lg"></i>
            Back
          </a>
          <p class="text-xl font-semibold uppercase">Add New Purchase Record</p>
          <p class="text-sm text-gray-500 mb-8">To create new purchase record, kindly fill up all of the fields below.</p>
          <form autocomplete="off">
            <div class="grid md:grid-cols-3 gap-4 mb-4">
              <div>
                <label for="product_name" class="block text-sm font-medium text-gray-800 mb-2">Product Name</label>
                <div class="custom-select relative group flex items-center justify-between gap-4 border border-gray-300/40 px-4 rounded-sm">
                  <input type="text" class="search-product w-full h-12 text-sm text-gray-500 outline-none rounded-sm placeholder:text-gray-500" placeholder="Enter product name">
                  <i type="button" class="remove-search hidden ri-close-line cursor-pointer"></i>
                  
                  <div class="select-wrapper hidden max-h-[125px] absolute top-[110%] inset-x-0 bg-white py-2 shadow-md rounded-sm overflow-y-auto">
                    <input type="hidden" class="select-value" id="product_name">
                    <?php 
                        $database->DBQuery("SELECT `inv_id`,`inv_product` FROM `inventory` ORDER BY `inv_product` ASC");
                        foreach ($database->fetchAll() as $inventory) {
                                echo '<li class="select-option text-xs font-medium text-gray-500 hover:bg-gray-50 cursor-pointer py-1 px-2" data-value="'.$inventory->inv_id.'">'.$inventory->inv_product.'</li>';
                        }
                    ?>
                  </div>
                </div>
              </div>
              <div>
                <label for="supplier" class="block text-sm font-medium text-gray-800 mb-2">Supplier Name</label>
                <input type="text" id="supplier" class="supplier-input hidden w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter supplier name">
                <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                  <select class="supplier-select appearance-none w-full h-full text-xs text-gray-500 outline-none" onchange="suplierSelect(this)">
                    <option value="">Select Supplier</option>
                    <option value="Bords Trading Ligao">Bords Trading Ligao</option>
                    <option value="Others">Others Specify</option>
                  </select>
                  <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
                </div>
              </div>
              <div>
                <label for="order_quantity" class="block text-sm font-medium text-gray-800 mb-2">Order Quantity</label>
                <input type="text" id="order_quantity" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter order quantity">
              </div>
            </div>
            <div class="flex items-center gap3">
              <button type="button" id="saveEntry" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Save Purchase Record</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>