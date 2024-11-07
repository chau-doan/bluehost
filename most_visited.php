<?php
session_start();
include 'header.php';

echo '<div class="most-visited-container">';
echo "<h2>Most Visited Products</h2>";

if (isset($_COOKIE['most_visited'])) {
    $most_visited = unserialize($_COOKIE['most_visited']);
    if (!empty($most_visited)) {
        arsort($most_visited); // Sort by most visited count, descending

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
        foreach (array_slice($most_visited, 0, 5) as $product_id => $count) {
            foreach ($products as $product) {
                if ($product['id'] == $product_id) {
                    echo "<li><a href='product.php?id={$product['id']}'>{$product['name']}</a> - {$count} visits</li>";
                }
            }
        }
        echo "</ul>";
    } else {
        echo "<p class='no-data-message'>No product visit data available.</p>";
    }
} else {
    echo "<p class='no-data-message'>No product visit data available.</p>";
}
echo "</div>";
include 'footer.php';
?>
