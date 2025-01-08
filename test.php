<?php
include ('config/constants.php');

// Assuming you have a function to check if the user is logged in
// If not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: loginform.php');
    exit;
}

// Example: Get order details from database
$orderDetails = []; // Fetch order details here

// Display thank you message and order status
echo "<h1>Thank You!</h1>";
echo "<p>Your order has been successfully placed.</p>";
echo "<h2>Order Details:</h2>";
// Display order details
// Example: Item name, quantity, total amount, etc.
foreach ($orderDetails as $detail) {
    // Display order details
}

// Fetch order details if order_id is set
$orderDetails = [];
if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
    $sql = "SELECT * FROM tbl_order WHERE id = $order_id";
    if ($conn->query($sql) === TRUE) {

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orderDetails[] = $row;
            }
        }
    }
}

// Handle order cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])) {
    if (isset($_SESSION['order_id'])) {
        $order_id = $_SESSION['order_id'];

        $sql = "SELECT order_date FROM tbl_order WHERE id = $order_id";
        // $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $order_date = $row['order_date'];
                $current_date = date('Y-m-d H:i:s');

                // Calculate the time difference in seconds
                $time_diff = strtotime($current_date) - strtotime($order_date);

                if ($time_diff <= 300) { // 300 seconds = 5 minutes
                    // Cancel the order
                    $sql_cancel = "DELETE FROM tbl_order WHERE id = $order_id";
                    if ($conn->query($sql_cancel) === TRUE) {
                        echo "Order canceled successfully.";
                    } else {
                        echo "Error canceling order: " . $conn->error;
                    }
                } else {
                    echo "Cancellation period has expired.";
                }
            } else {
                echo "Order not found.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>

<body>
    <h1>Thank You!</h1>
    <p>Your order has been successfully placed.</p>
    <h2>Order Details:</h2>
    <?php
    // Display order details
    if (!empty($orderDetails)) {
        foreach ($orderDetails as $detail) {
            echo "<p>Item: {$detail['food']}, Quantity: {$detail['qty']}, Total: {$detail['total']}</p>";
        }
    } else {
        echo "<p>No order details found.</p>";
    }
    ?>

    <form method="post" action="">
        <button type="submit" name="cancel">Cancel Order</button>
    </form>

    <!-- Provide a link to go back to the home page -->
    <a href="index.php">Back to Home</a>
</body>

</html>