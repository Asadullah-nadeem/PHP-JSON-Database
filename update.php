<?php
include 'config.php';
$config = loadConfig();
$id = $_GET['id'];
$file_path = "{$config['data_folder']}/$id.json";
if (file_exists($file_path)) {
    $record = json_decode(file_get_contents($file_path), true);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $record['name'] = $_POST['name'];
        $record['email'] = $_POST['email'];
        $json_data = json_encode($record, JSON_PRETTY_PRINT);
        file_put_contents($file_path, $json_data);
        header('Location: index.php');
        exit();
    }
} else {
    die("Record not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Record</title>
</head>
<body class="container mt-5">
    <h1>Edit Record</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $record['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $record['email']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
