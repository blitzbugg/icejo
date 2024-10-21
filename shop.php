<?php
include('includes/conn.php'); // Ensure this line includes your database connection

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Ensure no further code is executed after redirect
}

if (isset($_POST['add_to_cart'])) {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($con, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Already added to cart!';
    } else {
        mysqli_query($con, "INSERT INTO cart (user_id, name, price, quantity, image) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');
        $message[] = 'Product added to cart!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
</head>
<body>
   
<?php include('includes/header.php'); ?>

<div class="heading">
   <h3>Our Shop</h3>
   <p><a href="home.php">Home</a> / Shop</p>
</div>

<section class="products">
   <h1 class="title">Latest Products</h1>
   <div class="box-container">

      <?php  
         $str_products = "SELECT * FROM products";
         $r = mysqli_query($con, $str_products) or die('Query failed');
         $num = mysqli_num_rows($r);

         if ($num > 0) {
            while ($fetch_products = mysqli_fetch_assoc($r)) {
      ?>
      <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
         <input type="number" min="1" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
       <a href="cart.php" class="btn">Add to  cart</a>
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
   </div>
</section>

<?php include('includes/footer.php'); ?>

</body>
</html>
