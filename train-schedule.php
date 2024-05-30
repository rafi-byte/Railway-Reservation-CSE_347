<?php
include 'includes/db.php';

$sql = "SELECT * FROM trains";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<main>
    <h2>Train Schedule</h2>
    <table>
        <tr>
            <th>Train Name</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Available Seats</th>
        </tr>
        <?php while ($train = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $train['train_name']; ?></td>
                <td><?php echo $train['source']; ?></td>
                <td><?php echo $train['destination']; ?></td>
                <td><?php echo $train['departure_time']; ?></td>
                <td><?php echo $train['arrival_time']; ?></td>
                <td><?php echo $train['available_seats']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</main>
<?php include 'includes/footer.php'; ?>
