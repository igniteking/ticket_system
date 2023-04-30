<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('./components/navbar.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include('./components/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="home-tab">
                        <div class="content-wrapper d-flex align-items-center auth px-0">
                            <div class="row w-100 mx-0">
                                <div class="col-lg-6 mx-auto">
                                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                        <?php
                                        if (@$_GET['status'] == 1) {
                                            echo "<div class='row'><div class='col-md-12 btn btn-success mb-4 text-white'><h4 class='m-2'>Product Created Successefully!</h4></div></div>";
                                        }
                                        $register = @$_POST['register'];
                                        if ($register) {
                                            $product_name = @$_POST['product_name'];
                                            $product_price = @$_POST['product_price'];
                                            $product_description = @$_POST['product_description'];
                                            $category_id = @$_POST['category_id'];
                                            $date = date("Y-m-d H:i:s");
                                            $create_category = mysqli_query($conn, "INSERT INTO `product`(`product_id`, `product_name`, `product_descreption`,`product_price`,`category_id`, `created_at`) VALUES (NULL,'$product_name','$product_description','$product_price','$category_id','$date')");
                                            if ($create_category) {
                                                echo "<meta http-equiv=\"refresh\" content=\"0; url=./product_add.php?status=1\">";
                                            }
                                        }
                                        ?>
                                        <h4>Add Products</h4>
                                        <form class="pt-3" method="post" action="./product_add.php">
                                            <div class="form-group">
                                                <input type="text" name="product_name" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Product Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="product_price" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Product Price">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="product_description" class="form-control form-control-lg" style="height: 150px;" id="exampleInputEmail1" placeholder="Product Discription"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <select type="password" name="category_id" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                                    <option value="">Select Category</option>
                                                    <?php $get_category = mysqli_query($conn, "SELECT * FROM category");
                                                    while ($row = mysqli_fetch_array($get_category)) {
                                                        $category_id = $row['category_id'];
                                                        $category_name = $row['category_name'];
                                                        echo "<option value=" . $category_id . ">$category_name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <input type="submit" value="Submit" name="register" class="col-md-12 text-white btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
                    var ps = new PerfectScrollbar(myCustomScrollbar);

                    var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');

                    myCustomScrollbar.onscroll = function() {
                        scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
                    }
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>