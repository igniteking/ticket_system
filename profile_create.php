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
                                            echo "<div class='row'><div class='col-md-12 btn btn-success mb-4 text-white'><h4 class='m-2'>You can now login to this account!</h4></div></div>";
                                        }
                                        $register = @$_POST['register'];
                                        $terms = @$_POST['terms'];
                                        if ($register) {
                                            $user_type = @$_POST['user_type'];
                                            $username = @$_POST['username'];
                                            $password = @$_POST['password'];
                                            $r_pswd = @$_POST['r_pswd'];
                                            $email = @$_POST['email'];
                                            $date = date("Y-m-d H:i:s");
                                            Register($user_type, $username, $password, $r_pswd, $conn, $email, $date);
                                        }
                                        ?>
                                        <h4>Create Admin</h4>
                                        <form class="pt-3" method="post" action="./profile_create.php">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="r_pswd" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Retype -Password">
                                            </div>
                                            <div class="form-group">
                                                <select name="user_type" class="form-control form-control-lg" id="exampleInputPassword1">
                                                    <option value="admin">Cashier</option>
                                                    <option value="food_stall">Food Stall</option>
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