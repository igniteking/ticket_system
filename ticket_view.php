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

            <?php
            $ticket_code = $_GET['ticket_code'];
            @$type = $_GET['type'];
            if (@$type == 'b2b') {
            ?>
                <?php
                $fetch_ticket = mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE ticket_code = '$ticket_code'");
                $fetch_client = mysqli_query($conn, "SELECT * FROM client WHERE client_code = '$ticket_code'");
                while ($rows = mysqli_fetch_array($fetch_client)) {
                    $phone = $rows['phone'];
                }
                while ($row = mysqli_fetch_array($fetch_ticket)) {
                    $ticket_id = $row['id'];
                    if ($ticket_id < 10) {
                        $ticket_id = '00' . $ticket_id;
                    } else if ($ticket_id < 100) {
                        $ticket_id = '0' . $ticket_id;
                    } else {
                        $ticket_id;
                    }
                    $ticket_username = $row['ticket_username'];
                    $ticket_user_email  = $row['ticket_user_email'];
                    $ticket_quantity = $row['ticket_quantity'];
                    $ticket_name = $row['ticket_name'];
                    $ticket_check_in_date = $row['ticket_check_in_date'];
                    $product_id = $row['product_id'];
                    $discount = $row['discount'];
                    $discount_pt = $row['discount_pt'];
                    $payment_method = $row['payment_method'];
                    $created_at = $row['created_at'];
                }

                ?>


                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="">
                            <div class="">
                                <div class="home-tab">
                                    <div class="container">
                                        <div class="main-body">

                                            <div class="row gutters-sm">
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Client Name:</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center text-center">
                                                                <div class="mt-3">
                                                                    <h4><?= $ticket_username ?></h4>
                                                                    <p class="text-secondary mb-1"><?= $ticket_user_email ?></p>
                                                                    <p class="text-muted font-size-sm"><?= @$phone ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card card-body mt-3">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Bill No:</h6>
                                                                <span class="text-secondary">#<?= $ticket_id ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Date:</h6>
                                                                <span class="text-secondary"><?= $created_at ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Time:</h6>
                                                                <span class="text-secondary"><?= date('H:i') ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Cashier:</h6>
                                                                <span class="text-secondary">biller</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Payment Method:</h6>
                                                                <span class="text-secondary"><?= $payment_method ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <h5>Invoice Details:</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Item </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">Qty </h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Price </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">Discount </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">Amount </h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <?php
                                                            $productsString = $ticket_name;
                                                            $quantitiesString = $ticket_quantity;
                                                            $discount_ptString = $discount_pt;
                                                            // Split the products and quantities strings into arrays
                                                            $products = explode(",", $productsString);
                                                            $quantities = explode(",", $quantitiesString);
                                                            $discpuntpt = explode(",", $discount_ptString);

                                                            // Combine the products and quantities into an associative array
                                                            $result = array_combine($products, $quantities);

                                                            // Iterate over the array and print the product = quantity pairs
                                                            $i = 0;
                                                            $total_quantity = 0;
                                                            $totalprice = 0;
                                                            foreach ($result as $product => $quantity) {
                                                                $total_quantity += $quantity;
                                                                if ($product == "AMUSEMENT") {
                                                                    $price = "508.47";
                                                                } else if ($product == "WUNDER WATER") {
                                                                    $price = "1059.32";
                                                                } else if ($product == "COMBO") {
                                                                    $price = "1101.69";
                                                                } else if ($product == "Couple") {
                                                                    $price = "5076.27";
                                                                } else if ($product == "Family") {
                                                                    $price = "9313.56";
                                                                }
                                                                $totalprice += $price;
                                                                $total = $price * $quantity;
                                                                $gstRate = 18;
                                                                // Calculate the GST amount
                                                                $gstAmount = ($total * $gstRate) / 100;

                                                                // Calculate the total amount including GST
                                                                $totalAmount = round($total + $gstAmount, 1);

                                                                echo '
                                                                <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">' . $product . ' </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">x' . $quantity . ' </h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">₹' . $price . ' </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">' . @$discpuntpt[$i] . ' </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">₹' . $totalAmount . ' </h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                                ';

                                                                $i++;

                                                                @$newTotal += $totalAmount;
                                                            }
                                                            echo '<input type="hidden" id="total_quantity" value="' . $total_quantity . '">';
                                                            echo '<input type="hidden" id="gstAmount" value="' . $totalprice . '">';
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Total Qty: <b><span id="ttl_quantity"></span></b> </h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Sub Total: </h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"> </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0" id="gstAmount_fill"></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">CGST:</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">9%</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0"><?= round($gstAmount, 0) ?></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">SGST:</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">9%</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0"><?= round($gstAmount, 0) ?></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Grand Total</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0"><?= $newTotal ?></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <a target="_blank" href="./invoice.php?ticket_code=<?= $ticket_code ?>&&type=b2b" class="btn btn-info col-md-12">Print</a>
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
            <?php
            } else { ?>
                <?php
                $fetch_ticket = mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_code = '$ticket_code'");
                $fetch_client = mysqli_query($conn, "SELECT * FROM client WHERE client_code = '$ticket_code'");
                while ($rows = mysqli_fetch_array($fetch_client)) {
                    $phone = $rows['phone'];
                }
                while ($row = mysqli_fetch_array($fetch_ticket)) {
                    $ticket_id = $row['id'];
                    if ($ticket_id < 10) {
                        $ticket_id = '00' . $ticket_id;
                    } else if ($ticket_id < 100) {
                        $ticket_id = '0' . $ticket_id;
                    } else {
                        $ticket_id;
                    }
                    $ticket_username = $row['ticket_username'];
                    $ticket_user_email  = $row['ticket_user_email'];
                    $ticket_quantity = $row['ticket_quantity'];
                    $ticket_name = $row['ticket_name'];
                    $ticket_check_in_date = $row['ticket_check_in_date'];
                    $product_id = $row['product_id'];
                    $discount = $row['discount'];
                    $discount_pt = $row['discount_pt'];
                    $payment_method = $row['payment_method'];
                    $created_by = $row['created_by'];
                    $created_at = $row['created_at'];
                }

                ?>


                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="">
                            <div class="">
                                <div class="home-tab">
                                    <div class="container">
                                        <div class="main-body">

                                            <div class="row gutters-sm">
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Client Name:</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center text-center">
                                                                <div class="mt-3">
                                                                    <h4><?= $ticket_username ?></h4>
                                                                    <p class="text-secondary mb-1"><?= $ticket_user_email ?></p>
                                                                    <p class="text-muted font-size-sm"><?= @$phone ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card card-body mt-3">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Bill No:</h6>
                                                                <span class="text-secondary">#<?= $ticket_id ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Date:</h6>
                                                                <span class="text-secondary"><?= $created_at ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Time:</h6>
                                                                <span class="text-secondary"><?= date('H:i') ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Cashier:</h6>
                                                                <span class="text-secondary">biller</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Payment Method:</h6>
                                                                <span class="text-secondary"><?= $payment_method ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <h5>Invoice Details:</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Item </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">Qty </h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Price </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">Discount </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">Amount </h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <?php
                                                            $productsString = $ticket_name;
                                                            $quantitiesString = $ticket_quantity;
                                                            $discount_ptString = $discount_pt;
                                                            // Split the products and quantities strings into arrays
                                                            $products = explode(",", $productsString);
                                                            $quantities = explode(",", $quantitiesString);
                                                            $discpuntpt = explode(",", $discount_ptString);

                                                            // Combine the products and quantities into an associative array
                                                            $result = array_combine($products, $quantities);

                                                            // Iterate over the array and print the product = quantity pairs
                                                            $i = 0;
                                                            $total_quantity = 0;
                                                            $totalprice = 0;
                                                            foreach ($result as $product => $quantity) {
                                                                $total_quantity += $quantity;
                                                                if ($product == "AMUSEMENT") {
                                                                    $price = "508.47";
                                                                } else if ($product == "WUNDER WATER") {
                                                                    $price = "1059.32";
                                                                } else if ($product == "COMBO") {
                                                                    $price = "1101.69";
                                                                } else if ($product == "Couple") {
                                                                    $price = "5076.27";
                                                                } else if ($product == "Family") {
                                                                    $price = "9313.56";
                                                                }
                                                                $totalprice += $price;
                                                                $total = $price * $quantity;
                                                                $gstRate = 18;
                                                                // Calculate the GST amount
                                                                $gstAmount = ($total * $gstRate) / 100;

                                                                // Calculate the total amount including GST
                                                                $totalAmount = round($total + $gstAmount, 1);

                                                                echo '
                                                                <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">' . $product . ' </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">x' . $quantity . ' </h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">₹' . $price . ' </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">' . @$discpuntpt[$i] . ' </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0">₹' . $totalAmount . ' </h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                                ';

                                                                $i++;

                                                                @$newTotal += $totalAmount;
                                                            }
                                                            echo '<input type="hidden" id="total_quantity" value="' . $total_quantity . '">';
                                                            echo '<input type="hidden" id="gstAmount" value="' . $totalprice . '">';
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Total Qty: <b><span id="ttl_quantity"></span></b> </h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Sub Total: </h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"> </h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0" id="gstAmount_fill"></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">CGST:</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">9%</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0"><?= round($gstAmount, 0) ?></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">SGST:</h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">9%</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0"><?= round($gstAmount, 0) ?></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Grand Total</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"></h6>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <h6 class="mb-0"><?= $newTotal ?></h6>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <a target="_blank" href="./invoice.php?ticket_code=<?= $ticket_code ?>" class="btn btn-info col-md-12">Print</a>
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
            <?php
            } ?>

        </div>
    </div>
    <script>
        window.onload = function() {
            var total_quantity = document.getElementById("total_quantity").value;
            var gstAmount = document.getElementById("gstAmount").value;
            document.getElementById("ttl_quantity").innerText = total_quantity;
            document.getElementById("gstAmount_fill").innerText = '₹ ' + gstAmount;
        }
    </script>
    <?php include('./components/footer.php') ?>
    <?php include('./components/scripts.php') ?>