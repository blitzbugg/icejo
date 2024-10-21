<?php
include('conn.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

<link rel="stylesheet" href="styleadmin.css"> <!-- Link to your CSS file -->

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $str_pending = mysqli_query($con, "SELECT total_price FROM `orders` WHERE payment_status = 'order placed'") or die('query failed');
            if(mysqli_num_rows($str_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($str_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>₹<?php echo $total_pendings; ?>/-</h3>
         <p>total pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($con, "SELECT total_price FROM `orders` WHERE payment_status = 'Delivered'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>₹<?php echo $total_completed; ?>/-</h3>
         <p>completed payments</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($con, "SELECT * FROM orders") or die('query failed');
            $number_of_orders = mysqli_num_rows($str_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order </p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($con, "SELECT * FROM products") or die('query failed');
            $number_of_products = mysqli_num_rows($str_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>products added</p>
      </div>

      <div class="box">
         <?php 
            $str_users = mysqli_query($con, "SELECT * FROM users WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($str_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php 
            $str_admins = mysqli_query($con, "SELECT * FROM users WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($str_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php 
            $str_account = mysqli_query($con, "SELECT * FROM users") or die('query failed');
            $number_of_account = mysqli_num_rows($str_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         <?php 
            $str_messages = mysqli_query($con, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($str_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>new messages</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->

</body>
</html>