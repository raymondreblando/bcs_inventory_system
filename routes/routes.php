<?php
Flight::set('flight.views.path', 'app/');

Flight::route('/', function(){
    Flight::render('Views/login.php');
});
Flight::route('/home', function(){
    Flight::render('Views/receipt.php');
});
Flight::route('/inventory', function(){
    Flight::render('Views/inventory.php');
});
Flight::route('/add-item', function(){
    Flight::render('Views/add-item.php');
});
Flight::route('/update-item/@id', function($id){
    Flight::render('Views/update-item.php', array('id' => $id));
});
Flight::route('/add-category', function(){
    Flight::render('Views/add-category.php');
});
Flight::route('/update-category/@id', function($id){
    Flight::render('Views/update-category.php', array('id' => $id));
});
Flight::route('/purchases', function(){
    Flight::render('Views/purchases.php');
});
Flight::route('/add-entry', function(){
    Flight::render('Views/add-entry.php');
});
Flight::route('/update-entry/@id', function($id){
    Flight::render('Views/update-entry.php', array('id' => $id));
});
Flight::route('/sales', function(){
    Flight::render('Views/sales.php');
});

Flight::route('/return/@id', function($id){
    Flight::render('Views/return-item.php', array('id' => $id));
});
Flight::route('/accounts', function(){
    Flight::render('Views/accounts.php');
});
Flight::route('/create-account', function(){
    Flight::render('Views/create-account.php');
});
Flight::route('/update-account/@id', function($id){
    Flight::render('Views/update-account.php', array('id' => $id));
});
Flight::route('/reports', function(){
    Flight::render('Views/reports.php');
});
Flight::route('/settings', function(){
    Flight::render('Views/account-settings.php');
});
Flight::route('/logout', function(){
    Flight::render('Views/users-logout.php');
});
// Route for handling 403 Forbidden error
Flight::map('error403', function(){
    Flight::render('Views/error/403.php');
});
// Route for handling 404 Not Found error
Flight::map('notFound', function(){
    Flight::render('Views/error/404.php');
});
// Route for handling 405 Method Not Allowed error
Flight::map('methodNotAllowed', function(){
    Flight::render('Views/error/405.php');
});