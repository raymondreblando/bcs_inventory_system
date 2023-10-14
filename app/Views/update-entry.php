<?php

$page_title = "Purchases";

$active_tab = "Purchases";

require_once("./initialized.php");

include 'Partials/header.php';

$redirect->checkLoggedIn(SYSTEM_URL);

$database->DBQuery("SELECT * FROM `purchases` WHERE `p_id` = ?", [$id]);
$purchase_details = $database->fetch();

?>
<body>
  <main class="min-h-screen grid md:grid-cols-[15rem_auto]">
  
  <?php include 'Partials/sidebar.php';  ?>

    <main>
      <div class="h-[4.55rem] flex items-center justify-between gap-4 bg-white border-b border-b-gray-300/40 py-3 px-6">
        <div class="flex items-center gap-3">
          <button class="menu-btn block md:hidden text-xl font-semibold"><i class="ri-menu-fill"></i></button>
          <p class="text-[15px] font-semibold text-black">Update Purchase</p>
        </div>
      </div>
      <div class="py-8 px-10">
        <div class="max-w-[800px] border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <a href="<?php echo SYSTEM_URL."/purchases" ?>" class="w-fit flex items-center gap-2 text-gray-500 mb-6">
            <i class="ri-arrow-left-s-line text-lg"></i>
            Back
          </a>
          <p class="text-xl font-semibold uppercase">Update Purchase Record</p>
          <p class="text-sm text-gray-500 mb-8">To update the purchase record, you can edit the fields below.</p>
          <form autocomplete="off">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="product_name" class="block text-sm font-medium text-gray-800 mb-2">Product Name</label>
                <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                  <select id="product_name" class="appearance-none w-full h-full text-sm text-gray-500 outline-none" disabled>
                  <?php 
                      $selected = $purchase_details->inv_id;

                      $database->DBQuery("SELECT `inv_id`,`inv_product` FROM `inventory` ORDER BY `inv_product` ASC");
                      foreach ($database->fetchAll() as $product) {
                        $options[$product->inv_id] = $product->inv_product;
                      };

                      foreach($options as $key => $value){
                        if($selected == $key){
                              echo '<option selected="selected" value="'.$key.'">'.$value.'</option>';
                        }else{
                              echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                      }
                  ?>
                  </select>
                  <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
                </div>
              </div>
              <div>
                <label for="supplier" class="block text-sm font-medium text-gray-800 mb-2">Supplier Name</label>
                <input type="text" id="supplier" value="<?php echo $purchase_details->p_supplier ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter supplier">
              </div>
            </div>
            <div class="grid md:grid-cols-3 gap-4 mb-4">
              <div>
                <label for="order_quantity" class="block text-sm font-medium text-gray-800 mb-2">Order Quantity</label>
                <input type="text" id="order_quantity" value="<?php echo $purchase_details->p_order_qty ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter order quantity">
              </div>
              <div>
                <label for="receive_quantity" class="block text-sm font-medium text-gray-800 mb-2">Received Quantity</label>
                <input type="text" id="receive_quantity" value="<?php echo $purchase_details->p_received_qty ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter receive quantity">
              </div>
              <div>
                <label for="status" class="block text-sm font-medium text-gray-800 mb-2">Status</label>
                <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                  <select id="status" class="appearance-none w-full h-full text-sm text-gray-500 outline-none">
                    <option value="">Select Status</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                  </select>
                  <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
                </div>
              </div>
            </div>
            <div class="flex items-center gap3">
              <button type="button" id="updateEntry" data-id="<?php echo $id; ?>" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Update Purchase Record</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>