<?php
       $database->DBQuery("SELECT * FROM `users` LEFT JOIN `role` ON role.role_id=users.role_id WHERE `user_id` = ?", [$_SESSION['uid']]);
       $user_info = $database->fetch();
?>

<aside class="sidebar">
       <div class="relative flex items-center gap-2 py-4 px-6 border-b border-b-gray-300/40 mb-6">
              <div class="shrink-0 w-10 h-10 grid place-items-center rounded-full bg-primary text-white font-semibold">
                     <img src="<?= SYSTEM_URL . '/public/images/icon.svg' ?>" alt="bcs logo" class="w-full h-full object-contain">
              </div>
              <p class="text-[14px] font-bold leading-tight">Balogo Construction <br> Supplies</p>
              <button class="close-sidebar hidden absolute top-1/2 -translate-y-1/2 left-[105%] w-6 h-6 bg-white rounded-full"><i class="ri-close-line"></i></button>
       </div>
       <ul>
              <?php if($user_info->role_id === "0988573838328"): ?>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/home" class="aside__link <?php echo $active_tab == 'POS' ? 'active' : '' ?>">
                            <i class="ri-home-smile-line text-xl"></i>
                            Point of Sale
                            </a>
                     </li>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/inventory" class="aside__link <?php echo $active_tab == 'Inventory' ? 'active' : '' ?>">
                            <i class="ri-box-3-line text-xl"></i>
                            Inventory
                            </a>
                     </li>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/purchases" class="aside__link <?php echo $active_tab == 'Purchases' ? 'active' : '' ?>">
                            <i class="ri-truck-line text-xl"></i>
                            Purchases
                            </a>
                     </li>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/sales" class="aside__link <?php echo $active_tab == 'Sales' ? 'active' : '' ?>">
                            <i class="ri-wallet-line text-xl"></i>
                            Sales
                            </a>
                     </li>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/reports" class="aside__link <?php echo $active_tab == 'Reports' ? 'active' : '' ?>">
                            <i class="ri-newspaper-line text-xl"></i>
                            Reports
                            </a>
                     </li>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/accounts" class="aside__link <?php echo $active_tab == 'Accounts' ? 'active' : '' ?>">
                            <i class="ri-user-3-line text-xl"></i>
                            User Accounts
                            </a>
                     </li>
              <?php else: ?>
                     <li>
                            <a href="<?php echo SYSTEM_URL ?>/home" class="aside__link <?php echo $active_tab == 'Home' ? 'active' : '' ?>">
                            <i class="ri-home-smile-line text-xl"></i>
                            Home
                            </a>
                     </li>
              <?php endif ?>
       </ul>
       <div class="mt-auto">
              <li>
              <a href="<?php echo SYSTEM_URL."/settings" ?>" class="<?php echo $active_tab == 'Settings' ? 'active' : '' ?> aside__link border-t border-t-gray-300/40">
              <i class="ri-settings-4-line text-xl"></i>
              Account Settings
              </a>
              </li>
              <div class="flex items-center border-t border-t-gray-300/40 gap-2 py-4 px-6"> 
              <img src="<?= $user_info->photo == null ? ''.SYSTEM_URL.'/public/images/'.$user_info->gender.'.svg' : SYSTEM_URL.'/uploads/profiles/'.$user_info->photo; ?>" alt="profile" class="w-10 h-10 object-cover rounded-full">
              <div>
              <p class="text-sm font-semibold text-black"><?php echo $user_info->fname." ".$user_info->lname ?></p>
              <p class="text-xs font-medium text-slate-500"><?php echo $user_info->role_name ?></p>
              </div>
              <a href="<?php echo SYSTEM_URL."/logout" ?>" class="ml-auto"><i class="ri-logout-circle-r-line"></i></a>
              </div>
       </div>
</aside>