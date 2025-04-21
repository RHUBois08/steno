<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)->withServiceAccount('steno-interpreter-2.0.json')
                        ->withDatabaseUri('https://steno-interpreter-20da6-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();

$requests = $database->getReference('user_accounts/Students')->getValue();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Requests</title>
</head>
<body>
    <h1>User Registration Requests</h1>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Initial</th>
            <th>Student ID</th>
            <th>Username</th>
            <th>Year Level and Section</th>
            <th>Status</th>
            <th>Action</th>
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
                <td><?php echo htmlspecialchars($request['status']); ?></td>
                <td>
                    <form action="approve.php" method="POST" style="display:inline;">
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <button type="submit">Approve</button>
                    </form>
                    <form action="reject.php" method="POST" style="display:inline;">
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <button type="submit">Reject</button>
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