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
          <p class="text-[15px] font-semibold text-black">Create Account</p>
        </div>
        <div class="w-max md:w-[14rem] h-full flex items-center gap-3 border-0 md:border md:border-gray-300/40 rounded-md px-4 cursor-pointer">
          <i class="search-btn ri-search-line text-gray-500"></i>
          <div class="searchbar fixed md:static top-3 left-1/2 -translate-x-1/2 md:translate-x-0 w-[95%] md:w-full h-12 md:h-auto hidden md:flex items-center bg-gray-100 md:bg-transparent gap-3 px-6 md:px-0 rounded-md">
            <i class="block md:hidden ri-search-line"></i>
            <input type="text" class="w-full text-xs text-gray-500 placeholder:text-gray-500 bg-transparent outline-none" id="search-input" placeholder="Search here..." autocomplete="off">
          </div>
        </div>
      </div>
      <div class="py-6 px-6">
        <div class="max-w-[800px] border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <a href="<?php echo SYSTEM_URL."/accounts" ?>" class="w-fit flex items-center gap-2 text-gray-500 mb-6">
            <i class="ri-arrow-left-s-line text-lg"></i>
            Back
          </a>
          <p class="text-xl font-semibold uppercase">Create New Account</p>
          <p class="text-sm text-gray-500 mb-8">To create new account, kindy provide the needed information to create the account.</p>
          <form autocomplete="off">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div class="upload-container h-[300px] md:h-[245px] relative bg-gray-100 rounded-lg cursor-pointer">
                <input type="file" id="user-profile" class="upload-input" hidden>
                <img src="" alt="profile" class="upload-overview w-full h-full object-contain pointer-events-none" id="product_image" hidden>
                <div class="icon absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 pointer-events-none">
                  <img src="<?php echo SYSTEM_URL ?>/public/icons/gallery-bold.svg" alt="gallery" class="w-10 h-10 mx-auto mb-2 pointer-events-none">
                  <p class="text-sm font-medium pointer-events-none text-center">Browse your device</p>
                </div>
              </div>
              <div>
                <div>
                  <label for="firstname" class="block text-sm font-medium text-gray-800 mb-2">Firstname</label>
                  <input type="text" id="firstname" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-3" placeholder="Enter firstname">
                </div>
                <div>
                  <label for="middlename" class="block text-sm font-medium text-gray-800 mb-2">Middlename</label>
                  <input type="text" id="middlename" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-3" placeholder="Enter middlename">
                </div>
                <div>
                  <label for="lastname" class="block text-sm font-medium text-gray-800 mb-2">Lastname</label>
                  <input type="text" id="lastname" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-3" placeholder="Enter lastname">
                </div>
              </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="gender" class="block text-sm font-medium text-gray-800 mb-2">Gender</label>
                <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                  <select id="gender" class="appearance-none w-full h-full text-sm text-gray-500 outline-none">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
                </div>
              </div>
              <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-800 mb-2">Phone Number</label>
                <input type="text" id="phone_number" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter phone number">
              </div>
              <div>
                <label for="email_address" class="block text-sm font-medium text-gray-800 mb-2">Email Address</label>
                <input type="email" id="email_address" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter email address">
              </div>
              <div>
                <label for="address" class="block text-sm font-medium text-gray-800 mb-2">Address</label>
                <input type="text" id="address" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter address">
              </div> 
              <div>
                <label for="n_password" class="block text-sm font-medium text-gray-800 mb-2">Password</label>
                <input type="password" id="n_password" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter password">
              </div> 
              <div>
                <label for="c_password" class="block text-sm font-medium text-gray-800 mb-2">Confirm Password</label>
                <input type="password" id="c_password" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Confirm password">
              </div>
            </div>
            <div class="flex items-center gap3">
              <button type="button" id="createAccount" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Create Account</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>