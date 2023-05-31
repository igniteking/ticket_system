<?php include('./connections/connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
</head>

<body>

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
        $ticket_name = $row['ticket_name'];
        $ticket_check_in_date = $row['ticket_check_in_date'];
        $product_id = $row['product_id'];
        $payment_method = $row['payment_method'];
        $created_at = $row['created_at'];
    }

    ?>

    <div id="invoice-POS">
        <div id="mid">
            <div class="info">
                <center>
                    <h2>Surya Funcity limited</h2>
                    <p>
                        Vill Daffarpur, Chandigarh - Barwala</br>
                        Highway, Distt SAS Nagar Mohali,</br>
                        Punjab - 140201</br>
                    </p>
            </div>
        </div>
        </center><!--End Invoice Mid-->
        <hr>

        <p><label>Name:</label>
            <z style="font-size:10px;" id="bill_username"><?= $ticket_username ?></z>
            <hr style="margin-top:-10px;">
        </p>

        <div class="row">
            <div class="col-sm-6">
                <p> <label>Date: </label>
                    <z style="font-size:10px;"><?= date('d-m-Y') ?></z>
                </p>
            </div>
            <div class="col-sm-6">
                <p><label> Dine: </label><input type="text" name="" id="" style="width:40px; border:none;"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Cashier: Biller</p>
            </div>
            <div class="col-sm-6">
                <p><label> Bill No: </label>
                    <z style="font-size:8px;" id="bill_invoice"></z>
                </p>
            </div>

        </div>
        <hr style="margin-top:-10px;">
        <div id="bot">

            <div id="table">
                <table>
                    <thead>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Item</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qty</h2>
                            </td>
                            <td class="Hours">
                                <h2>Price</h2>
                            </td>
                            <td class="Rate">
                                <h2>Amount</h2>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="new_bill_row">
                        <?php
                        $productsString = $ticket_name;
                        $quantitiesString = $ticket_quantity;

                        // Split the products and quantities strings into arrays
                        $products = explode(",", $productsString);
                        $quantities = explode(",", $quantitiesString);

                        // Combine the products and quantities into an associative array
                        $result = array_combine($products, $quantities);

                        // Iterate over the array and print the product = quantity pairs
                        foreach ($result as $product => $quantity) {
                            if ($product == "AMUSEMENT PARK") {
                                $price = "508.47";
                            } else if ($product == "WUNDER WATER") {
                                $price = "1059.32";
                            } else if ($product == "COMBO – AMUSEMENT PARK + WATER PARK") {
                                $price = "1101.69";
                            } else if ($product == "Yearly Membership – Couple") {
                                $price = "5076.27";
                            } else if ($product == "Yearly Membership – Family") {
                                $price = "9313.56";
                            }
                            $total = $price * $quantity;
                            $gstRate = 18;
                            // Calculate the GST amount
                            $gstAmount = ($total * $gstRate) / 100;

                            // Calculate the total amount including GST
                            $totalAmount = round($total + $gstAmount, 1);
                            echo '<tr class="service" id="">
                            <td class="tableitem" id="package_name_new">
                                <p class="itemtext">' . $product . '</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" id="print_bill_quantity">' . $quantity . '</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">₹ ' . $price . '</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" id="print_ticket_price">₹ ' . $totalAmount . '</p>
                            </td>
                        </tr>';

                            @$newTotal += $totalAmount;
                        }
                        ?>
                    </tbody>


                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Sub Total</h2>
                        </td>
                        <td class="payment">
                            <h2>Amount</h2>
                        </td>
                        <td></td>
                    </tr>

                    <tr class="tabletitle">
                        <td>CGST</td>
                        <td class="Rate">
                            <h2>9%</h2>
                        </td>
                        <td class="payment" id="cgst_print">
                            <h2>₹ <?= round($gstAmount, 0) ?></h2>
                        </td>
                        <td></td>
                    </tr>

                    <tr class="tabletitle">
                        <td>SGST</td>
                        <td class="Rate">
                            <h2>9%</h2>
                        </td>
                        <td class="payment" id="sgst_print">
                            <h2>₹ <?= round($gstAmount, 0) ?></h2>
                        </td>
                        <td></td>
                    </tr>

                    <tr class="tabletitle">
                        <td>
                            <h1>Grandtotal:</h1>
                        </td>
                        <td></td>
                        <td class="payment">
                            <h2 id="print_grand_total">₹ <?= $newTotal ?></h2>
                        </td>
                        <td></td>
                    </tr>

                    <tr class="tabletitle">
                        <td>
                            <h2>Paid Via Other</h2>
                        </td>
                        <td>
                            <p id="paid_via"><?= $payment_method ?></p>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>

                </table>
            </div><!--End Table-->

            <div id="legalcopy">
                <center>
                    <p class="legal"><strong>Thank you!</strong> <br>
                        GST No: 03AACCS299F12A <br>
                        Bank Details: <br>
                        Bank Of India <br>
                        A/C No.: 620225100001187 <br>
                        IFSC: BKID0006202 <br>
                        Bank Of India, Sector 32, Chandigarh

                    </p>
                </center>
            </div>

        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->

    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            width: 57.15mm;
            background: #FFF;
        }

        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #top,
        #mid,
        #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #top {
            min-height: 100px;
        }

        #mid {
            min-height: 80px;
        }

        #bot {
            min-height: 50px;
        }

        #top .logo {

            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url() no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        .info {
            display: block;

            margin-left: 0;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabletitle {

            font-size: .5em;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: .5em;
        }

        #legalcopy {
            margin-top: 5mm;
        }
    </style>
    <script>
        window.print();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>