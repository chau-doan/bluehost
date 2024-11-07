<?php
session_start();



// Load CSV data into an associative array
function getProducts() {
    $products = [];
    if (($handle = fopen("products.csv", "r")) !== false) {
        $headers = fgetcsv($handle); // Read header row
        while (($data = fgetcsv($handle)) !== false) {
            $products[] = array_combine($headers, $data);
        }
        fclose($handle);
    }
    return $products;
}

// Get product ID from URL parameter
$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$products = getProducts();
$product = null;

// Find product by ID
foreach ($products as $item) {
    if ($item['id'] == $product_id) {
        $product = $item;
        break;
    }
}

// If product found, display it
if ($product) {
    // Track recently viewed products using cookies
    $recently_viewed = isset($_COOKIE['recently_viewed']) ? explode(",", $_COOKIE['recently_viewed']) : [];
    if (!in_array($product_id, $recently_viewed)) {
        array_unshift($recently_viewed, $product_id); // Add to the beginning
        if (count($recently_viewed) > 5) {
            array_pop($recently_viewed); // Keep only last 5
        }
        setcookie("recently_viewed", implode(",", $recently_viewed), time() + 86400, "/");
    }

    // Track most visited products
    $most_visited = isset($_COOKIE['most_visited']) ? unserialize($_COOKIE['most_visited']) : [];
    $most_visited[$product_id] = isset($most_visited[$product_id]) ? $most_visited[$product_id] + 1 : 1;
    setcookie("most_visited", serialize($most_visited), time() + 86400, "/");
    include 'header.php';
    echo '<div class="product-page">';
    echo "<h2>{$product['name']}</h2>";
    echo "<img src='{$product['image']}' alt='{$product['name']}' style='width:300px;height:auto;'>";
    echo "<p>{$product['description']}</p>";
    echo "<p class='price'>Price: \${$product['price']}</p>";
} else {
    include 'header.php';
    echo '<div class="product-page">';
    echo "<p>Product not found.</p>";
}
echo ' </div>'
?>

<div class="view-links">
    <a href="recently_viewed.php">Recently Viewed Products</a>
    <a href="most_visited.php">Most Visited Products</a>
</div>

<?php include 'footer.php'; ?>

