<?php include('includes/conn.php'); ?>
<?php include('includes/header.php'); ?>

<?php

 
include('css/l.css');


if(isset($_REQUEST['email']))
{

   $name = $_REQUEST['name'];
   $email = $_REQUEST['email'];
   $password = $_REQUEST['password'];
      $user_type = $_REQUEST['user_type'];

   $str="select*from users where email = '$email' ";
$r=mysqli_query($con,$str); 
$num=mysqli_num_rows($r);
   if($num > 0)

{
      $message[] = 'user already exist!';
   }
else
{
        $str="insert into users (name, email, password, user_type) VALUES('$name', '$email', '$password', '$user_type')" or die('query failed');
        echo $str; 
mysqli_query($con,$str); 
mysqli_close($con); 
 header('location:login.php');

        
      }
   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   
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
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">

      <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>

<?php include('includes/footer.php'); ?>
