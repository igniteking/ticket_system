<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="./assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="./assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="./assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <?php
                            $register = @$_POST['register'];
                            $terms = @$_POST['terms'];
                            if ($register) {
                                if ($terms) {
                                    $user_type = "admin";
                                    $username = @$_POST['username'];
                                    $password = @$_POST['password'];
                                    $r_pswd = @$_POST['r_pswd'];
                                    $email = @$_POST['email'];
                                    $date = date("Y-m-d H:i:s");
                                    Register($user_type, $username, $password, $r_pswd, $conn, $email, $date);
                                } else {
                                    echo "<div class='error-styler'><center>
                                <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Accept Terms and Conditions!</p>
                                </center></div>";
                                }
                            }
                            ?>
                            <div class="brand-logo">
                                <img src="./assets/images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Register in to be a partof it all.</h6>
                            <form class="pt-3" method="post" action="./register.php">
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
                                <div class="mt-3">
                                    <input type="submit" value="Submit" name="register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="terms" class="form-check-input">
                                            Accept Terms and Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Already have an account? <a href="./login.php" class="text-primary">Log In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="./assets/js/off-canvas.js"></script>
    <script src="./assets/js/hoverable-collapse.js"></script>
    <script src="./assets/js/template.js"></script>
    <script src="./assets/js/settings.js"></script>
    <script src="./assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>