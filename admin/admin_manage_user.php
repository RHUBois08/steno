<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <link rel="stylesheet" type="text/css" href="../css/adminusers.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128+Text&family=Tiny5&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquard+12&display=swap" rel="stylesheet">
</head>
<body style="background-color: #F2EFE7; align-items:center;  background-position: center center;
     background-attachment: fixed; background-size: 100%;"></body>
<body>
<body>
    <label>
        <input type="checkbox">
        <div style="background-color:#48A6A7;" class="toggle">
            <div class="common"></div>
            <div class="common1"></div>
            <div class="common2"></div>
            <span class="top_line"></span>
            <span class="middle_line"></span>
            <span class="bottom_line"></span>
        </div>
        <div style="background-color:#9ACBD0;"class="slide">
            <h1><i style="background-color:#48A6A7;" class="fa-solid fa-desktop"></i></h1><br><br>
            <ul>
                <li><a href="../admin/admin_home.html"><i class="fa-sharp fa-solid fa-house"></i>Home</a></li><br>
                <li><a href="../admin/admin_manage_user.php"><i class="fa-solid fa-person-chalkboard" action = "approval.php"></i>Manage Users</a></li><br>
                <li><a href="../admin/admin_users.php"><i class="fa-solid fa-user"></i>Users</a></li><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li><a href="../admin/admin.html" style="text-align:center;">Log out</a></li>
            </ul>
        </div> 
</body>
</html>
<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)->withServiceAccount('steno-interpreter-2.0.json')
                        ->withDatabaseUri('https://steno-interpreter-20da6-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();

// Fetch all student accounts
$requests = $database->getReference('user_accounts/Students')->getValue();

// Initialize an array to hold the filtered request for "Dwin"
$filteredRequests = [];

// Check if requests are an array and filter for the specific user "Dwin"
if (is_array($requests)) {
    foreach ($requests as $uid => $request) {
        if (isset($request['username']) && $request['username'] === 'Dwin') {
            $filteredRequests[$uid] = $request;
            break; // Stop after finding "Dwin"
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Manage Users</title>
    <style>

table {
    width: 50%; /* Set the width of the table */
    max-width: 600px; /* Maximum width of the table */
    margin: 0; /* Center the table */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    align-items: center;
    justify-content: center; 
    right: 150px;
    border-collapse: collapse;
}

th, td {

    padding: 1px; /* Add padding to table cells */
    text-align: center; /* Align text to the left */
    border: 1px solid #ddd; /* Light gray border */
}

th {
    background-color: #f2f2f2; /* Light gray background for header */
}

tr:hover {
    background-color: #2973B2;; /* Highlight row on hover */
}

button {
    padding: 5px 10px; /* Padding for buttons */
    margin: 0 5px; /* Margin between buttons */
    margin-bottom: 10px;
    margin-top: 10px;
    cursor: pointer; /* Change cursor to pointer */
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    border: none; /* Remove border */
    border-radius: 4px; /* Rounded corners */

}
</style>

</head>
<body>
    <h1 style="background-color: #2973B2;">Manage Users</h1>
    <table>
        <tr>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Initial</th>
            <th>Student ID</th>
            <th>Username</th>
            <th>Year Level and Section</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
        <?php if ($requests): ?>
            <?php foreach ($requests as $uid => $request): ?>
            <tr>
                <td><?php echo htmlspecialchars($request['email']); ?></td>
                <td><?php echo htmlspecialchars($request['first_name']); ?></td>
                <td><?php echo htmlspecialchars($request['last_name']); ?></td>
                <td><?php echo htmlspecialchars($request['middle_initial']); ?></td>
                <td><?php echo htmlspecialchars($request['student_id']); ?></td>
                <td><?php echo htmlspecialchars($request['username']); ?></td>
                <td><?php echo htmlspecialchars($request['yearlvl_and_section']); ?></td>
                <td><?php echo isset($request['status']) ? htmlspecialchars($request['status']) : 'N/A'; ?></td>
                <td>
                    <form action="approve.php" method="POST" style="display:inline;">
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to approve this user?');"style="color:black;">Approve</button>
                    </form>
                    <form action="reject.php" method="POST" style="display:inline;">
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to reject this user?');"style="width:70px; background-color:yellow; color:black;">Reject</button>
                    </form>
                    <form action="remove.php" method="POST" style="display:inline;">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to remove this user?');" style="width:70px; background-color:red; color:black;" >Remove</button>
                </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No registration requests found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>