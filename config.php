<?php
function loadConfig() {
    $configPath = __DIR__ . '/config.json'; 
    if (!file_exists($configPath)) {
        die("Configuration file not found!");
    }
    $config = json_decode(file_get_contents($configPath), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Error decoding JSON configuration file: " . json_last_error_msg());
    }
    $dataFolder = __DIR__ . '/data/' . $config['database_name'];
    if (!file_exists($dataFolder)) {
        mkdir($dataFolder, 0777, true);
    }
    $config['data_folder'] = $dataFolder;
    return $config;
}
$config = loadConfig();
