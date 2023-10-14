<?php

$page_title = "Login";

require_once("./initialized.php");

include 'Partials/header.php';

?>
<body>
  <main class="min-h-screen grid place-items-center py-8">
    <div class="w-[min(30rem,90%)] p-10 rounded-lg">
      <div class="grid place-items-center w-16 h-16 bg-primary rounded-full text-3xl text-white font-semibold mx-auto mb-3">
        <img src="<?= SYSTEM_URL . '/public/images/icon.svg' ?>" alt="bcs logo" class="w-full h-full object-contain">
      </div>
      <p class="text-xl font-bold text-center">Balogo Construction Supplies</p>
      <p class="font-medium text-center mb-12">Inventory Management System</p>
      
      <form autocomplete="off">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
        <input type="email" id="email" class="w-full h-12 text-sm text-gray-700 bg-gray-100 outline-none px-4 rounded-sm placeholder:text-gray-700 mb-3" placeholder="Provide your email address">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
        <div class="relative w-full h-12 bg-gray-100 px-4 rounded-sm mb-4">
          <input type="password" id="password" class="w-full h-full text-sm text-gray-700 outline-none placeholder:text-gray-700 mb-3 bg-transparent" placeholder="Provide account password">
          <button type="button" class="toggle-password absolute w-6 h-6 top-1/2 -translate-y-1/2 right-4 text-gray-700"><i class="ri-eye-fill pointer-events-none"></i></button>
        </div>
        <button type="button" id="login" class="w-full h-12 bg-primary rounded-sm text-sm font-semibold text-white uppercase">Log in</button>
      </form>
    </div>
    <img src="<?php echo SYSTEM_URL ?>/public/images/Illustration One.svg" class="hidden lg:block absolute bottom-4 left-4 w-[300px]" alt="worker">
    <img src="<?php echo SYSTEM_URL ?>/public/images/Illustration Two.svg" class="hidden lg:block absolute bottom-4 right-4 w-[300px]" alt="worker">
  </main>

<?php include 'Partials/footer.php'; ?>

<script>
    $('#login').click(function(){login();});
    $(document).on('keypress',function(e){if(e.which == 13){login();}});
</script>