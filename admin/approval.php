<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database; // Add this for database access

// Include the config file
require_once 'configuration.php';

$factory = (new Factory)
    ->withServiceAccount(FIREBASE_SERVICE_ACCOUNT_JSON)
    ->withDatabaseUri(FIREBASE_DATABASE_URI);

$database = $factory->createDatabase(); // Create the database instance

try {
    // Fetch all user data from the Students node
    $studentsRef = $database->getReference('user_accounts/Students')->getSnapshot();
    $studentsData = $studentsRef->getValue();

    if ($studentsData) {
        echo "<h1>Manage User Registrations</h1>";
        echo "<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #dddddd;
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
                    background-color: #f1f1f1;
                }
              </style>";
        echo "<table>";
        echo "<tr>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>";

        // Loop through each student and display their data
        foreach ($studentsData as $studentId => $student) {
            if ($student['status'] === 'pending') { // Only show pending registrations
                echo "<tr>
                        <td>" . htmlspecialchars($student['username'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($student['email'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($student['status'] ?? 'N/A') . "</td>
                        <td>
                            <form method='POST' action='manage_users.php'>
                                <input type='hidden' name='student_id' value='" . htmlspecialchars($studentId) . "'>
                                <button type='submit' name='action' value='approve'>Approve</button>
                                <button type='submit' name='action' value='reject'>Reject</button>
                            </form>
                        </td>
                      </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "No pending registrations found.";
    }
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}

// Handle form submission for approving or rejecting users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['student_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        // Update the user's status to approved
        $database->getReference('user_accounts/Students/' . $studentId . '/status')->set('approved');
        echo "User  $studentId has been approved.";
    } elseif ($action === 'reject') {
        // Update the user's status to rejected
        $database->getReference('user_accounts/Students/' . $studentId . '/status')->set('rejected');