<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>

<?php
$userdata = mysqli_query($conn, "SELECT * FROM user_data WHERE email = '$email'");
while ($row = mysqli_fetch_array($userdata)) {
    $usenrame = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $website = $row['website'];
    $twitter = $row['twitter'];
    $github = $row['github'];
    $instagram = $row['instagram'];
    $facebook = $row['facebook'];
}
?>

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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="">
                                            <div class="main-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex flex-column align-items-center text-center">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1" width="110">
                                                                    <div class="mt-3">
                                                                        <h4><?= $username ?></h4>
                                                                        <p class="text-secondary mb-1"><?= $email ?></p>
                                                                        <button class="btn btn-primary text-white">Upload Picture</button>
                                                                        <button class="btn btn-outline-danger">Remove Picture</button>
                                                                    </div>
                                                                </div>
                                                                <hr class="my-4">
                                                                <div id="notification"></div>
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline">
                                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                                                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                                                            </svg>Website</h6>
                                                                        <span class="text-secondary"><input type="text" class="form-control" value="<?= $website; ?>" onblur="Website(this.value)" name="website" id="website"></span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline">
                                                                                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                                                            </svg>Github</h6>
                                                                        <span class="text-secondary"><input type="text" class="form-control" value="<?= $github; ?>" onblur="Github(this.value)" name="github" id="github"></span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info">
                                                                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                                                            </svg>Twitter</h6>
                                                                        <span class="text-secondary"><input type="text" class="form-control" value="<?= $twitter; ?>" onblur="Twitter(this.value)" name="twitter" id="twitter"></span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
                                                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                                                            </svg>Instagram</h6>
                                                                        <span class="text-secondary"><input type="text" class="form-control" value="<?= $instagram; ?>" onblur="Instagram(this.value)" name="instagram" id="instagram"></span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
                                                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                                            </svg>Facebook</h6>
                                                                        <span class="text-secondary"><input type="text" class="form-control" value="<?= $facebook; ?>" onblur="Facebook(this.value)" name="facebook" id="facebook"></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <?php
                                                                if (@$_POST['save']) {
                                                                    $username1 = $_POST['username'];
                                                                    $phone1 = $_POST['phone'];
                                                                    $profile = mysqli_query($conn, "UPDATE `user_data` SET `username`='$username1', `phone`='$phone1' WHERE email = '$email'");
                                                                    if ($profile) {
                                                                        echo '<div class="col-md-12 btn btn-success text-white">
                                                                                <h6 class="mt-2">Updated!</h6>
                                                                            </div>';
                                                                        echo "<meta http-equiv=\"refresh\" content=\"0; url=./profile.php\">";
                                                                    } else {
                                                                        echo '<div class="col-md-12 btn btn-danger text-white">
                                                                                <h6 class="mt-2">Error!</h6>
                                                                            </div>';
                                                                        echo "<meta http-equiv=\"refresh\" content=\"0; url=./profile.php\">";
                                                                    }
                                                                }
                                                                ?>
                                                                <form action="./profile.php" method="post">
                                                                    <div class="row mb-3">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Full Name</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="text" class="form-control" name="username" value="<?= $username ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Email</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="text" class="form-control" disabled value="<?= $email ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Phone</h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="text" class="form-control" name="phone" value="<?= $phone ? $phone : '+91-' ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-3"></div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input type="submit" class="btn btn-primary px-4 text-white" name="save" value="Save Changes">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                                                                        <p>Web Design</p>
                                                                        <div class="progress mb-3" style="height: 5px">
                                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <p>Website Markup</p>
                                                                        <div class="progress mb-3" style="height: 5px">
                                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <p>One Page</p>
                                                                        <div class="progress mb-3" style="height: 5px">
                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <p>Mobile Template</p>
                                                                        <div class="progress mb-3" style="height: 5px">
                                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <p>Backend API</p>
                                                                        <div class="progress" style="height: 5px">
                                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


                    function Website(str) {
                        if (str.length == 0) {
                            document.getElementById("notification").innerHTML = "";
                            return;
                        } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("notification").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "./helpers/ajax.php?website=" + str, true);
                            xmlhttp.send();
                        }
                    }

                    function Twitter(str) {
                        if (str.length == 0) {
                            document.getElementById("notification").innerHTML = "";
                            return;
                        } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("notification").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "./helpers/ajax.php?twitter=" + str, true);
                            xmlhttp.send();
                        }
                    }

                    function Instagram(str) {
                        if (str.length == 0) {
                            document.getElementById("notification").innerHTML = "";
                            return;
                        } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("notification").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "./helpers/ajax.php?instagram=" + str, true);
                            xmlhttp.send();
                        }
                    }

                    function Facebook(str) {
                        if (str.length == 0) {
                            document.getElementById("notification").innerHTML = "";
                            return;
                        } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("notification").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "./helpers/ajax.php?facebook=" + str, true);
                            xmlhttp.send();
                        }
                    }

                    function Github(str) {
                        if (str.length == 0) {
                            document.getElementById("notification").innerHTML = "";
                            return;
                        } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("notification").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "./helpers/ajax.php?github=" + str, true);
                            xmlhttp.send();
                        }
                    }
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>