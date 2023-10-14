<?php
require_once '../../initialized.php';

$id = $functions->validate($_POST['id']);

$database->DBQuery("DELETE FROM `receipt` WHERE `r_id` = ?", [$id]);
$functions->notification("Item successfully removed.", "success", 200, "yes");

$database->closeConnection();