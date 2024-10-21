<?php include('includes/header.php'); ?>
<?php include('css/contact.css'); ?>

<div class="content">
    <h2>Contact Us</h2>
    <form action="send_contact.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
<br>

        <label>Email:</label>
        <input type="email" name="email" required>
<br>

        <label>Message:</label>
        <textarea name="message" required></textarea>
<br>
        <button type="submit">Send Message</button>
    </form>
</div>
<?php include('includes/footer.php'); ?>
