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
                    <div class="">
                        <div class="">
                            <div class="home-tab">
                                <div class="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="./b2b.php" style="all: unset;">
                                                    <div class="card-body">
                                                        <div class="col-lg-12 grid-margin stretch-card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title text-center">B2B For Punjab</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="./b2b_other.php" style="all: unset;">
                                                    <div class="card-body">
                                                        <div class="col-lg-12 grid-margin stretch-card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title text-center">B2B For Other States</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
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
        <?php include('./components/footer.php') ?>
        <?php include('./components/scripts.php') ?>