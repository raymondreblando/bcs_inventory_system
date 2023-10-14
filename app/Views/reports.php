<?php

$page_title = "Reports";

$active_tab = "Reports";

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
          <p class="text-[15px] font-semibold text-black">Reports</p>
        </div>
      </div>
      <div class="py-6 px-6">
        <div class="max-w-[400px] mt-20 mx-auto">
          <form autocomplete="off">
            <div class="flex items-end justify-between gap-4 mb-4">
              <div>
                <p class="text-base font-semibold uppercase">Generate Reports</p>
                <p class="text-sm text-gray-500 mb-8">To generate the report, kindy fill up all of the needed information</p>
              </div>
            </div>
            <div class="mb-4">
              <label for="report_type" class="block text-sm font-medium text-gray-800 mb-2">Report Type</label>
              <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                <select id="report_type" class="appearance-none w-full h-full text-xs text-gray-500 outline-none">
                  <option value="">Select Product</option>
                  <option value="Inventory Report">Inventory Report</option>
                  <option value="Purchase Report">Purchase Report</option>
                  <option value="Sales Report">Sales Report</option>
                </select>
                <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4"></i>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
              <div>
                <label for="start_date" class="block text-sm font-medium text-gray-800 mb-2">Start Date</label>
                <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                  <input type="date" id="start_date" class="w-full h-full text-xs text-gray-500 uppercase outline-none">
                  <img src="<?php echo SYSTEM_URL ?>/public/icons/calendar-linear.svg" alt="calendar" class="absolute top-1/2 -translate-y-1/2 right-4 w-4 h-4 bg-white pointer-events-none">
                </div>
              </div>
              <div>
                <label for="end_date" class="block text-sm font-medium text-gray-800 mb-2">End Date</label>
                <div class="relative w-full h-12 border border-gray-300/40 rounded-md px-4 py-2">
                  <input type="date" id="end_date" class="w-full h-full text-xs text-gray-500 uppercase outline-none">
                  <img src="<?php echo SYSTEM_URL ?>/public/icons/calendar-linear.svg" alt="calendar" class="absolute top-1/2 -translate-y-1/2 right-4 w-4 h-4 bg-white pointer-events-none">
                </div>
              </div>
            </div>
            <button type="button" id="generateReports" class="w-full h-max bg-primary text-white text-xs font-medium uppercase py-4 px-8 rounded-md mt-auto mb-12">Generate Report</button>
          </form>
        <div>
      </div>     
    </main> 
  </main>

<?php include 'Partials/footer.php';  ?>