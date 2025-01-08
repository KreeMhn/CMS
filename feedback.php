<?php
include('partials-front/nav.php');
?>


<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php
        //display food that are active
        $sql = "SELECT * FROM tbl_food ";
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
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="400" height="100">
                    </div>
                    <?php

                    }

                    ?>
                    <div style="text-align: center;"> <!-- Container to center align the rating input and submit button -->
                        <form action="process_rating.php" method="post">
                            <!-- Display food item information and rating stars -->
                            <h3><?php echo $title; ?></h3> 
                            <div class="rating">
                                <!-- Input radio buttons for rating stars -->
                                <!-- Make sure each radio button has a unique name and value -->
                                <input value="5" name="rating" id="star5_<?php echo $id; ?>" type="radio">
                                <label title="5 stars" for="star5_<?php echo $id; ?>"></label>
                                <input value="4" name="rating" id="star4_<?php echo $id; ?>" type="radio">
                                <label title="4 stars" for="star4_<?php echo $id; ?>"></label>
                                <input value="3" name="rating" id="star3_<?php echo $id; ?>" type="radio">
                                <label title="3 stars" for="star3_<?php echo $id; ?>"></label>
                                <input value="2" name="rating" id="star2_<?php echo $id; ?>" type="radio">
                                <label title="2 stars" for="star2_<?php echo $id; ?>"></label>
                                <input value="1" name="rating" id="star1_<?php echo $id; ?>" type="radio">
                                <label title="1 stars" for="star1_<?php echo $id; ?>"></label>

                                <!-- Add more radio buttons for other star ratings -->
                            </div>
                            <!-- Hidden input field to store food item name or ID -->
                            <input type="hidden" name="item_name" value="<?php echo $title; ?>"><br>
                            <!-- Submit button to submit the form -->
                            <button type="submit" class="btn-feedback">Submit Rating</button>
                        </form>
                    </div>

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
include('partials-front/footer.php');
?>
<style>
    /* Stars rating styles */
    .rating {
        display: inline-block;
        unicode-bidi: bidi-override;
        direction: rtl;
        padding: 15px 32px 15px 10px; /* 15px top, 32px right, 15px bottom, 10px left */
        margin: 4px 2px 4px 10px; /* 4px top, 2px right, 4px bottom, 10px left */
    }

    .rating > input {
        display: none;
    }

    .rating > label {
        float: right;
        color: #ccc;
        font-size: 30px;
        padding: 0;
        cursor: pointer;
    }

    .rating > label:before {
        content: '★';
    }

    .rating > input:checked ~ label,
    .rating > input:checked ~ label ~ label {
        color: #ffa723; /* Change color for filled stars */
    }

    .rating > label:hover,
    .rating > label:hover ~ label {
        color: #ff9e0b; /* Change color on hover */
    }

    .btn-feedback {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px; /* Adjust margins as needed */
        cursor: pointer;
        border-radius: 8px;
    }

    .btn-feedback:hover {
        background-color: #45a049; /* Darker green */
    }

    .btn-feedback:active {
        background-color: #3e8e41; /* Active green */
    }
</style>
