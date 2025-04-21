<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

// Initialize Firebase
$factory = (new Factory)->withServiceAccount('stinu-bfb09-firebase-adminsdk-fbsvc-c36daffa83.json');
$database = $factory->createDatabase();

// Function to approve a user
function approveUser ($userId) {
    global $database;

    // Reference to the user in the database
    $userRef = $database->getReference('users/' . $userId);

    // Update user approval status
    $userRef->update([
        'approved' => true
    ]);

    echo "User  $userId approved.";
}

// Function to reject a user
function rejectUser ($userId) {
    global $database;

    // Reference to the user in the database
    $userRef = $database->getReference('users/' . $userId);

    // Update user approval status
    $userRef->update([
        'approved' => false
    ]);

    echo "User  $userId rejected.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        approveUser ($userId);
    } elseif ($action === 'reject') {
        rejectUser ($userId);
    }
}
?>

<!-- Simple HTML Form for User Approval -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Approval</title>
</head>
<body>
    <h1>User Approval</h1>
    <form method="POST" action="">
        <label for="userId">User  ID:</label>
        <input type="text" name="userId" id="userId" required>
        <button type="submit" name="action" value="approve">Approve</button>
        <button type="submit" name="action" value="reject">Reject</button>
    </form>
</body>
</html>