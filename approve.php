<?php
require 'userManagement.php'; // Include the user management functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    approveUser ($userId); // Call the function to approve the user
}
?>