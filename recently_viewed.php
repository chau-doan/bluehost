<?php
session_start();
include 'header.php';

echo '<div class="most-visited-container">';
echo "<h2>Recently Viewed Products</h2>";

if (isset($_COOKIE['recently_viewed'])) {
    $recently_viewed = explode(",", $_COOKIE['recently_viewed']);
    if (count($recently_viewed) > 0) {
        // Load products from CSV
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

        $products = getProducts();
        
        echo "<ul>";
        foreach ($recently_viewed as $product_id) {
            foreach ($products as $product) {
                if ($product['id'] == $product_id) {
                    echo "<li><a href='product.php?id={$product['id']}'>{$product['name']}</a></li>";
                }
            }
        }
        echo "</ul>";
    } else {
        echo "<p class='no-data-message'>No recently viewed products.</p>";
    }
} else {
    echo "<p class='no-data-message'>No recently viewed products.</p>";
}
echo "</div>";

include 'footer.php';
?>
