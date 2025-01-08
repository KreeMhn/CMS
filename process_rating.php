<?php
include ('config/constants.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted rating and item name from the form
    $rating = $_POST['rating'];
    $item_name = $_POST['item_name'];

    // Process the rating (e.g., store it in the database)
    // Example: Insert the rating into the ratings table
    // Replace this with your database connection and SQL query
    $sql = "INSERT INTO ratings (item_name, rating) VALUES ('$item_name', '$rating')";
    // Execute the SQL query (assuming $conn is your database connection)
    if (mysqli_query($conn, $sql)) {
        echo "Rating submitted successfully!";
        header("Location: feedback.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>