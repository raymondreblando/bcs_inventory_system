<?php

$page_title = "User Accounts";

$active_tab = "Accounts";

require_once("./initialized.php");

include 'Partials/header.php';

$redirect->checkLoggedIn(SYSTEM_URL);
$redirect->redirectNotAdmin(SYSTEM_URL);

?>
<body>
  <main class="min-h-screen grid md:grid-cols-[15rem_auto]">

    <?php include 'Partials/sidebar.php';  ?>

    <main>
      <div class="h-[4.55rem] flex items-center justify-between gap-4 bg-white border-b border-b-gray-300/40 py-3 px-6">
        <div class="flex items-center gap-3">
          <button class="menu-btn block md:hidden text-xl font-semibold"><i class="ri-menu-fill"></i></button>
          <p class="text-[15px] font-semibold text-black">User Accounts</p>
        </div>
        <div class="w-max md:w-[14rem] h-full flex items-center gap-3 border-0 md:border md:border-gray-300/40 rounded-md px-4 cursor-pointer">
          <i class="search-btn ri-search-line text-gray-500"></i>
          <div class="searchbar fixed md:static top-3 left-1/2 -translate-x-1/2 md:translate-x-0 w-[95%] md:w-full h-12 md:h-auto hidden md:flex items-center bg-gray-100 md:bg-transparent gap-3 px-6 md:px-0 rounded-md">
            <i class="block md:hidden ri-search-line"></i>
            <input type="text" id="searchDiv" class="w-full text-xs text-gray-500 placeholder:text-gray-500 bg-transparent outline-none" id="search-input" placeholder="Search here..." autocomplete="off">
          </div>
        </div>
      </div>
      <div class="py-6 px-6">
        <div class="flex justify-between mb-4">
          <a href="<?php echo SYSTEM_URL."/create-account" ?>" class="h-12 text-xs font-medium text-white bg-primary flex justify-center items-center gap-2 px-6 rounded-md uppercase">
            <i class="ri-add-line text-base"></i>
            <p class="hidden md:block">Create New</p>
          </a>
        </div>
        <div id="user-container" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            <?php
              $database->DBQuery("SELECT * FROM `users` LEFT JOIN `role` ON role.role_id=users.role_id");
              foreach($database->fetchAll() as $user):
            ?>
                <div class="searchArea">
                  <div class="users border border-gray-300/40 rounded-md">
                      <div class="flex gap-4 border-b border-b-gray-300/40">
                        <div class="grid place-items-center py-3 px-4 border-r border-r-gray-300/40">
                          <img src="<?= $user->photo == null ? ''.SYSTEM_URL.'/public/images/'.$user->gender.'.svg' : SYSTEM_URL.'/uploads/profiles/'.$user->photo; ?>" alt="profile" class="w-9 h-9 object-cover rounded-full">
                        </div>
                        <div class="flex flex-col justify-center">
                          <p class="text-sm font-semibold text-black finder1"><?= $user->fname." ".substr($user->middle, 0, 1).". ".$user->lname ?></p>
                          <p class="text-xs font-medium text-gray-500 finder2 gender"><?= $user->role_name." ( ".$user->gender." )" ?></p>
                        </div>
                      </div>
                      <div class="py-5 px-6">
                        <div class="flex items-center gap-4 mb-3">
                          <img src="<?= SYSTEM_URL ?>/public/icons/location-bold.svg" alt="location" class="w-4 h-4">
                          <p class="text-xs font-medium text-gray-500 finder3"><?= $user->address ?></p>
                        </div>
                        <div class="flex items-center gap-4 mb-3">
                          <img src="<?= SYSTEM_URL ?>/public/icons/message-search-bold.svg" alt="email" class="w-4 h-4">
                          <p class="text-xs font-medium text-gray-500 finder4"><?= $user->email ?></p>
                        </div>
                        <div class="flex items-center gap-4 mb-4">
                          <img src="<?= SYSTEM_URL ?>/public/icons/call-bold.svg" alt="phone" class="w-4 h-4">
                          <p class="text-xs font-medium text-gray-500 finder5"><?= $user->contact ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                          <?php if($user->role_id != "0988573838328"){ ?>
                            <a href="<?= SYSTEM_URL."/update-account/".$user->user_id ?>" class="text-xs uppercase text-emerald-500 font-medium py-1 px-2 bg-emerald-100 rounded-md">Update</a>
                          <?php } ?>
                          
                          <?php if($user->built === "no"): ?>
                              <button data-id="<?= $user->user_id ?>" class="removeAccount delete-account-btn text-xs uppercase text-rose-500 font-medium py-1 px-2 bg-rose-100 rounded-md">Delete</button>
                          <?php endif ?>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php endforeach ?>
            </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>