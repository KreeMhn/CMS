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
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<section class="food-search">
    <div class="container">



        <form class="order" method="post">
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
        </form>
        <div class="food-menu-desc">
            <form action="manage_cart.php" method="post">
                <h3><?php echo $title; ?></h3>
                <input type="hidden" name="food" value="<?php echo $title; ?>">

                <p class="food-price">Rs.<?php echo $price; ?></p>
                <input type="hidden" name="price" value="<?php echo $price; ?>">

                <div class="order-label">Quantity</div>
                <input type="number" name="qty" class="input-responsive" value="1" required>

        </div>
        <input type="submit" name="add_to_cart" value="Confirm Order" class="btn btn-primary">
        <input type="hidden" name="Item_name" value="<?php echo $title ?>">
        <input type="hidden" name="Price" value="<?php echo $price ?>">
        <input type="hidden" name="Quantity" value="<?php echo $quantity ?>">
        </form>
        </fieldset>



        <?php
        include ('partials-front/footer.php');
        ?>