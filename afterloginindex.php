<?php
include ('partials-front/nav.php');
?>

<style>
    .main-content {
        position: relative;
        background-color: #eee;
        min-height: 100vh;
        top: 0;
        left: 80px;
        transition: all 0.5s ease;
        width: calc(100% - 80px);
        padding: 1rem;
    }
</style>
<div class="main-content">



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php " method="POST">
                <input type="search" name="search" placeholder="Search For Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    // if (isset($_SESSION['order'])) {
    //     echo $_SESSION['order'];
    //     unset($_SESSION['order']);
    // }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //create sql query to display categories
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                //category available
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container" style="display: flex; width: 25%; height:35vh;  ">
                            <?php
                            //check whether the image is available or not
                            if ($image_name == "") {
                                //display msg
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //Image available
                                ?>
                                <img src="<?php SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"
                                    class="img-responsive img-curve">
                                <?php

                            }
                            ?>


                            <h3 class="float-text text-white">
                                <?php echo $title; ?>
                            </h3>
                        </div>
                    </a>

                    <?php

                }
            } else {
                //category not available
                echo "<div class='error'>Category Not Added</div>";
            }
            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //getting foods from db that are active and featured
            //sql query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //execute query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res);
            //check whether the food is available or not
            if ($count2 > 0) {
                //food available
                while ($row = mysqli_fetch_assoc($res2)) {
                    //get all the values
            
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $imgae_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">

                            <?php
                            //check whether the image is available or not
                            if ($imgae_name == "") {
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                            } else {
                                //image available
                                ?>

                                <img src="<?php echo SITEURL ?>images/food/<?php echo $imgae_name; ?>" alt="Chicke Hawain Pizza"
                                    class="img-responsive img-curve">
                                <?php
                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                            <form action="manage_cart.php" method="post">
                                <h4>
                                    <?php echo $title; ?>
                                </h4>
                                <p class="food-price">Rs.
                                    <?php echo $price; ?>
                                </p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <button name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                <input type="hidden" name="Item_name" value="<?php echo $title ?>">
                                <input type="hidden" name="Price" value="<?php echo $price ?>">

                            </form>
                        </div>
                    </div>


                    <?php
                }
            } else {
                //food not available
                echo "<div class='error'>Food Not Available</div>";
            }
            ?>





            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php
    include ('partials-front/footer.php');
    ?>
</div>
<style>
    /* CSS for All */
    * {
        margin: 0 0;
        padding: 0 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 1%;
    }

    .img-responsive {
        width: 100%;
    }

    .img-curve {
        border-radius: 15px;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-white {
        color: white;
    }



    .clearfix {
        clear: both;
        float: none;
    }

    a {
        color: #ff6b81;
        text-decoration: none;
    }

    a:hover {
        color: #ff4757;
    }

    .btn {
        padding: 1%;
        border: none;
        font-size: 1rem;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #ff6b81;
        color: white;
        cursor: pointer;
    }

    .btn-primary:hover {
        color: white;
        background-color: #ff4757;
    }

    h2 {
        color: #2f3542;
        font-size: 2rem;
        margin-bottom: 2%;
    }

    h3 {
        font-size: 1.5rem;
    }

    .float-container {
        position: relative;
    }

    .float-text {
        position: absolute;
        bottom: 50px;
        left: 40%;
    }

    fieldset {
        border: 1px solid white;
        margin: 5%;
        padding: 3%;
        border-radius: 5px;
    }

    .error {
        padding: 2%;
        color: red;
    }

    .success {
        padding: 2%;
        color: green;
    }




    /* CSS for Food SEarch Section */


    /* background-image: url(../images/bg.jpg); */
    /* background-size: cover; */
    /* background-repeat: no-repeat;
    background-position: center; */
    /* padding: 7% 0; */



    .food-search input[type="search"] {
        width: 50%;
        padding: 1%;
        font-size: 1rem;
        border: 1px solid black;
        border-radius: 5px;
    }



    /* CSS for Categories */
    .categories {
        padding: 4% 0;
    }



    .box-3 {
        width: 28%;
        float: left;
        margin: 2%;
    }


    /* CSS for Food Menu */
    .food-menu {
        background-color: #ececec;
        padding: 4% 0;
    }

    .food-menu-box {
        width: 43%;
        margin: 1%;
        padding: 2%;
        float: left;
        background-color: white;
        border-radius: 15px;
    }

    .food-menu-img {
        width: 20%;
        float: left;
    }

    .food-menu-desc {
        width: 70%;
        float: left;
        margin-left: 8%;
    }

    .food-price {
        font-size: 1.2rem;
        margin: 2% 0;
    }

    .food-detail {
        font-size: 1rem;
        color: #747d8c;
    }


    /* CSS for Social */
    .social ul {
        list-style-type: none;
    }

    .social ul li {
        display: inline;
        padding: 1%;
    }

    /* for Order Section */
    .order {
        width: 50%;
        margin: 0 auto;
        border: 1px solid black;
    }

    .input-responsive {
        width: 96%;
        padding: 1%;
        margin-bottom: 3%;
        border: 1px solid black;
        border-radius: 5px;
        font-size: 1rem;
    }

    .order-label {
        margin-bottom: 1%;
        font-weight: bold;
        /* border: 1px solid black; */
    }



    /* CSS for Mobile Size or Smaller Screen */

    @media only screen and (max-width:768px) {
        .logo {
            width: 80%;
            float: none;
            margin: 1% auto;
        }

        .menu ul {
            text-align: center;
        }

        .food-search input[type="search"] {
            width: 90%;
            padding: 2%;
            margin-bottom: 3%;
        }

        .btn {
            width: 91%;
            padding: 2%;
        }

        .food-search {
            padding: 10% 0;
        }

        .categories {
            padding: 20% 0;
        }

        h2 {
            margin-bottom: 10%;
        }

        .box-3 {
            width: 100%;
            margin: 4% auto;
        }

        .food-menu {
            padding: 20% 0;
        }

        .food-menu-box {
            width: 90%;
            padding: 5%;
            margin-bottom: 5%;
        }

        .social {
            padding: 5% 0;
        }

        .order {
            width: 100%;
        }
    }
</style>