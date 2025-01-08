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
$sql = "SELECT `id`, `food`, `price`, `qty`, `total`,
        `order_date`, `status`, `customer_name`
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
        body{
            margin-left:20px;
        }
        /* Add your CSS styles here */
        table {
            width: 90%;
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
    <h1 style="text-align:center;">Order Status</h1><br>
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

<!-- 
    <table>
        <tr>
            <th>Status</th>
            <th>Customer Name</th>
        </tr>
        <?php
        // if ($result->num_rows > 0) {
        //     // Output data of each row
        //     while($row = $result->fetch_assoc()) {
        //         echo "<tr><td>" . $row["status"]. "</td><td>" . $row["customer_name"]. "</td></tr>";
        //     }
        // } else {
        //     echo "<tr><td colspan='2'>0 results</td></tr>";
        // }
        // // Close the connection
        // $conn->close();
        ?>
    </table> -->

    <!-- Add a link to go back to the home page or any other relevant page -->
    <br><a href="index.php">Back to Home</a>
</body>

</html>