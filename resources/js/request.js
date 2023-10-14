function notification(response){
    if(response.identifier === "toast"){
       $.toast({
              text: response.info,
              icon: response.icon,
              showHideTransition: "fade", 
              allowToastClose: true,
              hideAfter: response.duration,
              stack: 1,
              position: "top-center",
              textAlign: "left",
              loader: true,
              afterHidden: function () {
                     if(response.event === "yes"){
                            location.reload();
                     }
              }
       });
    }else{
        $("#notification").html(response.value);
    }
}
function transferData(url, data){
       $.ajax({
              type: "POST",
              url: url,
              data: data,
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                     notification(response);
              },
              error: function (response) {
                     console.log(response);
              }
       });
}
function login(){
       var form_data = new FormData();
       var email = $("#email").val();
       var password = $("#password").val();

       form_data.append("email", email);
       form_data.append("password", password);

       url = "app/Handlers/process_login.php";
       transferData(url, form_data);
}
$(document).on('click', '#saveItems', function() {
       var form_data = new FormData();
       var product_name = $("#product_name").val();
       var category = $("#category").val();
       var price = $("#price").val();
       var stock = $("#stock").val();
       var unit = $("#unit").val();
       var reorder_level = $("#reorder_level").val();

       form_data.append("product_name", product_name);
       form_data.append("category", category);
       form_data.append("price", price);
       form_data.append("unit", unit);
       form_data.append("stock", stock);
       form_data.append("reorder_level", reorder_level);

       url = "app/Handlers/process_items_save.php";
       transferData(url, form_data);
});  
$(document).on('click', '#updateItem', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       var product_name = $("#product_name").val();
       var category = $("#category").val();
       var price = $("#price").val();
       var unit = $("#unit").val();
       var stock = $("#stock").val();
       var reorder_level = $("#reorder_level").val();

       form_data.append("id", id);
       form_data.append("product_name", product_name);
       form_data.append("category", category);
       form_data.append("price", price);
       form_data.append("unit", unit);
       form_data.append("stock", stock);
       form_data.append("reorder_level", reorder_level);

       url = "./../app/Handlers/process_items_update.php";
       transferData(url, form_data);
});  
$(document).on('click', '#saveEntry', function() {
       var form_data = new FormData();
       var product_name = $("#product_name").val();
       var supplier = $("#supplier").val();
       var order_quantity = $("#order_quantity").val();

       form_data.append("product_name", product_name);
       form_data.append("supplier", supplier);
       form_data.append("order_quantity", order_quantity);

       url = "app/Handlers/process_purchase_save.php";
       transferData(url, form_data);
});  
$(document).on('click', '#updateEntry', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       var product_name = $("#product_name").val();
       var supplier = $("#supplier").val();
       var order_quantity = $("#order_quantity").val();
       var receive_quantity = $("#receive_quantity").val();
       var status = $("#status").val();

       form_data.append("id", id);
       form_data.append("product_name", product_name);
       form_data.append("supplier", supplier);
       form_data.append("order_quantity", order_quantity);
       form_data.append("receive_quantity", receive_quantity);
       form_data.append("status", status);

       url = "./../app/Handlers/process_purchase_update.php";
       transferData(url, form_data);
});  
function suplierSelect(elem){
       var selected_supplier = $(elem).val();

       if(selected_supplier == "Others"){
              $('#supplier').val("");
       }else{
              $('#supplier').val(selected_supplier);
       }
}
$(document).on('click', '#createAccount', function() {
       var form_data = new FormData();
       var firstname = $("#firstname").val();
       var middlename = $("#middlename").val();
       var lastname = $("#lastname").val();
       var gender = $("#gender").val();
       var phone_number = $("#phone_number").val();
       var email_address = $("#email_address").val();
       var address = $("#address").val();
       var n_password = $("#n_password").val();
       var c_password = $("#c_password").val();
       var user_profile = $('#user-profile').prop('files')[0];

       form_data.append("firstname", firstname);
       form_data.append("middlename", middlename);
       form_data.append("lastname", lastname);
       form_data.append("gender", gender);
       form_data.append("phone_number", phone_number);
       form_data.append("email_address", email_address);
       form_data.append("address", address);
       form_data.append("n_password", n_password);
       form_data.append("c_password", c_password);
       form_data.append("user_profile", user_profile);

       url = "app/Handlers/process_user_create.php";
       transferData(url, form_data);
});  
$(document).on('click', '#updateAccount', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       var firstname = $("#firstname").val();
       var middlename = $("#middlename").val();
       var lastname = $("#lastname").val();
       var gender = $("#gender").val();
       var phone_number = $("#phone_number").val();
       var email_address = $("#email_address").val();
       var address = $("#address").val();
       var pass = $("#pass").val();
       var user_profile = $('#user-profile').prop('files')[0];

       form_data.append("id", id);
       form_data.append("firstname", firstname);
       form_data.append("middlename", middlename);
       form_data.append("lastname", lastname);
       form_data.append("gender", gender);
       form_data.append("phone_number", phone_number);
       form_data.append("email_address", email_address);
       form_data.append("address", address);
       form_data.append("pass", pass);
       form_data.append("user_profile", user_profile);

       url = "./../app/Handlers/process_user_update.php";
       transferData(url, form_data);
});  
$(document).on('click', '.removeAccount', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       form_data.append("id", id);
       url = "app/Handlers/process_user_removed.php";
       transferData(url, form_data);
}); 
$(document).on('click', '.removeItemsReceipt', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       form_data.append("id", id);
       url = "app/Handlers/process_reciept_items_removed.php";
       transferData(url, form_data);
});  
$(document).on('click', '#returnItem', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       var return_qty = $('#return_qty').val();

       form_data.append("id", id);
       form_data.append("return_qty", return_qty);
       url = "./../app/Handlers/process_return_items.php";
       transferData(url, form_data);
});  
$(document).on('click', '#changePassword', function() {
       var form_data = new FormData();
       var current_password = $("#current_password").val();
       var new_password = $("#new_password").val();
       var confirm_password = $("#confirm_password").val();

       form_data.append("current_password", current_password);
       form_data.append("new_password", new_password);
       form_data.append("confirm_password", confirm_password);

       url = "app/Handlers/process_user_password.php";
       transferData(url, form_data);
});
$(document).on('click', '#updateProfile', function() {
       var form_data = new FormData();
       var firstname = $("#firstname").val();
       var middlename = $("#middlename").val();
       var lastname = $("#lastname").val();
       var gender = $("#gender").val();
       var phone_number = $("#phone_number").val();
       var email_address = $("#email_address").val();
       var address = $("#address").val();
       var user_profile = $('#user-profile').prop('files')[0];

       form_data.append("firstname", firstname);
       form_data.append("middlename", middlename);
       form_data.append("lastname", lastname);
       form_data.append("gender", gender);
       form_data.append("phone_number", phone_number);
       form_data.append("email_address", email_address);
       form_data.append("address", address);
       form_data.append("user_profile", user_profile);

       url = "app/Handlers/process_user_profile.php";
       transferData(url, form_data);
});  
$(document).on('click', '#saveCategory', function() {
       var form_data = new FormData();
       var category_name = $("#category_name").val();

       form_data.append("category_name", category_name);

       url = "app/Handlers/process_category_save.php";
       transferData(url, form_data);
});  
$(document).on('click', '#updateCategory', function() {
       var form_data = new FormData();
       var id = $(this).data('id');
       var category_name = $("#category_name").val();

       form_data.append("id", id);
       form_data.append("category_name", category_name);

       url = "./../app/Handlers/process_category_update.php";
       transferData(url, form_data);
});  
$(document).on('click', '#generateReports', function() {
       var form_data = new FormData();
       
       var report_type = $("#report_type").val();
       var start_date = $("#start_date").val();
       var end_date = $("#end_date").val();

       form_data.append("report_type", report_type);
       form_data.append("start_date", start_date);
       form_data.append("end_date", end_date);

       switch (report_type){
              case "Inventory Report":
                     url = "app/Views/Reports/reports_inventory.php";
                     break;
              case "Purchase Report":
                     url = "app/Views/Reports/reports_purchases.php";
                     break;
              case "Sales Report":
                     url = "app/Views/Reports/reports_sales.php";
                     break;
       }

       $.ajax({
              type: "POST",
              url: url,
              data: form_data,
              dataType: 'html',
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                     var opt = {
                            margin: [25, 15, 20, 15], //top, left, buttom, right
                            filename: 'Reports.pdf',
                            image: {type: 'jpeg', quality: 1},
                            html2canvas: {dpi: 300, scale: 2, letterRendering: true},
                            jsPDF: {unit: 'pt', format: 'letter', orientation: 'landscape'}
                     };

                     html2pdf().set(opt).from(response).toPdf().get('pdf').then(function (pdfOutput) {
                                   var pdf_url = pdfOutput.output('bloburl');

                                   $.fancybox.open({
                                          src: pdf_url,
                                          type: 'iframe',
                                          iframe: { css: { width: "95%", height: "95%" } },
                                          infobar: true,
                                          buttons: ["fullScreen", "close"],
                                   });
                     });  
              }
       });
});  
$(document).on('click', '#saveItemsReceipt', function() {
       var form_data = new FormData();
       var product_name = $("#product_name").val();
       var quantity = $("#quantity").val();

       form_data.append("product_name", product_name);
       form_data.append("quantity", quantity);

       url = "app/Handlers/process_receipt_items.php";
       
       
       $.ajax({
              type: "POST",
              url: url,
              data: form_data,
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                     notification(response);
              }
       });
});  
$("#product_name").on('change', function() {
       var form_data = new FormData();
       var product_name = $(this).val();

       form_data.append("product_name", product_name);

       url = "app/Handlers/process_get_item_price.php";
       
       $.ajax({
              type: "POST",
              url: url,
              data: form_data,
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                     $("#price").val(response.price);
              }
       });
});  
$("#quantity").keyup(function() {
       var price = parseFloat($("#price").val());
       var quantity = parseFloat($(this).val());
       
       if (!isNaN(price) && !isNaN(quantity)) {
           var totalCost = price * quantity;
           $("#total_cost").val(totalCost); 
       }
});
$("#payment").keyup(function() {
       var totalCostValue = $("#totalAmmount").text().replace(/,/g, ''); // Remove commas from the string
       var paymentValue = $(this).val().replace(/,/g, ''); 

       var totalCost = parseFloat(totalCostValue);
       var payment = parseFloat(paymentValue);
   
       if (!isNaN(totalCost) && !isNaN(payment)) {
           var totalChange = payment - totalCost;
           $("#paymentPay").text(formatMoney(payment));
           $("#change").text(formatMoney(totalChange)); 
       }
   
       if ($(this).val().length === 0) {
           $("#paymentPay").text('0');
           $("#change").text('0');
       }
});
function formatMoney(number) {
       return number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}