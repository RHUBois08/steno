<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)->withServiceAccount('steno-interpreter-2.0.json')
                        ->withDatabaseUri('https://steno-interpreter-20da6-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];

    // Remove the user from the database
    $database->getReference('user_accounts/Students/' . $uid)->remove();

    echo "User  removed successfully!";
    // Redirect back to the manage users page or show a success message
    header("Location: admin_manage_user.php"); // Adjust the redirect as needed
    exit();
} else {
    echo "Invalid request.";
}
?>