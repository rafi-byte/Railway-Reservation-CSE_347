<?php
include 'includes/functions.php';
check_login();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $train_id = $_POST['train_id'];
    $user_id = $_SESSION['user_id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO reviews (user_id, train_id, review, rating) VALUES ('$user_id', '$train_id', '$review', '$rating')";
    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM trains";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<main>
    <h2>Post Journey Review</h2>
    <form method="POST" action="">
        <label for="train_id">Select Train:</label>
        <select id="train_id" name="train_id" required>
            <?php while ($train = $result->fetch_assoc()): ?>
                <option value="<?php echo $train['id']; ?>">
                    <?php echo $train['train_name'] . " (" . $train['source'] . " to " . $train['destination'] . ")"; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="review">Review:</label>
        <textarea id="review" name="review" required></textarea>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>
        <button type="submit">Submit Review</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
