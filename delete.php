<?php
include 'config.php';

$config = loadConfig();
$id = $_GET['id'];
$file_path = "{$config['data_folder']}/$id.json";
$deleted_folder = "{$config['data_folder']}/deleted";
if (!file_exists($deleted_folder)) {
    mkdir($deleted_folder, 0777, true);
}

if (file_exists($file_path)) {
    $deleted_file_path = "{$deleted_folder}/deleted_{$id}.json";
    rename($file_path, $deleted_file_path);
}

header('Location: index.php');
exit();
