<?php

include ('partials-front/nav.php');

function isLoggedIn()
{
    // Check if the 'username' session variable exists
    return isset($_SESSION['username']);
}

// If the user is not logged in, redirect them to the login page
if (!isLoggedIn()) {
    header('Location: loginform.php');
    exit;
}

if(isset($_POST['confirm-order'])) {
    // Retrieve the total value from the form
    $total = $_POST['total'];
    // Redirect to payment.php with the total as a query parameter
    header("Location: payment.php?total=$total");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .cart-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .col-lg-8,
        .col-lg-4 {
            padding: 20px;
        }

        .col-lg-8 {
            width: 70%;
        }

        .col-lg-4 {
            width: 30%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <h1>Cart</h1>
        </div>
        <div class="cart-container">
            <div class="row">
                <div class="col-lg-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $sn = $key + 1;
                                    $subtotal = floatval($value['Price']) * intval($value['Quantity']);
                                    // Ensure Price is treated as float and Quantity as integer
                            
                                    $total += $subtotal;
                                    echo "
                                    <tr>
                                        <td>$sn</td>
                                        <td>{$value['Item_name']}</td>
                                        <td>{$value['Price']}</td>
                                        <td>
                                            <form action='manage_cart.php' method='post'>
                                                <input class='text-center' type='number' name='Quantity' value='{$value['Quantity']}' min='1' max='10'>
                                                <input type='hidden' name='Item_name' value='{$value['Item_name']}'>
                                                <button class='btn btn-primary btn-sm' name='update_quantity'>Update</button>
                                            </form>
                                        </td>
                                        <td>$subtotal</td>
                                        <td>
                                            <form action='manage_cart.php' method='post'>
                                                <button class='btn btn-danger btn-sm' name='remove_item'>Remove</button>
                                                <input type='hidden' name='Item_name' value='{$value['Item_name']}'>
                                            </form>
                                        </td>
                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4">
    <div>
        <h3>Total:</h3>
        <h4 class="text-right"><?php echo $total; ?></h4>
        <form action="" method="post">
            <h3>Payment Method</h3><br>
            <input type="radio" name="payment_method" value="Online Payment" id="Online_payment" checked>
            <label for="cash">Online Payment</label><br><br>
            <!-- Pass $total as a hidden input field -->
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button class="btn btn-primary btn-block" type="submit" name="confirm-order">Order Now</button>
        </form>
    </div>
            </div>
        </div>
    </div>
</body>

</html>