<?php

$page_title = "Update Category";

$active_tab = "Inventory";

require_once("./initialized.php");

include 'Partials/header.php';

$redirect->checkLoggedIn(SYSTEM_URL);

$database->DBQuery("SELECT * FROM `category` WHERE `category_id` = ?", [$id]);
$category = $database->fetch();
?>
<body>
  <main class="min-h-screen grid md:grid-cols-[15rem_auto]">

    <?php include 'Partials/sidebar.php';  ?>

    <main>
      <div class="h-[4.55rem] flex items-center justify-between gap-4 bg-white border-b border-b-gray-300/40 py-3 px-6">
        <div class="flex items-center gap-3">
          <button class="menu-btn block md:hidden text-xl font-semibold"><i class="ri-menu-fill"></i></button>
          <p class="text-[15px] font-semibold text-black">Update Category</p>
        </div>
      </div>
      <div class="py-8 px-10">
        <div class="max-w-[500px] border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <a href="<?php echo SYSTEM_URL."/add-category" ?>" class="w-fit flex items-center gap-2 text-gray-500 mb-6">
            <i class="ri-arrow-left-s-line text-lg"></i>
            Back
          </a>
          <p class="text-xl font-semibold uppercase">Update Category</p>
          <p class="text-sm text-gray-500 mb-8">To update category, kindly fill up all of the fields below.</p>
          <form autocomplete="off">
            <label for="category_name" class="block text-sm font-medium text-gray-800 mb-2">Category Name</label>
            <input type="text" id="category_name" value="<?php echo $category->category_name ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-4" placeholder="Enter category name">
            <div class="flex items-center gap3">
              <button type="button" data-id="<?php echo $id ?>" id="updateCategory" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Update Item</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>