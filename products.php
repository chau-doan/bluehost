<?php 
session_start();
include 'header.php'; 
?>

<h2>Our Products and Services</h2>

<div class="product-container">
<?php
// Load products from CSV file
function getProducts() {
    $products = [];
    if (($handle = fopen("products.csv", "r")) !== false) {
        $headers = fgetcsv($handle); // Read the header row
        while (($data = fgetcsv($handle)) !== false) {
            $products[] = array_combine($headers, $data);
        }
        fclose($handle);
    }
    return $products;
}

$products = getProducts();

if ($products) {
    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<h3><a href='product.php?id={$product['id']}'>{$product['name']}</a></h3>";
        echo "<p>{$product['description']}</p>";
        echo "<p class='price'>Price: \${$product['price']}</p>";
        echo "<img src='{$product['image']}' alt='{$product['name']}'>";
        echo "</div>";
    }
} else {
    echo "<p>No products found.</p>";
}
?>
</div>

<div class="view-links">
    <a href="recently_viewed.php">Recently Viewed Products</a>
    <a href="most_visited.php">Most Visited Products</a>
</div>

<?php include 'footer.php'; ?>
