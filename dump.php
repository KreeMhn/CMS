// if (isset($_POST['confirm-order'])) {
//     foreach ($_SESSION['cart'] as $key => $value) {
//         $food = $value['Item_name'];
//         $price = $value['Price'];
//         $qty = $value['Quantity'];
//         $total = $price * $qty;
//         $order_date = date('Y-m-d H:i:s');
//         $customer_name = $_SESSION['username'];

//         $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date,  customer_name)
//                 VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$customer_name')";

//         if ($conn->query($sql) === TRUE) {
//             if ($_SERVER["REQUEST_METHOD"] == "POST") {
//                 $order_id = $conn->insert_id;
//                 $_SESSION['order_id'] = $order_id;
//                 // Process the order here

//                 // Example: Save order details to database, send confirmation emails, etc.

//                 // Clear the cart after order processing
//                 unset($_SESSION['cart']);

//                 // Redirect to thank you page
//                 header("Location: thank_you.php");
//                 exit;
//             } else {
//                 // If the request method is not POST, redirect to home page or show an error message
//                 header("Location: index.php");
//                 exit;
//             }
//         } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
// }




<?php
include ('partials-front/nav.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header('Location: loginform.php');
    exit;
}
$uname=$_SESSION['username'];
// SQL query
$sql = "SELECT * 
        FROM `tbl_order` 
        WHERE DATE(`order_date`) = CURDATE() 
          AND `customer_name` = '$uname' 
        ORDER BY `order_date` DESC";


// Execute the query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Order Status</h1>
    <table>
        <thead>
            <tr>
                <?php
                // Fetch field names to use as table headers
                if ($result->num_rows > 0) {
                    // Fetch the first row to get the field names
                    $first_row = $result->fetch_assoc();
                    // Print table headers
                    foreach ($first_row as $key => $value) {
                        echo "<th>" . htmlspecialchars($key) . "</th>";
                    }
                    // Reset the result pointer back to the first row
                    $result->data_seek(0);
                } else {
                    echo "<th>No results</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='" . $result->field_count . "'>0 results</td></tr>";
            }
            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Add a link to go back to the home page or any other relevant page -->
    <a href="index.php">Back to Home</a>
</body>

</html>