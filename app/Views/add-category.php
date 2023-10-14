<?php

$page_title = "Category";

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
          <p class="text-[15px] font-semibold text-black">Add Category</p>
        </div>
      </div>
      <div class="py-8 px-10">
        <div class="max-w-[800px] grid md:grid-cols-2 gap-4 border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <div>
            <a href="<?php echo SYSTEM_URL."/add-item" ?>" class="w-fit flex items-center gap-2 text-gray-500 mb-6">
              <i class="ri-arrow-left-s-line text-lg"></i>
              Back
            </a>
            <p class="text-xl font-semibold uppercase">Add New Category</p>
            <p class="text-sm text-gray-500 mb-8">To create new category, kindly fill up all of the fields below.</p>
            <form autocomplete="off">
              <label for="category_name" class="block text-sm font-medium text-gray-800 mb-2">Category Name</label>
              <input type="text" id="category_name" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-4" placeholder="Enter category name">
              <div class="flex items-center gap3">
                <button type="button" id="saveCategory" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Save Item</button>
              </div>
            </form>
          </div>
          <div>
          <p class="text-sm font-semibold uppercase mb-3">Category List</p>
          <table class="w-full border-collapse text-center whitespace-nowrap">
            <thead>
              <th>Category Name</th>
              <th>Action</th>
            </thead>
            <tbody>
            <?php
                    $database->DBQuery("SELECT * FROM `category` ORDER BY `category_name` ASC");
                    if($database->rowCount() > 0):
                      foreach($database->fetchAll() AS $category):
              ?>
              <tr class="odd:bg-gray-50 even:bg-white">
                <td><?= $category->category_name ?></td>
                  <td>
                    <a href="<?= SYSTEM_URL.'/update-category/'.$category->category_id ?>">Update</a>
                  </td>
              </tr>
              <?php endforeach ?>
              <?php else: ?>
                    <tr>
                        <td colspan="2" class="txt-center">No Record Found</td>
                    </tr>
              <?php endif ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>