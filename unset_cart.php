<?php
session_start();
include ('partials-front/nav.php');
$uname=$_SESSION['username'];
// Check if the cart session variable exists
if(isset($_SESSION['cart'])) {

    
    foreach ($_SESSION['cart'] as $item) {
        $item_name = $item['Item_name'];
        $price = $item['Price'];
        $quantity = $item['Quantity'];
        $total = $price * $qty; //total= price x qty
        $order_date = date("Y-m-d h:i:sa"); //order date
        $status = "Ordered"; //ordered, on delivery , delivered, cancelled
        $sql = "SELECT Username, Phone, Email FROM userdb WHERE Username='$uname'";

            // Execute query
            $result = $conn->query($sql);

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Fetch data and store it in variables
                while ($row = $result->fetch_assoc()) {
                    $customer_name = $row["Username"];
                    $customer_contact = $row["Phone"];
                    $customer_email = $row["Email"];
                }
            } else {
                // No rows returned, handle the case
                echo "No data found for username: $uname";
            }

        // $customer_name = $_POST['full-name'];
        // $customer_contact = $_POST['contact'];
        // $customer_email = $_POST['email'];
        $sql2 = "INSERT INTO tbl_order SET
            food=' $item_name',
            price=$price,
            qty=$quantity,
            total=$total,
            order_date='$order_date',
            status='$status',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_email='$customer_email'
           
       ";

        // echo $sql2; die();
    
        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //check whether the query executed successfully or not
        if ($res2 == true) {
            //query executed successfully
            $_SESSION['order'] = "<div class='success text-center'>Ordered Placed Successfully</div>";
            header('location:' . SITEURL);
        } else {
            //failed to save order
            $_SESSION['order'] = "<div class='error text-center'>Failed to order food.</div>";
            header('location:' . SITEURL);
        } 
// Unset the cart session variable
unset($_SESSION['cart']);
// Optionally, destroy the entire session if you want to clear all session data
// session_destroy();

echo "Cart has been cleared.";
header("Location: cart.php");
            
}

}
?>
