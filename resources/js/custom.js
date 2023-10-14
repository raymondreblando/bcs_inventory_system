$(document).ready(function () {
       calculateTotal();

       // Search for table
       $('#searchTable').keyup(function () { 
              var $tableRow = $('#my-table tbody tr');
              var val = $.trim($(this).val()).replace(/ +/g,'').toLowerCase();
              $tableRow.show().filter(function(){
              var text = $(this).text().replace(/\s+/g,'').toLowerCase();
              return !~text.indexOf(val);
              }).hide();
       });

       // Search 
       $('#searchDiv').keyup(function () { 
              var matcher = new RegExp($(this).val(), 'i');
              $('.searchArea').show().not(function(){
              return matcher.test($(this).find('.finder1, .finder2, .finder3, .finder4, .finder5').text());
              }).hide();
       });
        $('#searchDiv').keyup(function () { 
              var matcher = new RegExp($(this).val(), 'i');
              $('.searchArea').show().not(function(){
              return matcher.test($(this).find('.finder1, .finder2, .finder3, .finder4, .finder5').text());
              }).hide();
       });
       // Filter Table
       $('#filterInventoryDropdown').change(function () {
              var filterValue = $(this).val();
              filterTableByColumn('#my-table', 2, filterValue);
       });
       $('#filterPrchasesDropdownStatus').change(function () {
              var filterValue = $(this).val();
              filterTableByColumn('#my-table', 2, filterValue);
       });
       $('#filterDate').change(function () {
              var filterValue = $(this).val();
              filterTableByColumn('#my-table', 1, filterValue);
       });

       // Sort users by gender
       var originalUsers = $('#user-container .searchArea').get();
       
       function sortUsersByGender(gender) {
              $('#user-container').empty();
          
              $.each(originalUsers, function(index, user) {
                  var userGender = $(user).find('.gender').text().trim();
                  if (userGender.toLowerCase() === gender.toLowerCase()) {
                      $('#user-container').append(user);
                  }
              });
       }

       function showAllUsers() {
              $('#user-container').empty();
              $.each(originalUsers, function(index, user) {
                  $('#user-container').append(user);
              });
       }

       $('#all-users').on('click', function() {
              showAllUsers();
       });
          
       $('#sort-male').on('click', function() {
              sortUsersByGender('Male');
       });
  
       $('#sort-female').on('click', function() {
              sortUsersByGender('Female');
       });
});
function filterTableByColumn(tableSelector, columnIdx, filterValue) {
       $(tableSelector + ' tbody tr').hide();
     
       $(tableSelector + ' tbody tr td:nth-child(' + columnIdx + ')').each(function () {
              var cellValue = $(this).text();
              if ((filterValue === 'all') || (filterValue === cellValue)) {
                     $(this).closest('tr').show();
              }
       });
}
function filterTable() {
       var fromDate = new Date($("#date_from_filter").val());
       var toDate = new Date($("#date_to_filter").val());
     
       $("#my-table tbody .sale-record").each(function() {
           var rowDate = new Date($(this).find(".datetime").text());
     
           rowDate.setHours(0, 0, 0, 0);
           fromDate.setHours(0, 0, 0, 0);
           toDate.setHours(0, 0, 0, 0);
     
           if (rowDate >= fromDate && rowDate <= toDate) {
               $(this).show();
           } else {
               $(this).hide();
           }
       });

       calculateTotal();
}
function calculateTotal() {
       var total = 0;
       $('#my-table tbody tr:visible').each(function() {
           var sales = parseFloat($(this).find('.sale').text().replace(/,/g, ''));
           total += isNaN(sales) ? 0 : sales;
       });
       $('.totalSales').text(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}