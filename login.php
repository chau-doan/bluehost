<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: secure.php");
    exit;
}
?>

<?php include "header.php"; ?>
    <h2>Login</h2>  
    <form method="POST" action="verify.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
<?php include "footer.php"; ?>