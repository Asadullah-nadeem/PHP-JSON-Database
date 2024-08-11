<?php
session_start();
include 'config.php';

$config = loadConfig();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $input_database = $_POST['database_name'];
    if ($input_username === $config['username'] && $input_password === $config['password']) {
        $database_folder = __DIR__ . '/data/' . $input_database;
        
        if (is_dir($database_folder)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['database_name'] = $input_database; // Store database name in session
            header('Location: index.php'); // Redirect to the index page
            exit();
        } else {
            $error_message = 'Database folder does not exist!';
        }
    } else {
        $error_message = 'Invalid username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body class="container mt-5">
    <h1>Login</h1>
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text password-toggle" id="togglePassword" onclick="togglePassword()">Show</span>
            </div>
        </div>
        <div class="mb-3">
            <label for="database_name" class="form-label">Database Name</label>
            <input type="text" class="form-control" id="database_name" name="database_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.innerText = 'Hide';
            } else {
                passwordInput.type = 'password';
                toggleButton.innerText = 'Show';
            }
        }
    </script>
</body>
</html>
