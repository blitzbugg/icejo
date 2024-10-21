<?php
session_start();
include('includes/conn.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $wishlist_id = $_GET['id'];
    $user_id = $_SESSION['user'];

    $sql = "DELETE FROM wishlist WHERE id = '$wishlist_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product removed from wishlist!');</script>";
        header("Location: wishlist.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
