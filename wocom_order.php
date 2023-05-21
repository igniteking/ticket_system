<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>
<?php

include('./api/api.php');
// Setup:
require './vendor/autoload.php';

use Automattic\WooCommerce\Client;
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
                    <div class="">
                        <div class="">
                            <div class="home-tab">
                                <div class="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="card-body">
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">WooCommerce Order List</h4>
                                                            <div class="row">
                                                                <form action="./admin_list.php" method="get">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="order_id" class="form-control" placeholder="Search Order Id" onblur="this.form.submit()" id="order_id">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <a href="./wocom_order.php" class="btn btn-outline-danger col-md-12">Reset</a>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                            <div id="notification"></div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Item</th>
                                                                            <th>Quantity</th>
                                                                            <th>Payment Method</th>
                                                                            <th>Status</th>
                                                                            <th>Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $api = new Api();


                                                                        $woocommerce = new Client(
                                                                            'https://chalofuncity.com/backold', // Your store URL
                                                                            $api->consumerkey, // Your consumer key
                                                                            $api->consumersecret, // Your consumer secret
                                                                            [
                                                                                'wp_api' => true, // Enable the WP REST API integration
                                                                                'version' => 'wc/v3' // WooCommerce WP REST API version
                                                                            ]
                                                                        );

                                                                        ($fetchOrder = $woocommerce->get('orders'));
                                                                        foreach ($fetchOrder as $order) {
                                                                            ($first_name = $order->billing->first_name);
                                                                            ($status = $order->status);
                                                                            ($last_name = $order->billing->last_name);
                                                                            ($payment_method_title = $order->payment_method_title);
                                                                            ($date_paid = $order->date_paid);
                                                                            ($line_items = $order->line_items[0]->name);
                                                                            ($quantity = $order->line_items[0]->quantity);
                                                                            echo '
                                                                        <tr>
                                                                            <td>' . $first_name . $last_name . '</td>
                                                                            <td>';
                                                                            print_r($line_items);
                                                                            echo '</td><td>';
                                                                            print_r($quantity);
                                                                            echo '</td>
                                                                        <td>' . $payment_method_title . '</td>
                                                                            <td><label class="badge badge-info">' . $status . '</label></td>
                                                                            <td>' . $date_paid . '</td>
                                                                        </tr>';
                                                                        } ?>
                                                                    </tbody>
                                                                    <script>
                                                                        function doConfirm(id) {

                                                                            var ok = confirm("Are you sure to Delete?")
                                                                            if (ok) {

                                                                                var xmlhttp = new XMLHttpRequest();
                                                                                xmlhttp.onreadystatechange = function() {
                                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                                        document.getElementById("notification").innerHTML = this.responseText;
                                                                                    }
                                                                                };
                                                                                xmlhttp.open("GET", "./helpers/admin_delete.php?id=" + id);
                                                                                xmlhttp.send();
                                                                            }
                                                                        }
                                                                    </script>
                                                                </table>
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
            <?php include('./components/footer.php') ?>
            <?php include('./components/scripts.php') ?>