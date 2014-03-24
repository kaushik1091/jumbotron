

<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";

if (isset($_POST['username'], $_POST['user_id'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    echo $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    echo $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_EMAIL);
    echo $user_id = filter_var($user_id, FILTER_VALIDATE_EMAIL);
    if (!filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
        // Not a valid user_id
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT user_id FROM users WHERE user_id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this user_id address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO users (user_id, user_name, user_pass, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $user_id, $username, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}