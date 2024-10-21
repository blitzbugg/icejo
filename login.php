<?php include('includes/header.php'); ?> <!-- Include Header -->

<?php

 include('includes/conn.php');
session_start();

if(isset($_REQUEST['email'])){

   $email = $_REQUEST['email'];
   $password = $_REQUEST['password'];

   $str =  "SELECT * FROM users WHERE email = '$email' "or die('query failed');
$r=mysqli_query($con,$str); 
$num=mysqli_num_rows($r);

   if(($num) > 0)
{

      $row = mysqli_fetch_assoc($r);

      if($row['user_type'] == 'admin'){

         // $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_password'] = $row['password'];
         // $_SESSION['admin_id'] = $row['id'];
       header('Location: ./admin/admin_page.php');
      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/l.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
 <div class="form-container">

   <form action="" method="post">
    <center>  <h2>Login now</h2>   </center>
     <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

 <label for="password"><b>Password</b></label>
<input type="password" name="password" placeholder="enter your password" required >

 <div class="clearfix">
      
    <button type="submit" class="loginbtn">Login</button>

    </div>

<p>Don't have an account? <a href="regi.php">signup now</a></p>
   </form>

</div>

</body>
</html>
<?php include('includes/footer.php'); ?>
