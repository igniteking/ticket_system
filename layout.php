<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total Admin</p>
                                                        <center>
                                                            <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `user_data` WHERE `user_type` = 'admin'"))); ?></h3>
                                                        </center>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Tickets</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                $z = 0;
                                                                $get_all_tickets = mysqli_query($conn, "SELECT * FROM ticket");
                                                                while ($row = mysqli_fetch_array($get_all_tickets)) {
                                                                    $ticket_quantity = ($row["ticket_quantity"]);
                                                                    $ticket_name = ($row["ticket_name"]);
                                                                    $z += (array_sum($ticket_quantity = explode(',', $ticket_quantity)));
                                                                }
                                                                echo $z;
                                                                ?></h3>
                                                        </center>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Number Of Users</p>
                                                        <center>
                                                            <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `client`"))); ?></h3>
                                                        </center>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Yearly Membership – Couple</p>
                                                        <center>
                                                            <h3 class="rate-percentage"><?php echo $AMUSEMENT = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%Couple%'")); ?></h3>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">AMUSEMENT PARK</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                echo $AMUSEMENT = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%AMUSEMENT%'"));
                                                                ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">WUNDER WATER</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                echo $WUNDER = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%WUNDER%'"));
                                                                ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">AMUSEMENT PARK + WUNDER WATER</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                echo $get_all_tickets_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%COMBO%'"));
                                                                ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Yearly Membership – Family</p>
                                                        <center>
                                                            <h3 class="rate-percentage"><?php
                                                                                        echo $get_all_tickets_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%Family%'"));
                                                                                        ?></h3>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 card card-body">
                                                <form action="./layout.php" class="form row" method="get">
                                                    <select name="payment_type" class="form-control m-3" style="width: 50%;" id="">
                                                        <option value="All">All</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Card">Card</option>
                                                        <option value="Phonepe">Phonepe</option>
                                                        <option value="NEFT/RTGS">NEFT/RTGS</option>
                                                        <option value="Shoutlo">Shoutlo</option>
                                                        <option value="Razorpay">Razorpay</option>
                                                    </select>
                                                    <input type="submit" value="search" class="m-3 col-5 btn btn-outline-primary">
                                                </form>
                                                <div class="statistics-details p-2 d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Today</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                $payment_type = @$_GET['payment_type'];
                                                                $today = date('Y-m-d');
                                                                if ($payment_type == 'All') {
                                                                    $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at LIKE '$today'"));
                                                                    $day_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at LIKE '$today'");
                                                                } else {
                                                                    $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at LIKE '$today'"));
                                                                    $day_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at LIKE '$today'");
                                                                }
                                                                if ($count > 0) {
                                                                    while ($day_row = mysqli_fetch_array($day_fetch_data)) {
                                                                        $day_ticket_quantity = $day_row['ticket_quantity'];
                                                                        $day_ticket_name = $day_row['ticket_name'];
                                                                        $day_productsString = $day_ticket_name;
                                                                        $day_quantitiesString = $day_ticket_quantity;
                                                                        // Split the products and quantities strings into arrays
                                                                        $day_products = explode(",", $day_productsString);
                                                                        $day_quantities = explode(",", $day_quantitiesString);

                                                                        // Combine the products and quantities into an associative array
                                                                        $day_result = array_combine($day_products, $day_quantities);

                                                                        // Iterate over the array and print the product = quantity pairs
                                                                        $day_i = 0;
                                                                        $day_total_quantity = 0;
                                                                        $day_price = 0;
                                                                        foreach ($day_result as $day_product => $day_quantity) {
                                                                            if ($day_product == "AMUSEMENT") {
                                                                                $day_price = 600;
                                                                            } else if ($day_product == "WUNDER WATER") {
                                                                                $day_price = 1250;
                                                                            } else if ($day_product == "COMBO") {
                                                                                $day_price = 1300;
                                                                            } else if ($day_product == "COUPLE") {
                                                                                $day_price = 5990;
                                                                            } else if ($day_product == "FAMILY") {
                                                                                $day_price = 10990;
                                                                            }
                                                                            @$day_totalprice += $day_price;
                                                                        }
                                                                    }
                                                                    echo $day_totalprice . ' INR';
                                                                } else {
                                                                    echo "0 INR";
                                                                } ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Weekly</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                $payment_type = @$_GET['payment_type'];
                                                                $today = new DateTime(); // Get the current date and time
                                                                $interval = new DateInterval('P6D'); // Create an interval of 6 days
                                                                $today->sub($interval); // Subtract the interval to get the date 6 days before

                                                                $sixDaysAgo = $today->format('Y-m-d'); // Format the date as 'YYYY-MM-DD'

                                                                $date_from = $sixDaysAgo;
                                                                $date_to = date('Y-m-d');
                                                                if ($payment_type == 'All') {
                                                                    $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'"));
                                                                    $week_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'");
                                                                } else {
                                                                    $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                                                                    $week_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'");
                                                                }
                                                                if ($count > 0) {
                                                                    while ($week_row = mysqli_fetch_array($week_fetch_data)) {
                                                                        $week_ticket_quantity = $week_row['ticket_quantity'];
                                                                        $week_ticket_name = $week_row['ticket_name'];
                                                                        $week_productsString = $week_ticket_name;
                                                                        $week_quantitiesString = $week_ticket_quantity;
                                                                        // Split the products and quantities strings into arrays
                                                                        $week_products = explode(",", $week_productsString);
                                                                        $week_quantities = explode(",", $week_quantitiesString);

                                                                        // Combine the products and quantities into an associative array
                                                                        $week_result = array_combine($week_products, $week_quantities);

                                                                        // Iterate over the array and print the product = quantity pairs
                                                                        $week_i = 0;
                                                                        $week_total_quantity = 0;
                                                                        $week_price = 0;
                                                                        foreach ($week_result as $week_product => $week_quantity) {
                                                                            if ($week_product == "AMUSEMENT") {
                                                                                $week_price = 600;
                                                                            } else if ($week_product == "WUNDER WATER") {
                                                                                $week_price = 1250;
                                                                            } else if ($week_product == "COMBO") {
                                                                                $week_price = 1300;
                                                                            } else if ($week_product == "COUPLE") {
                                                                                $week_price = 5990;
                                                                            } else if ($week_product == "FAMILY") {
                                                                                $week_price = 10990;
                                                                            }
                                                                            @$week_totalprice += $week_price;
                                                                        }
                                                                    }
                                                                    echo $week_totalprice . ' INR';
                                                                } else {
                                                                    echo "0 INR";
                                                                } ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Monthly</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                $payment_type = @$_GET['payment_type'];
                                                                $month_date_from = date('Y-m-01'); // First day of the current month
                                                                $month_date_to = date('Y-m-t'); // Last day of the current month
                                                                if ($payment_type == 'All') {
                                                                    $month_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$month_date_from' AND '$month_date_to'"));
                                                                    $month_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$month_date_from' AND '$month_date_to'");
                                                                } else {
                                                                    $month_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$month_date_from' AND '$month_date_to'"));
                                                                    $month_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$month_date_from' AND '$month_date_to'");
                                                                }
                                                                if ($month_count > 0) {
                                                                    while ($month_row = mysqli_fetch_array($month_fetch_data)) {
                                                                        $month_ticket_quantity = $month_row['ticket_quantity'];
                                                                        $month_ticket_name = $month_row['ticket_name'];
                                                                        $month_productsString = $month_ticket_name;
                                                                        $month_quantitiesString = $month_ticket_quantity;
                                                                        // Split the products and quantities strings into arrays
                                                                        $month_products = explode(",", $month_productsString);
                                                                        $month_quantities = explode(",", $month_quantitiesString);

                                                                        // Combine the products and quantities into an associative array
                                                                        $month_result = array_combine($month_products, $month_quantities);

                                                                        // Iterate over the array and print the product = quantity pairs
                                                                        $month_i = 0;
                                                                        $month_total_quantity = 0;
                                                                        $month_price = 0;
                                                                        foreach ($month_result as $month_product => $month_quantity) {
                                                                            if ($month_product == "AMUSEMENT") {
                                                                                $month_price = 600;
                                                                            } else if ($month_product == "WUNDER WATER") {
                                                                                $month_price = 1250;
                                                                            } else if ($month_product == "COMBO") {
                                                                                $month_price = 1300;
                                                                            } else if ($month_product == "COUPLE") {
                                                                                $month_price = 5990;
                                                                            } else if ($month_product == "FAMILY") {
                                                                                $month_price = 10990;
                                                                            }
                                                                            @$month_totalprice += $month_price;
                                                                        }
                                                                    }
                                                                    echo $month_totalprice . ' INR';
                                                                } else {
                                                                    echo "0 INR";
                                                                }  ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Yearly</p>
                                                        <center>
                                                            <h3 class="rate-percentage">
                                                                <?php
                                                                $year_payment_type = @$_GET['payment_type'];
                                                                $year_date_from = date('Y-01-01'); // First day of the current year
                                                                $year_date_to = date('Y-12-31'); // Last day of the current year
                                                                if ($year_payment_type == 'All') {
                                                                    $year_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$year_date_from' AND '$year_date_to'"));
                                                                    $year_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$year_date_from' AND '$year_date_to'");
                                                                } else {
                                                                    $year_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$year_payment_type' AND created_at BETWEEN '$year_date_from' AND '$year_date_to'"));
                                                                    $year_fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$year_payment_type' AND created_at BETWEEN '$year_date_from' AND '$year_date_to'");
                                                                }
                                                                if ($year_count > 0) {
                                                                    while ($year_row = mysqli_fetch_array($year_fetch_data)) {
                                                                        $year_ticket_quantity = $year_row['ticket_quantity'];
                                                                        $year_ticket_name = $year_row['ticket_name'];
                                                                        $year_productsString = $year_ticket_name;
                                                                        $year_quantitiesString = $year_ticket_quantity;
                                                                        // Split the products and quantities strings into arrays
                                                                        $year_products = explode(",", $year_productsString);
                                                                        $year_quantities = explode(",", $year_quantitiesString);

                                                                        // Combine the products and quantities into an associative array
                                                                        $year_result = array_combine($year_products, $year_quantities);

                                                                        // Iterate over the array and print the product = quantity pairs
                                                                        $year_i = 0;
                                                                        $year_total_quantity = 0;
                                                                        $year_price = 0;
                                                                        foreach ($year_result as $year_product => $year_quantity) {
                                                                            if ($year_product == "AMUSEMENT") {
                                                                                $year_price = 600;
                                                                            } else if ($year_product == "WUNDER WATER") {
                                                                                $year_price = 1250;
                                                                            } else if ($year_product == "COMBO") {
                                                                                $year_price = 1300;
                                                                            } else if ($year_product == "COUPLE") {
                                                                                $year_price = 5990;
                                                                            } else if ($year_product == "FAMILY") {
                                                                                $year_price = 10990;
                                                                            }
                                                                            @$year_totalprice += $year_price;
                                                                        }
                                                                    }
                                                                    echo $year_totalprice . ' INR';
                                                                } else {
                                                                    echo "0 INR";
                                                                }
                                                                ?>
                                                            </h3>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Sales Line Chart</h4>
                                                            </div>
                                                            <div id="performance-line-legend"></div>
                                                        </div>
                                                        <div class="chartjs-wrapper mt-5">
                                                            <canvas id="performaneLine"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 grid-margin stretch-card">
                                        <div class="card card-rounded table-darkBGImg">
                                            <div class="card-body">
                                                <div class="col-sm-8">
                                                    <h3 class="text-white upgrade-info mb-0">
                                                        Click Here <br><span class="fw-bold">To Create</span><br> New Tickets!
                                                    </h3>
                                                    <a href="./index.php" class="btn btn-info upgrade-btn">Create Ticket!</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <ul class="nav nav-tabs" role="tablist">
                                                                        <li class="nav-item">
                                                                            <button class="nav-link ps-0" data-toggle="tooltip" data-placement="top" title="Filter Today's Data" id="taday" onclick="fetch_data('today')">Today</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link" id="weekly" onclick="fetch_data('weekly')">Weekly</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link" id="monthly" onclick="fetch_data('monthly')">Monthly</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link" id="yearly" onclick="fetch_data('yearly')">Yearly</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link border-0" id="lifetime" onclick="fetch_data('lifetime')">Life Time</button>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="nav nav-tabs" role="tablist">
                                                                        <li class="nav-item">
                                                                            <button class="nav-link ps-0" id="Cash" onclick="fetch_data('Cash')">Cash</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link" id="Card" onclick="fetch_data('Card')">Card</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link" id="Phonepe" onclick="fetch_data('Phonepe')">Phonepe</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link border-0" id="NEFT/RTGS" onclick="fetch_data('NEFT/RTGS')">NEFT/RTGS</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link" id="Shoutlo" onclick="fetch_data('Shoutlo')">Shoutlo</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button class="nav-link border-0" id="Razorpay" onclick="fetch_data('Razorpay')">Razorpay</button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-3 d-flex justify-content-end d-flex justify-content-end">
                                                                    <select name="ticket_type" id="ticket_type" class="form-control form-control-lg">
                                                                        <option value="ALL" selected>ALL</option>
                                                                        <option value="AMUSEMENT">AMUSEMENT PARK</option>
                                                                        <option value="WUNDER WATER">WUNDER WATER</option>
                                                                        <option value="COMBO">COMBO – AMUSEMENT PARK + WATER PARK</option>
                                                                        <option value="COUPLE">Yearly Membership – Couple</option>
                                                                        <option value="FAMILY">Yearly Membership – Family</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 row d-flex justify-content-end">
                                                                    <input type="date" class="form-control d-flex justify-content-end" id="date_from" name="from">
                                                                    <input type="date" class="form-control d-flex justify-content-end mb-2" max="<?= date('Y-m-d'); ?>" id="date_to" name="to">
                                                                </div>
                                                                <div class="btn-wrapper col-md-2">
                                                                    <button onclick="printReport()" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</button>
                                                                    <button onclick="onSubmitButton()" class="btn btn-primary text-white me-0"> Submit</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 row">
                                                                <div id="notification">
                                                                    <form method='post' action='./vendor/export_csv.php'>
                                                                        <input type='submit' class="btn btn-warning col-md-12" value='Export as .CSV' name='export_data'>
                                                                        <?php
                                                                        $fetch_data_index = mysqli_query($conn, "SELECT * FROM ticket");
                                                                        $count_index = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket"));
                                                                        $new_fina_wala_price = 0;
                                                                        if ($count_index == 0) {
                                                                            echo '<div class="col-md-12 btn btn-danger text-white">
                                                                                    <h6 class="mt-2">No Record Found!</h6>
                                                                                    </div>
                                                                                    </div>';
                                                                        } else if ($fetch_data_index) {
                                                                            echo '
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Ticket Id</th>
                                                                                            <th>Name</th>
                                                                                            <th>Email</th>
                                                                                            <th>QTY</th>
                                                                                            <th>Type</th>
                                                                                            <th>CheckIn Date</th>
                                                                                            <th>Discount</th>
                                                                                            <th>Discount/ticket</th>
                                                                                            <th>Total Price</th>
                                                                                            <th>GST (9%)</th>
                                                                                            <th>Method</th>
                                                                                            <th>Ticket Status</th>
                                                                                            <th>Date</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>';
                                                                            $i = 0;
                                                                            $j = 0;
                                                                            while ($rows = mysqli_fetch_array($fetch_data_index)) {
                                                                                $index_ticket_id = $rows['id'];
                                                                                $index_ticket_gst = $rows['gst'];
                                                                                $gst_array[$j] = $index_ticket_gst;
                                                                                $index_ticket_username = $rows['ticket_username'];
                                                                                $index_ticket_user_email = $rows['ticket_user_email'];
                                                                                $index_ticket_quantity = $rows['ticket_quantity'];
                                                                                $index_ticket_name = $rows['ticket_name'];
                                                                                $index_ticket_check_in_date = $rows['ticket_check_in_date'];
                                                                                $index_ticket_user_email = $rows['ticket_user_email'];
                                                                                $index_discount = $rows['discount'];
                                                                                $index_discount_pt = $rows['discount_pt'];
                                                                                $index_payment_method = $rows['payment_method'];
                                                                                $index_cancel_ticket = $rows['cancel_ticket'];
                                                                                $index_created_at = $rows['created_at'];
                                                                                $index_productsString = $index_ticket_name;
                                                                                $index_quantitiesString = $index_ticket_quantity;
                                                                                $index_discount_ptString = $index_discount_pt;
                                                                                // Split the products and quantities strings into arrays
                                                                                $index_products = explode(",", $index_productsString);
                                                                                $index_quantities = explode(",", $index_quantitiesString);
                                                                                $index_discpuntpt = explode(",", $index_discount_ptString);

                                                                                // Combine the products and quantities into an associative array
                                                                                $index_result = array_combine($index_products, $index_quantities);

                                                                                // Iterate over the array and print the product = quantity pairs
                                                                                $index_i = 0;
                                                                                $index_total_quantity = 0;
                                                                                $index_totalprice = 0;
                                                                                foreach ($index_result as $index_product => $index_quantity) {
                                                                                    if ($index_product == "AMUSEMENT") {
                                                                                        $index_price = "600";
                                                                                    } else if ($index_product == "WUNDER WATER") {
                                                                                        $index_price = "1250";
                                                                                    } else if ($index_product == "COMBO") {
                                                                                        $index_price = "1300";
                                                                                    } else if ($index_product == "COUPLE") {
                                                                                        $index_price = "5990";
                                                                                    } else if ($index_product == "FAMILY") {
                                                                                        $index_price = "10990";
                                                                                    }
                                                                                    $index_totalprice += $index_price;
                                                                                }
                                                                                ($array[$i] = $index_totalprice);
                                                                                $gstgst = (array_sum($gst_array));
                                                                                $i++;
                                                                                $j++;
                                                                                $export_arr[] = array(
                                                                                    $index_ticket_id, $index_ticket_username, $index_ticket_user_email, $index_ticket_quantity, $index_ticket_name,
                                                                                    $index_ticket_check_in_date, $index_discount, $index_discount_pt, $index_totalprice, $index_ticket_gst, $index_payment_method, $index_cancel_ticket,
                                                                                    $index_created_at
                                                                                );
                                                                                $serailze_user_arr = serialize($export_arr);

                                                                                echo '
                                                                            <tr>
                                                                                    <td class="">' . $index_ticket_id . '</td>
                                                                                    <td class="">' . $index_ticket_username . '</td>
                                                                                    <td class="">' . $index_ticket_user_email . '</span></td>
                                                                                    <td class="">' . $index_ticket_quantity = str_replace(",", "<br>", $index_ticket_quantity) . '</span></td>
                                                                                    <td class="">' . $index_ticket_name = str_replace(",", "<br>", $index_ticket_name) . '</span></td>
                                                                                    <td class="">' . $index_ticket_check_in_date . '</span></td>
                                                                                    <td class="">' . $index_discount . '</span></td>
                                                                                    <td class="">' . $index_discount_pt . '</span></td>
                                                                                    <td class="">' . $index_totalprice . ' INR</span></td>
                                                                                    <td class="">' . $index_ticket_gst . '</span></td>
                                                                                    <td class="">' . $index_payment_method . '</span></td>
                                                                                    <td class="">' . $index_cancel_ticket . '</span></td>
                                                                                    <td class="">' . $index_created_at . '</span></td>
                                                                            </tr>';
                                                                            }
                                                                            echo '
                                                                        <textarea name="export_data" style="display: none;">' . $serailze_user_arr . '</textarea>
                                                                        </tbody>
                                                                        </table>
                                                                        </div>
                                                                        <div class="card-footer mt-2">
                                                                        <div class="table-responsive">
                                                                                <table class="table table-hover table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Total Sales</th>
                                                                                            <th>Total GST</th>
                                                                                            <th>Total CGST</th>
                                                                                            <th>Total SGST</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                    <td class="">' . (array_sum($array)) . ' INR</td>
                                                                                    <td class="">' . $gstgst . ' INR</td>
                                                                                    <td class="">' . $gstgst / 2 . ' INR</span></td>
                                                                                    <td class="">' . $gstgst / 2 . ' INR</span></td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                        </table>
                                                                        </div>
                                                                        </div>
                                                                        ';
                                                                        } ?>
                                                                </div>
                                                                </form>
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
        function formatDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1; // Month is zero-based
            var year = date.getFullYear();

            // Pad single-digit day and month with leading zeros
            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }

            return day + '/' + month + '/' + year;
        }

        function fetch_data(str) {
            if (str == 'today') {
                var ticket_type = document.getElementById('ticket_type').value;
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/today.php?type=normal&&ticket_type=" + ticket_type);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'weekly') {
                var ticket_type = document.getElementById('ticket_type').value;
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                // xhr.open("GET", "./helpers/week_year.php?type=normal&&ticket_type=" + ticket_type + "&&date_from=" + formattedStartDate + "&&date_to=" + formattedEndDate);
                xhr.open("GET", "./helpers/week_year.php?type=normal&&ticket_type=" + ticket_type + "&&time=weekly");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'monthly') {
                var ticket_type = document.getElementById('ticket_type').value;
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&ticket_type=" + ticket_type + "&&time=monthly");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'yearly') {
                var ticket_type = document.getElementById('ticket_type').value;

                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&ticket_type=" + ticket_type + "&&time=yearly");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'lifetime') {
                var ticket_type = document.getElementById('ticket_type').value;

                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&ticket_type=" + ticket_type + "&&time=lifetime");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'Cash') {
                var ticket_type = document.getElementById('ticket_type').value;

                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&payment_type=" + str + "&&ticket_type=" + ticket_type);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'Card') {
                var ticket_type = document.getElementById('ticket_type').value;

                function getYearDates() {
                    var currentDate = new Date();
                    var year = currentDate.getFullYear();
                    var startDate = new Date(year, 0, 1); // January 1st
                    var endDate = new Date(year, 11, 31); // December 31st

                    return {
                        startDate: startDate,
                        endDate: endDate
                    };
                }
                // Example usage:
                var yearDates = getYearDates();
                var startYear = yearDates.startDate;
                var endYear = yearDates.endDate;
                var startYear = formatDate(startYear); // Format: "YYYY-MM-DD"
                var endYear = formatDate(endYear); // Format: "YYYY-MM-DD"
                console.log("year " + startYear + " - " + endYear);
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&payment_type=" + str + "&&ticket_type=" + ticket_type + "&&date_from=" + startYear + "&&date_to=" + endYear);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'Phonepe') {
                var ticket_type = document.getElementById('ticket_type').value;

                function getYearDates() {
                    var currentDate = new Date();
                    var year = currentDate.getFullYear();
                    var startDate = new Date(year, 0, 1); // January 1st
                    var endDate = new Date(year, 11, 31); // December 31st

                    return {
                        startDate: startDate,
                        endDate: endDate
                    };
                }
                // Example usage:
                var yearDates = getYearDates();
                var startYear = yearDates.startDate;
                var endYear = yearDates.endDate;
                var startYear = formatDate(startYear); // Format: "YYYY-MM-DD"
                var endYear = formatDate(endYear); // Format: "YYYY-MM-DD"
                console.log("year " + startYear + " - " + endYear);
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&payment_type=" + str + "&&ticket_type=" + ticket_type + "&&date_from=" + startYear + "&&date_to=" + endYear);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'NEFT/RTGS') {
                var ticket_type = document.getElementById('ticket_type').value;

                function getYearDates() {
                    var currentDate = new Date();
                    var year = currentDate.getFullYear();
                    var startDate = new Date(year, 0, 1); // January 1st
                    var endDate = new Date(year, 11, 31); // December 31st

                    return {
                        startDate: startDate,
                        endDate: endDate
                    };
                }
                // Example usage:
                var yearDates = getYearDates();
                var startYear = yearDates.startDate;
                var endYear = yearDates.endDate;
                var startYear = formatDate(startYear); // Format: "YYYY-MM-DD"
                var endYear = formatDate(endYear); // Format: "YYYY-MM-DD"
                console.log("year " + startYear + " - " + endYear);
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&payment_type=" + str + "&&ticket_type=" + ticket_type + "&&date_from=" + startYear + "&&date_to=" + endYear);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'Shoutlo') {
                var ticket_type = document.getElementById('ticket_type').value;

                function getYearDates() {
                    var currentDate = new Date();
                    var year = currentDate.getFullYear();
                    var startDate = new Date(year, 0, 1); // January 1st
                    var endDate = new Date(year, 11, 31); // December 31st

                    return {
                        startDate: startDate,
                        endDate: endDate
                    };
                }
                // Example usage:
                var yearDates = getYearDates();
                var startYear = yearDates.startDate;
                var endYear = yearDates.endDate;
                var startYear = formatDate(startYear); // Format: "YYYY-MM-DD"
                var endYear = formatDate(endYear); // Format: "YYYY-MM-DD"
                console.log("year " + startYear + " - " + endYear);
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&payment_type=" + str + "&&ticket_type=" + ticket_type + "&&date_from=" + startYear + "&&date_to=" + endYear);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            } else if (str == 'Razorpay') {
                var ticket_type = document.getElementById('ticket_type').value;

                function getYearDates() {
                    var currentDate = new Date();
                    var year = currentDate.getFullYear();
                    var startDate = new Date(year, 0, 1); // January 1st
                    var endDate = new Date(year, 11, 31); // December 31st

                    return {
                        startDate: startDate,
                        endDate: endDate
                    };
                }
                // Example usage:
                var yearDates = getYearDates();
                var startYear = yearDates.startDate;
                var endYear = yearDates.endDate;
                var startYear = formatDate(startYear); // Format: "YYYY-MM-DD"
                var endYear = formatDate(endYear); // Format: "YYYY-MM-DD"
                console.log("year " + startYear + " - " + endYear);
                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the AJAX request
                xhr.open("GET", "./helpers/week_year.php?type=normal&&payment_type=" + str + "&&ticket_type=" + ticket_type + "&&date_from=" + startYear + "&&date_to=" + endYear);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        const response = xhr.responseText;
                        document.getElementById('notification').innerHTML = response;
                        console.log(response);
                        // Do something with the response data
                    }
                }
                // Send the AJAX request with the data
                xhr.send();
            }
        }



        function onSubmitButton() {
            var ticket_type2 = document.getElementById('ticket_type').value;
            var date_from2 = document.getElementById('date_from').value;
            var date_to2 = document.getElementById('date_to').value;
            console.log(date_from2 + " - " + date_to2);

            // Create a new XMLHttpRequest object
            const xhr = new XMLHttpRequest();

            // Define the AJAX request
            xhr.open("GET", "./helpers/reports.php?type=normal&&ticket_type=" + ticket_type2 + "&&date_from=" + date_from2 + "&&date_to=" + date_to2);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const response = xhr.responseText;
                    document.getElementById('notification').innerHTML = response;
                    console.log(response);
                    // Do something with the response data
                }
            }
            // Send the AJAX request with the data
            xhr.send();
        }



        const ctx = document.getElementById('performaneLine');
        const data = {
            labels: [
                'AMUSEMENT PARK',
                'WUNDER WATER',
                'COMBO – AP + WP',
                'Yearly – Couple',
                'Yearly – Family',
            ],
            datasets: [{
                type: 'line',
                label: 'Ticket Sold',
                data: [<?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%AMUSEMENT%'")); ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%WUNDER WATER%'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%COMBO%'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%Couple%'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%Family%'")) ?>],
                fill: true,
            }]
        };
        var salesTopOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        color: "#F0F0F0",
                        zeroLineColor: '#F0F0F0',
                    },
                    ticks: {
                        beginAtZero: false,
                        autoSkip: true,
                        maxTicksLimit: 4,
                        fontSize: 10,
                        color: "#6B778C"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        beginAtZero: false,
                        autoSkip: true,
                        maxTicksLimit: 7,
                        fontSize: 10,
                        color: "#6B778C"
                    }
                }],
            },
            legend: false,
            legendCallback: function(chart) {
                var text = [];
                text.push('<div class="chartjs-legend"><ul>');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                    console.log(chart.data.datasets[i]); // see what's inside the obj.
                    text.push('<li>');
                    text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                    text.push(chart.data.datasets[i].label);
                    text.push('</li>');
                }
                text.push('</ul></div>');
                return text.join("");
            },

            elements: {
                line: {
                    tension: 0.4,
                }
            },
            tooltips: {
                backgroundColor: 'rgba(31, 59, 179, 1)',
            }
        }
        const mixedChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: salesTopOptions,
            tension: 1,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            borderWidth: 1,
            tension: 0.4, // Set tension to create curved lines
            fill: true // Fill area under the line
        });

        function printReport() {
            var report = document.getElementById('notification').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = report;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload()
        }
    </script>
    <?php include('./components/footer.php') ?>
    <?php include('./components/scripts.php') ?>