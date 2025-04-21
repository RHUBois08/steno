<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" type="text/css" href="../css/adminview.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128+Text&family=Tiny5&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquard+12&display=swap" rel="stylesheet">
</head>
<body style="background-color: #F2EFE7;align-items:center;  background-position: center center;
     background-attachment: fixed; background-size: 100%;"></body>

<body>
    <label>
        <input type="checkbox">
        <div style="background-color:#48A6A7;"class="toggle">
            <div class="common"></div>
            <div class="common1"></div>
            <div class="common2"></div>
            <span class="top_line"></span>
            <span class="middle_line"></span>
            <span class="bottom_line"></span>
        </div>
        <div style="background-color:#9ACBD0;" class="slide">
            <h1><i style="background-color:#48A6A7;" class="fa-solid fa-desktop"></i></h1><br><br>
            <ul>
                <li><a href="../admin/admin_home.html"><i class="fa-sharp fa-solid fa-house"></i>Home</a></li><br>
                <li><a href="../admin/admin_manage_user.php"><i class="fa-solid fa-person-chalkboard"></i>Manage Users</a></li><br>
                <li><a href="../admin/admin_users.php"><i class="fa-solid fa-user"></i>Users</a></li><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li><a href="../admin/admin.html" style="text-align:center;">Log out</a></li>
            </ul>
        </div> 
    </label>
</body>
</html>
<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

require_once 'configuration.php';

$factory = (new Factory)
    ->withServiceAccount(FIREBASE_SERVICE_ACCOUNT_JSON)
    ->withDatabaseUri(FIREBASE_DATABASE_URI);

$auth = $factory->createAuth();
$database = $factory->createDatabase(); 

try {

    $studentsRef = $database->getReference('user_accounts/Students')->getSnapshot();
    $studentsData = $studentsRef->getValue();

    if ($studentsData) {
        echo "<h1>View Users</h1>";
        echo "<style>
              h1{background-color: #2973B2;
                  }</style>";
        echo "<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 0 auto;
                    display: flex;
                    justify-content: center; 
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                th, td {
                    border: 1px solidrgb(8, 8, 8);
                    text-align: left;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                tr:hover {
                    background-color: #2973B2;
                }
              </style>";
        echo "<table>";
        echo "<tr>
                <th>Student ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Year Level and Section</th>
            </tr>";

        foreach ($studentsData as $studentId => $student) {
            echo "<tr>
                    <td>" . htmlspecialchars($student['student_id'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($student['username'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($student['email'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($student['first_name'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($student['last_name'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($student['yearlvl_and_section'] ?? 'N/A') . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No student data found.";
    }
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}

?>