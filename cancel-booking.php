<?php
include 'includes/functions.php';
check_login();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];

    $sql = "UPDATE bookings SET status='cancelled' WHERE id='$booking_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Booking cancelled successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT bookings.id, trains.train_name, trains.source, trains.destination, bookings.booking_date, bookings.status
        FROM bookings
        JOIN trains ON bookings.train_id = trains.id
        WHERE bookings.user_id = '$user_id' AND bookings.status = 'booked'";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<main>
    <h2>Cancel Booking</h2>
    <form method="POST" action="">
        <label for="booking_id">Select Booking to Cancel:</label>
        <select id="booking_id" name="booking_id" required>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <option value="<?php echo $booking['id']; ?>">
                    <?php echo $booking['train_name'] . " (" . $booking['source'] . " to " . $booking['destination'] . ")"; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Cancel Booking</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
