<?php
include 'includes/functions.php';
check_login();
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT bookings.id, trains.train_name, trains.source, trains.destination, bookings.booking_date, bookings.status
        FROM bookings
        JOIN trains ON bookings.train_id = trains.id
        WHERE bookings.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<main>
    <h2>Booked Tickets</h2>
    <table>
        <tr>
            <th>Train Name</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($booking = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $booking['train_name']; ?></td>
                <td><?php echo $booking['source']; ?></td>
                <td><?php echo $booking['destination']; ?></td>
                <td><?php echo $booking['booking_date']; ?></td>
                <td><?php echo $booking['status']; ?></td>
                <td>
                    <?php if ($booking['status'] == 'booked'): ?>
                        <form action="cancel-booking.php" method="POST">
                            <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                            <button type="submit">Cancel</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</main>
<?php include 'includes/footer.php'; ?>
