<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<header>
    <div class="logo">
        <h1>Future Technology</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="products.php">Shop</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <!-- If logged in, show Logout and Secure Section -->
                    <li><a href="secure.php">Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                    <!-- If not logged in, show Login -->
                    <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
