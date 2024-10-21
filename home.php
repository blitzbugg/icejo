<?php include('includes/conn.php'); ?>
<?php include('includes/header.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TINY TOTS</title>
    <link rel="stylesheet" href="css/home.css"> <!-- Link to your CSS file -->
</head>
<body>
    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Welcome to TINY TOTS!</h2>
                <p>WHERE CUTE MEETS QUALITY</p>
                <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </section>
        <marquee><h4>WHERE CUTE MEETS QUALITY</h4></marquee>

        <section class="featured-products">
            <div class="container">
                <h2>Featured Products</h2>
                <p>Check out the latest toys available in our store!</p>

                <div class="product-grid">
                    <?php
                    // Fetch products from the database
                    $query = "SELECT * FROM products"; // Adjust table name as necessary
                    $result = mysqli_query($con, $query) or die('query failed');

                    while ($product = mysqli_fetch_assoc($result)) {
                        // Assuming the columns are named 'id', 'name', 'price', 'image'
                        echo '<div class="product">';
                        echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
                        echo '<h3>' . $product['name'] . '</h3>';
                        echo '<p>$' . number_format($product['price'], 2) . '</p>';
                        echo '<form method="post">';
                        echo '<input type="hidden" name="product_name" value="' . $product['name'] . '">';
                        echo '<input type="hidden" name="product_price" value="' . $product['price'] . '">';
                        echo '<input type="hidden" name="product_image" value="' . $product['image'] . '">';
                        echo '<input type="number" name="product_quantity" value="1" min="1">';
                        echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <?php
    if (isset($_POST['add_to_cart'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        // Assuming $user_id is set from a session or previous code
        $check_cart_numbers = mysqli_query($con, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_cart_numbers) > 0) {
            $message[] = 'Already added to cart!';
        } else {
            mysqli_query($con, "INSERT INTO cart(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'Product added to cart!';
        }
    }
    ?>

    <?php include('includes/footer.php'); ?>
</body>
</html>
