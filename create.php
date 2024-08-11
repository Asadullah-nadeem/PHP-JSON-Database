<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = loadConfig();
    $id = uniqid();
    $file_path = "{$config['data_folder']}/$id.json";
    
    $data = [
        'id' => $id,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
    ];

    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file_path, $json_data);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Record</title>
</head>
<body class="container mt-5">
    <h1>Create New Record</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
