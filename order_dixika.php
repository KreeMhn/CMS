<?php
include ('partials-front/nav.php');


//check whether the food id is set or not
if (isset($_GET['food_id'])) {
    //get the food id and details of the selected food
    $food_id = $_GET['food_id'];

    //get the details of selected food
    $sql = "SELECT * FROM  tbl_food WHERE id=$food_id";

    //execute the query
    $res = mysqli_query($conn, $sql);
    //count the rows
    $count = mysqli_num_rows($res);
    //check whether the data is available or not
    if ($count == 1) {
        //we have data
        //get the data from db
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //food not available
        //redirect to homepage
        header('location:' . SITEURL);
    }
} else {
    //redirect to homepage
    header('location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-red">Fill this form to confirm your order.</h2>

        <form action="" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    //check whether the image is available or not
                    if ($image_name == "") {
                        //image not available
                        echo "<div class='error'>Image not available</div>";
                    } else {
                        //image available
                        ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                        class="img-responsive img-curve">

                    <?php
                    }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">Rs.<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Ram kumar" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. ram@ram123.com" class="input-responsive" required>

                <!-- <div class="order-label">Role</div>
                Teacher <input type="radio" name="teacher">&nbsp; &nbsp;
                Student <input type="radio" name="student"> -->
                <br>
                <br>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {


            // Check if the user is logged in
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
            //get all the details from the form
            // echo "clicked";
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; //total= price x qty
        
            $order_date = date("Y-m-d h:i:sa"); //order date
        
            $status = "Ordered"; //ordered, on delivery , delivered, cancelled
        
            $customer_name = $_POST['full-name'];

            $customer_contact = $_POST['contact'];

            $customer_email = $_POST['email'];

            //    $role1=$_POST['teacher'];
        
            //    $role2=$_POST['student'];
        
            //insert into orders table
            //create sql query
            $sql2 = "INSERT INTO tbl_order SET
                food='$food',
                price=$price,
                qty=$qty,
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
        }


        ?>


    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
include ('partials-front/footer.php');
?>