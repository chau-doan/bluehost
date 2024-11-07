<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

// Read the list of users from the text file
$users = [];
$file = fopen("users.txt", "r");
while (!feof($file)) {
    // Read each line and trim any newlines or spaces
    $user = trim(fgets($file));
    if (!empty($user)) {
        $users[] = $user;
    }
}
fclose($file);
?>

<?php include "header.php"; ?>
    <div class="container">
        <h2>Current Users of the Website</h2>
        <ul>
            <?php foreach ($users as $user) {
                echo "<li>$user</li>";
            } ?>
        </ul>
    </div>
<?php include "footer.php"; ?>