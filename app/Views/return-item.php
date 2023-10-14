<?php

$page_title = "Return Item";

$active_tab = "Return Item";

require_once("./initialized.php");

include 'Partials/header.php';

$redirect->checkLoggedIn(SYSTEM_URL);

$database->DBQuery("SELECT * FROM `sales` LEFT JOIN `inventory` ON sales.inv_id=inventory.inv_id WHERE sales.s_no = ? ORDER BY sales.s_no DESC", [$id]);
$receipt_info = $database->fetch();

?>
<body>
  <main class="min-h-screen grid md:grid-cols-[15rem_auto]">

    <?php include 'Partials/sidebar.php';  ?>

    <main>
      <div class="h-[4.55rem] flex items-center justify-between gap-4 bg-white border-b border-b-gray-300/40 py-3 px-6">
        <div class="flex items-center gap-3">
          <button class="menu-btn block md:hidden text-xl font-semibold"><i class="ri-menu-fill"></i></button>
          <p class="text-[15px] font-semibold text-black">Return Item</p>
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
        <div class="max-w-[400px] mt-20 mx-auto">
          <form autocomplete="off">
            <div class="flex items-end justify-between gap-4 mb-4">
              <div>
                <a href="<?php echo SYSTEM_URL ?>/sales" class="inline-block mb-6">
                  <i class="ri-arrow-left-s-line"></i>
                  Back
                </a>
                <p class="text-base font-semibold uppercase">Returning Item</p>
                <p class="text-base font-semibold uppercase"><?php echo "#".$receipt_info->receipt_no ." - ". $receipt_info->inv_product ." - ". $receipt_info->s_qty ." Total Quantity" ?></p>
                <p class="text-sm text-gray-500 mb-8">Input the item quantity to be returned</p>
              </div>
            </div>
            <div class="mb-4">
              <label for="quantity" class="block text-sm font-medium text-gray-800 mb-2">Item Quantity</label>
              <input type="text" id="return_qty" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter return item quantity">
            </div>
            <button type="button" id="returnItem" data-id="<?php echo $id ?>" class="w-full h-max bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md mt-auto mb-12">Return Item</button>
          </form>
        <div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>