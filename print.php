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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div id="ticket" class="col-12 col-lg-12 col-lg-12 grid-margin stretch-card">
                                                        <div class="card">
                                                            <div class="card-body mx-4">
                                                                <div class="container">
                                                                    <?php
                                                                    $ticket_code = $_GET['ticket_code'];
                                                                    $fetch_ticket = mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_code = '$ticket_code'");
                                                                    $fetch_client = mysqli_query($conn, "SELECT * FROM client WHERE client_code = '$ticket_code'");
                                                                    while ($rows = mysqli_fetch_array($fetch_client)) {
                                                                        $phone = $rows['phone'];
                                                                    }
                                                                    while ($row = mysqli_fetch_array($fetch_ticket)) {
                                                                        $ticket_username = $row['ticket_username'];
                                                                        $ticket_user_email  = $row['ticket_user_email'];
                                                                        $ticket_quantity = $row['ticket_quantity'];
                                                                        $ticket_check_in_date = $row['ticket_check_in_date'];
                                                                        $product_id = $row['product_id'];
                                                                        $product_status = $row['product_status'];
                                                                        $created_at = $row['created_at'];
                                                                    }
                                                                    ?>
                                                                    <div class="row">
                                                                        <ul class="list-unstyled row">
                                                                            <li class="text-muted mt-1 col-md-6"><span class="text-black">Invoice</span> #<z id="bill_invoice"></z>
                                                                            </li>
                                                                            <li id="bill_username" class="text-black col-md-6"><?= $ticket_username ?></li>
                                                                            <li id="bill_email" class="text-black col-md-6"><?= $ticket_user_email ?></li>
                                                                            <li id="bill_mobile" class="text-black col-md-6"><?= $phone ?></li>
                                                                            <li id="bill_date" class="text-black mt-1 col-md-6"><?= date("Y-m-d H:i:s") ?></li>
                                                                        </ul>
                                                                        <hr>
                                                                        <div class="col-xl-10">
                                                                            <p id="package_name">Package Name</p>
                                                                        </div>
                                                                        <div class="col-xl-2">
                                                                            <p class="float-end">₹ <z id="package_price">00.00</z>
                                                                            </p>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-10">
                                                                            <p>Quantity</p>
                                                                        </div>
                                                                        <div class="col-xl-2">
                                                                            <p class="float-end" id="bill_quantity">00
                                                                            </p>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div id="bill_prod" class="row"></div>
                                                                    <div class="row">
                                                                        <div class="col-xl-10">
                                                                            <p>Products Total</p>
                                                                        </div>
                                                                        <div class="col-xl-2">
                                                                            <p class="float-end" id="product_total"></p>
                                                                        </div>
                                                                        <hr style="border: 2px solid black;">
                                                                        <div class="row text-black">
                                                                            <div class="col-xl-12">
                                                                                <p class="float-end fw-bold">Total: ₹<z id="bill_total">00.00</z>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <hr style="border: 2px solid black;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button onclick="printDiv('ticket')" class="btn btn-info">Print</button>
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
                    function printDiv(divName) {
                        var printContents = document.getElementById(divName).innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                        document.body.innerHTML = originalContents;
                    }
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>