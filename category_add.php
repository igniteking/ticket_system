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
                                            echo "<div class='row'><div class='col-md-12 btn btn-success mb-4 text-white'><h4 class='m-2'>Created Successfully!</h4></div></div>";
                                        }
                                        $register = @$_POST['register'];
                                        if ($register) {
                                            $category_name = @$_POST['category_name'];
                                            $category_description = @$_POST['category_description'];
                                            $date = date("Y-m-d H:i:s");
                                            $create_category = mysqli_query($conn, "INSERT INTO `category`(`category_id`, `category_name`, `category_description`, `created_at`) VALUES (NULL,'$category_name','$category_description','$date')");
                                            if ($create_category) {
                                                echo "<meta http-equiv=\"refresh\" content=\"0; url=./category_add.php?status=1\">";
                                            }
                                        }
                                        ?>
                                        <h4>Add Products Category</h4>
                                        <form class="pt-3" method="POST" action="./category_add.php">
                                            <div class="form-group">
                                                <input type="text" name="category_name" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Category Name">
                                            </div>
                                            <div class="form-group">
                                                <textarea type="text" name="category_description" class="form-control form-control-lg" style="height: 150px;" id="exampleInputEmail1" placeholder="Category Discription"></textarea>
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