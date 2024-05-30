<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Reservation System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Railway Reservation System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="train-schedule.php">Train Schedule</a></li>
                <li><a href="book-ticket.php">Book Ticket</a></li>
                <li><a href="booked-tickets.php">Booked Tickets</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="review.php">Review</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
