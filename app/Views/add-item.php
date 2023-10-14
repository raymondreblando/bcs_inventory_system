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
          <p class="text-[15px] font-semibold text-black">Add Item</p>
        </div>
      </div>
      <div class="py-8 px-10">
        <div class="max-w-[800px] border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <a href="<?php echo SYSTEM_URL."/inventory" ?>" class="w-fit flex items-center gap-2 text-gray-500 mb-6">
            <i class="ri-arrow-left-s-line text-lg"></i>
            Back
          </a>
          <p class="text-xl font-semibold uppercase">New Inventory Item</p>
          <p class="text-sm text-gray-500 mb-8">To create new inventory item, kindly fill up all of the fields below.</p>
          <form autocomplete="off">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="product_name" class="block text-sm font-medium text-gray-800 mb-2">Product Name</label>
                <input type="text" id="product_name" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter product name">
              </div>
              <div>
                <label for="category" class="block text-sm font-medium text-gray-800 mb-2">Category</label>
                <div class="flex items-center gap-2">
                  <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                    <select id="category" class="appearance-none w-full h-full text-sm text-gray-500 outline-none">
                      <option value="">Select Category</option>
                      <?php 
                          $database->DBQuery("SELECT * FROM `category` ORDER BY `category_name` ASC");
                          foreach ($database->fetchAll() as $category) {
                            echo '<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
                          };
                      ?>
                    </select>
                    <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
                  </div>
                  <a href="<?php echo SYSTEM_URL ?>/add-category" class="grid place-items-center w-12 h-12 bg-gray-100 text-black font-medium rounded-md"><i class="ri-add-line"></i></a>
                </div>
              </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="price" class="block text-sm font-medium text-gray-800 mb-2">Price</label>
                <input type="text" id="price" class="money w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter product price">
              </div>
              <div>
                <label for="unit" class="block text-sm font-medium text-gray-800 mb-2">Unit</label>
                <input type="text" id="unit" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter product unit">
              </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="stock" class="block text-sm font-medium text-gray-800 mb-2">Quantity in Stock</label>
                <input type="text" id="stock" class="num_only w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter product stock">
              </div>
              <div>
                <label for="reorder_level" class="block text-sm font-medium text-gray-800 mb-2">Reorder Level</label>
                <input type="text" id="reorder_level" class="num_only w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter reorder level">
              </div>
            </div>
            <div class="flex items-center gap3">
              <button type="button" id="saveItems" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Save Item</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>