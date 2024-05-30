<?php
include 'includes/functions.php';
check_login();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the booking belongs to the logged-in user
    $sql = "SELECT * FROM bookings WHERE id = '$booking_id' AND user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the booking status to 'cancelled'
        $sql = "UPDATE bookings SET status = 'cancelled' WHERE id = '$booking_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Booking cancelled successfully.";
        } else {
            echo "Error cancelling booking: " . $conn->error;
        }
    } else {
        echo "Invalid booking.";
    }
}

$conn->close();
header("Location: booked-tickets.php");
exit();
?>
