<?php
include('../connections/connection.php');
$time = @$_GET['time'];
$type = @$_GET['type'];
$ticket_type = $_GET['ticket_type'];
$payment_type = @$_GET['payment_type'];

echo "<form method='post' action='./vendor/export_csv.php'>
<input type='submit' class='btn btn-warning col-md-12' value='Export as .CSV' name='export_data'>";
if ($payment_type != '') {
    if ($type == 'b2b') {
        $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket"));
        if ($check_user > 0) {
            if ($time == "weekly") {
                $today = new DateTime(); // Get the current date and time
                $interval = new DateInterval('P6D'); // Create an interval of 6 days
                $today->sub($interval); // Subtract the interval to get the date 6 days before

                $sixDaysAgo = $today->format('Y-m-d'); // Format the date as 'YYYY-MM-DD'

                $date_from = $sixDaysAgo;
                $date_to = date('Y-m-d');
            } else if ($time == "monthly") {
                $date_from = date('Y-m-01'); // First day of the current month
                $date_to = date('Y-m-t'); // Last day of the current month
            } else if ($time == "lifetime") {
                $date_from = date('2010-m-01'); // First day of the current month
                $date_to = date('Y-m-d'); // Last day of the current month
            } else {
                $date_from = date('Y-01-01'); // First day of the current year
                $date_to = date('Y-12-31'); // Last day of the current year
            }
            if ($ticket_type == 'ALL') {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'");
            } else {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE ticket_name LIKE '%$ticket_type%' AND payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE ticket_name LIKE '%$ticket_type%' AND payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'");
            }
            if ($fetch_data and $count > 0) {
                echo  '
                                                                        <center><div class="card-title">Total Invoice: ' . $count . '</div></count>
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
                while ($rows = mysqli_fetch_array($fetch_data)) {
                    $index_ticket_id = $rows['id'];
                    $index_ticket_gst = $rows['gst'];
                    $gst_array[$j] = $index_ticket_gst;
                    $ticket_code = $rows['ticket_code'];
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
                    $index_i;
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
                        if ($ticket_type == "ALL") {
                        } else {
                            if ($index_product == $ticket_type) {
                                @$index_i = array($index_quantity);
                            }
                        }
                    }
                    if ($ticket_type == "ALL") {
                    } else {
                        foreach (@$index_i as $key) {
                            @$total_tickets_qith_quanitty_addition += $key;
                        }
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
                                                                                    <td class=""><a href="./ticket_view.php?ticket_code=' . $ticket_code . '&&type=b2b" class="btn btn-sm btn-primary text-white">View</a></td>
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
                                                                                    <tfoot>';
                if ($ticket_type != 'ALL') {
                    echo ' <div class=" card card-body col-md-6 mb-2 text-bold"><b>Total ' . $ticket_type . ' Ticket Quantity: ' . @$total_tickets_qith_quanitty_addition . '</b></div>';
                }
                echo '
                                                                                    </tfoot>
                                                                        </table>
                                                                        </div>
                                                                        </div>
                                                                        ';
            } else {
                echo '<div class="col-md-12 btn btn-danger text-white">
            <h6 class="mt-2">No Entry Exists!</h6>
        </div>';
            }
        } else {
            echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">No B2B Entry Exists!</h6>
    </div>';
        }
    } else {
        $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket"));
        if ($check_user > 0) {
            if ($time == "weekly") {
                $today = new DateTime(); // Get the current date and time
                $interval = new DateInterval('P6D'); // Create an interval of 6 days
                $today->sub($interval); // Subtract the interval to get the date 6 days before

                $sixDaysAgo = $today->format('Y-m-d'); // Format the date as 'YYYY-MM-DD'

                $date_from = $sixDaysAgo;
                $date_to = date('Y-m-d');
            } else if ($time == "monthly") {
                $date_from = date('Y-m-01'); // First day of the current month
                $date_to = date('Y-m-t'); // Last day of the current month
            } else if ($time == "lifetime") {
                $date_from = date('2010-m-01'); // First day of the current month
                $date_to = date('Y-m-d'); // Last day of the current month
            } else {
                $date_from = date('Y-01-01'); // First day of the current year
                $date_to = date('Y-12-31'); // Last day of the current year
            }
            if ($ticket_type == 'ALL') {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'");
            } else {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%$ticket_type%' AND payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%$ticket_type%' AND payment_method = '$payment_type' AND created_at BETWEEN '$date_from' AND '$date_to'");
            }

            if ($fetch_data and $count > 0) {
                echo  '
                                                                        <center><div class="card-title">Total Invoice: ' . $count . '</div></count>
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
                while ($rows = mysqli_fetch_array($fetch_data)) {
                    $index_ticket_id = $rows['id'];
                    $index_ticket_gst = $rows['gst'];
                    $gst_array[$j] = $index_ticket_gst;
                    $ticket_code = $rows['ticket_code'];
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
                    $index_i;
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
                        if ($ticket_type == "ALL") {
                        } else {
                            if ($index_product == $ticket_type) {
                                @$index_i = array($index_quantity);
                            }
                        }
                    }
                    if ($ticket_type == "ALL") {
                    } else {
                        foreach (@$index_i as $key) {
                            @$total_tickets_qith_quanitty_addition += $key;
                        }
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
                                                                                    <td class=""><a href="./ticket_view.php?ticket_code=' . $ticket_code . '" class="btn btn-sm btn-primary text-white">View</a></td>
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
                                                                                    <tfoot>';
                if ($ticket_type != 'ALL') {
                    echo ' <div class=" card card-body col-md-6 mb-2 text-bold"><b>Total ' . $ticket_type . ' Ticket Quantity: ' . @$total_tickets_qith_quanitty_addition . '</b></div>';
                }
                echo '
                                                                                    </tfoot>
                                                                        </table>
                                                                        </div>
                                                                        </div>
                                                                        ';
            } else {
                echo '<div class="col-md-12 btn btn-danger text-white">
            <h6 class="mt-2">No Entry Exists!</h6>
        </div>';
            }
        } else {
            echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">No Entry Exists!</h6>
    </div>';
        }
    }
} else {
    if ($type == 'b2b') {
        $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket"));
        if ($check_user > 0) {
            if ($time == "weekly") {
                $today = new DateTime(); // Get the current date and time
                $interval = new DateInterval('P6D'); // Create an interval of 6 days
                $today->sub($interval); // Subtract the interval to get the date 6 days before

                $sixDaysAgo = $today->format('Y-m-d'); // Format the date as 'YYYY-MM-DD'

                $date_from = $sixDaysAgo;
                $date_to = date('Y-m-d');
            } else if ($time == "monthly") {
                $date_from = date('Y-m-01'); // First day of the current month
                $date_to = date('Y-m-t'); // Last day of the current month
            } else if ($time == "lifetime") {
                $date_from = date('2010-m-01'); // First day of the current month
                $date_to = date('Y-m-d'); // Last day of the current month
            } else {
                $date_from = date('Y-01-01'); // First day of the current year
                $date_to = date('Y-12-31'); // Last day of the current year
            }
            if ($ticket_type == 'ALL') {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'");
            } else {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE ticket_name LIKE '%$ticket_type%' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE ticket_name LIKE '%$ticket_type%' AND created_at BETWEEN '$date_from' AND '$date_to'");
            }
            if ($fetch_data and $count > 0) {
                echo  '
                                                                        <center><div class="card-title">Total Invoice: ' . $count . '</div></count>
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
                while ($rows = mysqli_fetch_array($fetch_data)) {
                    $index_ticket_id = $rows['id'];
                    $index_ticket_gst = $rows['gst'];
                    $gst_array[$j] = $index_ticket_gst;
                    $ticket_code = $rows['ticket_code'];
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
                    $index_i;
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
                        if ($ticket_type == "ALL") {
                        } else {
                            if ($index_product == $ticket_type) {
                                @$index_i = array($index_quantity);
                            }
                        }
                    }
                    if ($ticket_type == "ALL") {
                    } else {
                        foreach (@$index_i as $key) {
                            @$total_tickets_qith_quanitty_addition += $key;
                        }
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
                                                                                    <td class=""><a href="./ticket_view.php?ticket_code=' . $ticket_code . '&&type=b2b" class="btn btn-sm btn-primary text-white">View</a></td>
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
                                                                                    <tfoot>';
                if ($ticket_type != 'ALL') {
                    echo ' <div class=" card card-body col-md-6 mb-2 text-bold"><b>Total ' . $ticket_type . ' Ticket Quantity: ' . @$total_tickets_qith_quanitty_addition . '</b></div>';
                }
                echo '
                                                                                    </tfoot>
                                                                        </table>
                                                                        </div>
                                                                        </div>
                                                                        ';
            } else {
                echo '<div class="col-md-12 btn btn-danger text-white">
            <h6 class="mt-2">No Entry Exists!</h6>
        </div>';
            }
        } else {
            echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">No B2B Entry Exists!</h6>
    </div>';
        }
    } else {
        $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket"));
        if ($check_user > 0) {
            if ($time == "weekly") {
                $today = new DateTime(); // Get the current date and time
                $interval = new DateInterval('P6D'); // Create an interval of 6 days
                $today->sub($interval); // Subtract the interval to get the date 6 days before

                $sixDaysAgo = $today->format('Y-m-d'); // Format the date as 'YYYY-MM-DD'

                $date_from = $sixDaysAgo;
                $date_to = date('Y-m-d');
            } else if ($time == "monthly") {
                $date_from = date('Y-m-01'); // First day of the current month
                $date_to = date('Y-m-t'); // Last day of the current month
            } else if ($time == "lifetime") {
                $date_from = date('2010-m-01'); // First day of the current month
                $date_to = date('Y-m-d'); // Last day of the current month
            } else {
                $date_from = date('Y-01-01'); // First day of the current year
                $date_to = date('Y-12-31'); // Last day of the current year
            }
            if ($ticket_type == 'ALL') {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'");
            } else {
                $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%$ticket_type%' AND created_at BETWEEN '$date_from' AND '$date_to'"));
                $fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name LIKE '%$ticket_type%' AND created_at BETWEEN '$date_from' AND '$date_to'");
            }
            if ($fetch_data and $count > 0) {
                echo  '
                                                                        <center><div class="card-title">Total Invoice: ' . $count . '</div></count>
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
                while ($rows = mysqli_fetch_array($fetch_data)) {
                    $index_ticket_id = $rows['id'];
                    $index_ticket_gst = $rows['gst'];
                    $gst_array[$j] = $index_ticket_gst;
                    $ticket_code = $rows['ticket_code'];
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
                    $index_i;
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
                        if ($ticket_type == "ALL") {
                        } else {
                            if ($index_product == $ticket_type) {
                                @$index_i = array($index_quantity);
                            }
                        }
                    }
                    if ($ticket_type == "ALL" or $ticket_type == "") {
                    } else {
                        foreach (@$index_i as $key) {
                            @$total_tickets_qith_quanitty_addition += $key;
                        }
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
                                                                                    <td class=""><a href="./ticket_view.php?ticket_code=' . $ticket_code . '" class="btn btn-sm btn-primary text-white">View</a></td>
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
                                                                                    <tfoot>';
                if ($ticket_type != 'ALL') {
                    echo ' <div class=" card card-body col-md-6 mb-2 text-bold"><b>Total ' . $ticket_type . ' Ticket Quantity: ' . @$total_tickets_qith_quanitty_addition . '</b></div>';
                }
                echo '
                                                                                    </tfoot>
                                                                        </table>
                                                                        </div>
                                                                        </div>
                                                                        ';
            } else {
                echo '<div class="col-md-12 btn btn-danger text-white">
            <h6 class="mt-2">No Entry Exists!</h6>
        </div>';
            }
        } else {
            echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">No Entry Exists!</h6>
    </div>';
        }
    }
}
