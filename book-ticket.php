<?php
include 'includes/functions.php';
check_login();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $train_id = $_POST['train_id'];
    $user_id = $_SESSION['user_id'];
    $booking_date = date('Y-m-d');

    $sql = "INSERT INTO bookings (user_id, train_id, booking_date) VALUES ('$user_id', '$train_id', '$booking_date')";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE trains SET available_seats = available_seats - 1 WHERE id='$train_id'";
        $conn->query($sql);
        echo "Ticket booked successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM trains WHERE available_seats > 0";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<main>
    <h2>Book a Ticket</h2>
    <form method="POST" action="">
        <label for="train_id">Select Train:</label>
        <select id="train_id" name="train_id" required>
            <?php while ($train = $result->fetch_assoc()): ?>
                <option value="<?php echo $train['id']; ?>">
                    <?php echo $train['train_name'] . " (" . $train['source'] . " to " . $train['destination'] . ")"; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Book Ticket</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
