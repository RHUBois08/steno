<?php
require '../loads/admin/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$firebase = (new Factory)
    ->withServiceAccount('stinu-bfb09-firebase-adminsdk-fbsvc-c36daffa83.json');

$auth = $firebase->createAuth(); // Use createAuth() instead of getAuth()

try {
    // Fetch all users
  $users = $auth->listUsers();

  echo "<h1>Users List</h1>";
  echo "<table border='1'>";
  echo "<tr><th>Student ID</th><th>Last Name</th></tr><th>First Name</th></tr><th>Middle Initial</th></tr>
  <th>Yearlvl and Section</th></tr><th>Email</th><th>Username</th></tr><th>Password</th></tr>";

  foreach ($users as $students) {
      echo "<tr>";
      echo "<td>{$user->students_id}</td>";
      echo "<td>{$user->last_name}</td>";
      echo "<td>{$user->first_name}</td>";
      echo "<td>{$user->middle_initial}</td>";
      echo "<td>{$user->yearlvl_and_section}</td>";
      echo "<td>{$user->email}</td>";
      echo "<td>{$user->username}</td>";
      echo "<td>{$user->password}</td>";
      echo "</tr>";
  }

    echo "</table>";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>