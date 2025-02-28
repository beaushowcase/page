<?php
// Define the GitHub raw file URL and local file path
$github_url = 'https://raw.githubusercontent.com/beaushowcase/page/main/file_switcher.php';
$local_file = __DIR__ . '/file_switcher.php';

// Function to download file from GitHub
function download_file($url, $path) {
    // Initialize cURL
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for compatibility
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Execute cURL request
    $content = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    // Close cURL session
    curl_close($ch);
    
    // Check for errors
    if ($content === false || $http_code !== 200) {
        die("Error downloading file: $error (HTTP Code: $http_code)");
    }
    
    // Save file
    if (file_put_contents($path, $content) === false) {
        die('Error saving file');
    }
    
    return true;
}

// Check if we have write permissions
if (!is_writable(__DIR__)) {
    die('Error: No write permission in the directory');
}

// Download the file
try {
    if (download_file($github_url, $local_file)) {
        echo 'Successfully downloaded file_switcher.php';
    }
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}