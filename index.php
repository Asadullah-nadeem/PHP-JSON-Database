<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'config.php'; 
$config = loadConfig();
$files = glob("{$config['data_folder']}/*.json");
$deleted_files = glob("{$config['data_folder']}/deleted/*.json");

$records = [];
$deleted_records = [];
foreach ($files as $file) {
    $content = file_get_contents($file);
    $records[] = json_decode($content, true);
}
foreach ($deleted_files as $file) {
    $content = file_get_contents($file);
    $deleted_records[] = json_decode($content, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PHP JSON Database</title>
</head>
<body class="container mt-5">
    <a href="logout.php" class="btn btn-secondary">Logout</a>

    <h1>My Database: <?php echo $config['database_name']; ?></h1>
    <a href="create.php" class="btn btn-primary mb-3">Add New Record</a>
    
    <h2>Active Records</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo $record['id']; ?></td>
                    <td><?php echo $record['name']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $record['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $record['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Deleted Records</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Deleted</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deleted_records as $record): ?>
                <tr>
                    <td><?php echo $record['id']; ?></td>
                    <td><?php echo $record['name']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td><?php echo date("Y-m-d H:i:s", filemtime("{$config['data_folder']}/deleted/deleted_{$record['id']}.json")); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
