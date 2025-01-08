<?php

include ('partials-front/nav.php');

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php
        //display food that are active
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        //check whether the foods are available or not
        if ($count > 0) {
            //food available
            while ($row = mysqli_fetch_assoc($res)) {
                //get the values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //check whether image is available or not
                        if ($image_name == "") {
                            //image not available
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                                class="img-responsive img-curve">
                        </div>
                        <?php

                        }

                        ?>

                    <form action="manage_cart.php" method="post">
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <button type="submit" name="add_to_cart" class="btn btn-primary">Add To Cart</button>

                            <input type="hidden" name="Item_name" value="<?php echo $title ?>">
                            <input type="hidden" name="Price" value="<?php echo $price ?>">
                        </div>
                    </form>
                </div>
                <?php
            }

        } else {
            //food not available
            echo "<div class='error'>Food not available.</div>";
        }
        ?>





        <div class="clearfix"></div>



    </div>

</section>

<!-- fOOD Menu Section Ends Here -->
<?php
include ('partials-front/footer.php');
?>