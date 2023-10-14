<?php

$page_title = "Settings";

$active_tab = "Settings";

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
          <p class="text-[15px] font-semibold text-black">Account Settings</p>
        </div>
      </div>
      <div class="py-6 px-6">
        <div class="max-w-[1000px] border border-gray-300/40 rounded-md mx-auto py-6 px-8">
          <p class="text-lg font-semibold uppercase">Account Settings</p>
          <p class="text-sm text-gray-500 mb-8">View your personal information and manage your account security.</p>
          <div class="grid md:grid-cols-3 gap-8">
            <form autocomplete="off" class="md:col-span-2">
              <p class="text-sm text-gray-500 mb-4">Here is your system account information.</p>
              <div class="flex items-center gap-2 mb-4">
                <div class="relative">
                  <input type="file" id="user-profile" class="dp-input" hidden>
                  <img src="<?= $user_info->photo == null ? ''.SYSTEM_URL.'/public/images/'.$user_info->gender.'.svg' : SYSTEM_URL.'/uploads/profiles/'.$user_info->photo; ?>" alt="profile" class="profile-image w-16 h-16 rounded-full object-cover">
                  <button type="button" class="profile-upload absolute -bottom-1 right-2 w-6 h-6 bg-white rounded-full"><i class="ri-upload-cloud-line pointer-events-none" title="upload"></i></button>
                </div>
                <div>
                  <p class="font-semibold"><?php echo $user_info->fname." ".$user_info->middle." ".$user_info->lname; ?></p>
                  <p class="text-xs text-gray-500"><?php echo $user_info->email; ?></p>
                  <p class="text-xs text-gray-500"><?php echo $user_info->gender; ?></p>
                </div>
              </div>
              <div class="grid md:grid-cols-3 gap-4 mb-4">
                <div>
                  <label for="firstname" class="block text-sm font-medium text-gray-800 mb-2">Firstname</label>
                  <input type="text" id="firstname" value="<?php echo $user_info->fname; ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-3" placeholder="Enter firstname">
                </div>
                <div>
                  <label for="middlename" class="block text-sm font-medium text-gray-800 mb-2">Middlename</label>
                  <input type="text" id="middlename" value="<?php echo $user_info->middle; ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-3" placeholder="Enter middlename">
                </div>
                <div>
                  <label for="lastname" class="block text-sm font-medium text-gray-800 mb-2">Lastname</label>
                  <input type="text" id="lastname" value="<?php echo $user_info->lname; ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 mb-3" placeholder="Enter lastname">
                </div>
              </div>
              <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                  <label for="gender" class="block text-sm font-medium text-gray-800 mb-2">Gender</label>
                  <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                    <select id="gender" class="appearance-none w-full h-full text-sm text-gray-500 outline-none">
                    <?php 
                      $selected = $user_info->gender;
                      $options = array("Male","Female");
                      foreach($options as $option){
                          if($selected == $option){
                                echo '<option selected="selected" value="'.$option.'">'.$option.'</option>';
                          }else{
                                echo '<option value="'.$option.'">'.$option.'</option>';
                          }
                      }
                    ?>
                    </select>
                    <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
                  </div>
                </div>
                <div>
                  <label for="phone_number" class="block text-sm font-medium text-gray-800 mb-2">Phone Number</label>
                  <input type="text" id="phone_number" value="<?php echo $user_info->contact; ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter phone number">
                </div>
                <div>
                  <label for="email_address" class="block text-sm font-medium text-gray-800 mb-2">Email Address</label>
                  <input type="email" id="email_address" value="<?php echo $user_info->email; ?>"  class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter email address">
                </div>
                <div>
                  <label for="address" class="block text-sm font-medium text-gray-800 mb-2">Address</label>
                  <input type="text" id="address" value="<?php echo $user_info->address; ?>" class="w-full h-12 text-sm text-gray-500 outline-none px-4 rounded-sm placeholder:text-gray-500 border border-gray-300/40 " placeholder="Enter address">
                </div>
              </div>
              <div class="flex items-center gap3">
                <button type="button" id="updateProfile" class="bg-primary text-white text-sm font-medium uppercase py-4 px-8 rounded-md">Save</button>
              </div>
            </form>
            <?php if($user_info->role_id == "0988573838328"){ ?>
              <form autocomplete="off">
                <p class="text-sm text-gray-500 mb-4">Manage your account security. Change the account password once the account was created.</p>
                <label for="current_password" class="block text-sm font-medium text-gray-800 mb-2">Current Account Password</label>
                <div class="relative w-full h-12 px-4 rounded-sm border border-gray-300/40 mb-4">
                  <input type="password" id="current_password" class="w-full h-full text-sm text-gray-500 outline-none placeholder:text-gray-500 bg-transparent" placeholder="Provide current account password">
                  <button type="button" class="toggle-password absolute w-6 h-6 top-1/2 -translate-y-1/2 right-4 text-sky-950"><i class="ri-eye-fill pointer-events-none"></i></button>
                </div>
                <label for="new_password" class="block text-sm font-medium text-gray-800 mb-2">New Password</label>
                <div class="relative w-full h-12 px-4 rounded-sm border border-gray-300/40 mb-4">
                  <input type="password" id="new_password" class="w-full h-full text-sm text-gray-500 outline-none placeholder:text-gray-500 bg-transparent" placeholder="Provide new account password">
                  <button type="button" class="toggle-password absolute w-6 h-6 top-1/2 -translate-y-1/2 right-4 text-sky-950"><i class="ri-eye-fill pointer-events-none"></i></button>
                </div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-800 mb-2">Confirm Password</label>
                <div class="relative w-full h-12 px-4 rounded-sm border border-gray-300/40 mb-4">
                  <input type="password" id="confirm_password" class="w-full h-full text-sm text-gray-500 outline-none placeholder:text-gray-500 bg-transparent" placeholder="Confirm password">
                  <button type="button" class="toggle-password absolute w-6 h-6 top-1/2 -translate-y-1/2 right-4 text-sky-950"><i class="ri-eye-fill pointer-events-none"></i></button>
                </div>
                <div class="flex items-center gap3">
                  <button type="button" id="changePassword" class="bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md">Change Account Password</button>
                </div>
              </form>
            <?php } ?>
          </div>
        </div>
      </div>
    </main>
  </main>

<?php include 'Partials/footer.php';  ?>