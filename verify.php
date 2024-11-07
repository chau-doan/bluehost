<?php
session_start();

// Get the form input
$username = $_POST['username'];
$password = $_POST['password'];

// Open the file containing the usernames and passwords
$file = fopen("password.txt", "r");

// Variable to check if the user is verified
$userVerified = false;

// Loop through each line in the file
while (!feof($file)) {
    $line = fgets($file);
    // Remove the newline character
    $line = chop($line);
    // Split the line into username and password using a comma as the delimiter
    list($file_username, $file_password) = explode(",", $line);

    // Check if the username and password match
    if ($username === $file_username && $password === $file_password) {
        // If they match, set the session and redirect to the secure page
        $_SESSION['loggedin'] = true;
        $userVerified = true;
        break;
    }
}

// Close the file
fclose($file);

if ($userVerified) {
    // Redirect to the secure page
    header("Location: secure.php");
    exit;
} else {
    // If the login fails, display an error message
    echo "<p>Invalid username or password. Please try again.</p>";
    echo '<a href="login.php">Go back to login page</a>';
}
?>