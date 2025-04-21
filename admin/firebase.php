<?php
require 'vendor/autoload.php'; // Ensure you have the autoload file from Composer

use Kreait\Firebase\Factory;

try {
    $factory = (new Factory)->withServiceAccount('../admin/steno-interpreter-20da6-firebase-adminsdk-1z6sz-e96c19b442.json'); // Update the path
    $database = $factory->createDatabase(); // Initialize the database connection
} catch (Exception $e) {
    die('Firebase connection failed: ' . $e->getMessage());
}
?>