<?php
session_start();
include 'includes/header.php';
?>

<main>
    <h2>Welcome to the Railway Reservation System</h2>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
    <?php endif; ?>
    <p>Book your train tickets easily and quickly.</p>
</main>

<?php include 'includes/footer.php'; ?>
