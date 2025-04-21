<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)->withServiceAccount('steno-interpreter-2.0.json')
                          ->withDatabaseUri('https://steno-interpreter-20da6-default-rtdb.firebaseio.com/');
$auth = $factory->createAuth();
$database = $factory->createDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uid = $_POST['uid'];

  $userData = $database->getReference('user_accounts/Students/' . $uid)->getValue();

  if ($userData) {
    // Update the user's status to 'approved'
    $database->getReference('user_accounts/Students/' . $uid)->update(['status' => 'approved']);

    try {
      // Correctly call the method to create a user with email and password
      $auth->createUserWithEmailAndPassword($userData['email'], $userData['password']);  // Fixed typo here
      echo "User approved successfully!";
      header("Location: admin_manage_user.php"); // Adjust the redirect as needed
      exit();
    } catch (Exception $e) {
      echo "User approved successfully";
      header("Location: admin_manage_user.php"); // Adjust the redirect as needed
      exit();
    }
  } else {
    echo "User not found.";
  }
} else {
  echo "Invalid request.";
}
?>