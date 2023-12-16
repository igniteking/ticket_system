<?php include('./connections/connection.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Invoice</title>
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
  <!-- 
  <center>
    <header>
      <h3>Surya Funcity Limited</h3>
      <p>
        Vill Daffarpur, Chandigarh - Barwala<br />Highway, Distt SAS Nagar,
        Mohali, <br />
        Punjab -140201
      </p>
    </header>
  </center>

  <div class="line"></div>

  <div class="Cashier_details table">
    <div class="row">
      <div class="col">
        <p>
          <label>Name:</label>
          <label for=""><?= $ticket_username ?></label>
        </p>
      </div>
      <div class="line"></div>
    </div>
  </div>
  <div class="Cashier_details table">
    <div class="row">
      <div class="col">
        <p>
          <label for="">Date:</label>
          <?= $created_at ?>
        </p>
      </div>
      <div class="col">
      </div>
    </div>
    <div class="row" style="margin-top: -15px">
      <div class="col">
        <p>
          <label for="">Cashier: </label>
          <label for=""><?= (array_values(mysqli_fetch_array($conn->query("SELECT username FROM user_data WHERE email = '$created_by'")))[0]) ?></label>
        </p>
      </div>
      <div class="col">
        <p>
          <label for="">Bill no.</label>
          <label for=""><?= $ticket_id ?></label>
        </p>
      </div>
    </div>
  </div>
  <div class="line"></div>
  <div class="billing_details">
    <table class="table table-borderless">
      <thead>
        <tr>
          <th scope="col">Item</th>
          <th scope="col">Qty.</th>
          <th scope="col">Price</th>
          <th scope="col">Discount</th>
          <th scope="col">Amount</th>
        </tr>
      </thead>
      <tbody>
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
          if ($product == "AMUSEMENT PARK") {
            $product  = "AMUSEMENT";
            $price = "508.47";
          } else if ($product == "WUNDER WATER") {
            $product  = "WUNDER WATER";
            $price = "1059.32";
          } else if ($product == "COMBO – AMUSEMENT PARK + WATER PARK") {
            $product  = "COMBO";
            $price = "1101.69";
          } else if ($product == "COUPLE") {
            $product  = "COUPLE";
            $price = "5076.27";
          } else if ($product == "FAMILY") {
            $product  = "FAMILY";
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
          <tr style="border-top: 1px solid #000;">
          <th scope="row">' . $product . '</th>
          <td>' . $quantity . '</td>
          <td>₹ ' . $price . '</td>
          <td>₹ ' . $discpuntpt[$i] . '</td>
          <td>₹ ' . $totalAmount . '</td>
        </tr>
        ';

          $i++;

          @$newTotal += $totalAmount;
        }
        echo '<input type="hidden" id="total_quantity" value="' . $total_quantity . '">';
        echo '<input type="hidden" id="gstAmount" value="' . $totalprice . '">';
        ?>

      </tbody>
    </table>
    <table class="table table-borderless">
      <thead>
        <tr style="border-top: 2px solid #000; border-bottom: 2px solid #000;">
          <th scope="col">Total Qty: <span id="ttl_quantity">0</span></th>
          <th scope="col">Sub Total</th>
          <th scope="col" id="gstAmount_fill">₹ 00.00</th>
        </tr>
      </thead>
      <tbody>
        <tr style="border: 0px none #000;">
          <th scope="row">CGST</th>
          <td>9%</td>
          <td>₹ <?= round($gstAmount, 0) ?></td>
        </tr>
        <tr style="border: 0px none #000;">
          <th scope="row">SGST</th>
          <td>9%</td>
          <td>₹ <?= round($gstAmount, 0) ?></td>
        </tr>
        <tr style="border-top: 2px solid #000; border-bottom: 2px solid #000;">
          <th></th>
          <td>
            <h3>Grand Total:</h3>
          </td>
          <td>₹ <?= $newTotal ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <center>
    <footer>
      <p>
        Thank You <br />
        GST No: 03AACCS2999F1ZA <br />
        Bank Details: <br />
        Bank Of India <br />
        AC No. 620225100001187 <br />
        IFSC: BKID0006202 <br />
        Bank of India, Sector 32, Chandigarh
      </p>
    </footer>
  </center> -->

</body>

</html>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&amp;display=swap');

  *,
  ::after,
  ::before {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-weight: bold;
  }

  body {
    color: #000;
    font-weight: 900;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.4em;
    margin: 0;
    font-family: 'Inter', sans-serif;
    background-color: #f5f6fa;
  }

  .ap_inpos_invoice_wrap {
    max-width: 340px;
    margin: auto;
    margin-top: 30px;
    padding: 30px 20px;
    background-color: #fff;
  }

  .ap_inpos_company_logo {
    display: flex;
    justify-content: center;
    margin-bottom: 7px;
  }

  .ap_inpos_company_logo img {
    vertical-align: middle;
    border: 0;
    max-width: 100%;
    height: auto;
    max-height: 45px;
  }

  .ap_inpos_invoice_top {
    text-align: center;
    margin-bottom: 18px;
  }

  .ap_inpos_invoice_heading {
    display: flex;
    justify-content: center;
    position: relative;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 500;
    margin: 10px 0;
  }

  .ap_inpos_invoice_heading:before {
    content: '';
    position: absolute;
    height: 0;
    width: 100%;
    left: 0;
    top: 46%;
    border-top: 1px solid #b5b5b5;
  }

  .ap_inpos_invoice_heading span {
    display: inline-flex;
    padding: 0 5px;
    background-color: #fff;
    z-index: 1;
    font-weight: 500;
    color: #111;
  }

  .tm_list.tm_style1 {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
  }

  .tm_list.tm_style1 li {
    display: flex;
    width: 50%;
    font-size: 14px;
    line-height: 1.2em;
    margin-bottom: 7px;
  }

  .text-right {
    text-align: right;
    justify-content: flex-end;
  }

  .tm_list_title {
    margin-right: 4px;
    margin-bottom: -9px;
  }

  .tm_invoice_seperator {
    width: 100%;
    border-top: 1px Solid #b5b5b5;
    margin: 9px 0;
    margin-left: auto;
  }

  .ap_inpos_invoice_table {
    width: 100%;
    margin-top: 0px;
    line-height: 1.3em;
  }

  .ap_inpos_invoice_table thead th {
    font-weight: 500;
    color: #111;
    text-align: left;
    padding: 8px 3px;
    border-top: 1px Solid #b5b5b5;
    border-bottom: 1px Solid #b5b5b5;
  }

  .ap_inpos_invoice_table td {
    padding: 4px;
  }

  .ap_inpos_invoice_table tbody tr:first-child td {
    padding-top: 10px;
  }

  .ap_inpos_invoice_table tbody tr:last-child td {
    padding-bottom: 10px;
    border-bottom: 1px Solid #b5b5b5;
  }

  .ap_inpos_invoice_table th:last-child,
  .ap_inpos_invoice_table td:last-child {
    text-align: right;
    padding-right: 0;
  }

  .ap_inpos_invoice_table th:first-child,
  .ap_inpos_invoice_table td:first-child {
    padding-left: 0;
  }

  .ap_inpos_invoice_table tr {
    vertical-align: baseline;
  }

  .ap_inbill_list {
    list-style: none;
    margin: 0;
    padding: 8px 0;
    border-bottom: 1px Solid #b5b5b5;
  }

  .ap_inbill_list_in {
    display: flex;
    text-align: right;
    justify-content: flex-end;
    padding: 3px 0;
  }

  .ap_inbill_title {
    padding-right: 20px;
  }

  .ap_inbill_value {
    width: 90px;
  }

  .ap_inbill_value.ap_inbill_focus,
  .ap_inbill_title.ap_inbill_focus {
    font-weight: 500;
    color: #111;
  }

  .ap_inpos_invoice_footer {
    text-align: center;
    margin-top: 20px;
  }

  .ap_inpos_sample_text {
    text-align: center;
    padding: 12px 0;
    border-bottom: 1px Solid #b5b5b5;
    line-height: 1.6em;
    color: #9c9c9c;
    font-size: 12px;
  }

  .ap_inpos_company_name {
    font-weight: 500;
    color: #111;
    font-size: 18px;
    line-height: 1.4em;
  }
</style>
</head>

<body>
  <div class="ap_inpos_invoice_wrap">
    <div class="ap_inpos_invoice_top">
      <div class="ap_inpos_company_name">Surya Funcity Limited</div>
      <div class="ap_inpos_company_address">Vill Daffarpur, Chandigarh - Barwala</div>
      <div class="ap_inpos_company_address">Highway, Distt SAS Nagar Mohali,</div>
      <div class="ap_inpos_company_mobile">Punjab - 140201</div>
    </div>
    <div class="ap_inpos_invoice_body">
      <div class="ap_inpos_invoice_heading"></div>
      <ul class="tm_list tm_style1">
        <li>
          <div class="tm_list_title">Name:</div>
          <div id="bill_username" class="tm_list_desc"><?= $ticket_username ?></div>
        </li>
      </ul>
      <div class="tm_invoice_seperator"></div>
      <ul class="tm_list tm_style1">
        <li>
          <div class="tm_list_title">Date:</div>
          <div class="tm_list_desc"><?= $created_at ?></div>
        </li>
        <li class="text-right">
          <div class="tm_list_title">Time:</div>
          <div class="tm_list_desc"><?= date('H:i') ?></div>
        </li>
        <li>
          <div class="tm_list_title">Cashier:</div>
          <div class="tm_list_desc">biller</div>
        </li>
        <li class="text-right">
          <div class="tm_list_title">Bill No:</div>
          <div id="bill_invoice" class="tm_list_desc"><?= $ticket_id ?></div>
        </li>
      </ul>
      <table class="ap_inpos_invoice_table" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th style="text-align:center;">Item</th>
            <th style="text-align:center;">Qty</th>
            <th style="text-align:center;">Price</th>
            <th style="text-align:center;">Discount</th>
            <th style="text-align:center;">Amount</th>
          </tr>
        </thead>
        <tbody id="new_bill_row">
          <!-- copy this code and print 5 times -->
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
            <tr style="border-top: 2px solid #000;" class="service">
            <td class="tableitem" style="border-bottom: 2px solid #000;" id="package_name_new">
              <p class="itemtext">' . $product . '</p>
            </td>
            <td class="tableitem" style="border-bottom: 2px solid #000;">
              <p class="itemtext">' . $quantity . '</p>
            </td>
            <td class="tableitem" style="border-bottom: 2px solid #000;">
              <p class="itemtext">₹' . $price . '</p>
            </td>
            <td class="tableitem" style="border-bottom: 2px solid #000;">
              <p class="itemtext">' . $discpuntpt[4] . '</p>
            </td>
            <td class="tableitem" style="border-bottom: 2px solid #000;">
              <p class="itemtext">₹' . $totalAmount . '</p>
            </td>
            </tr>
        ';

            $i++;

            @$newTotal += $totalAmount;
          }
          echo '<input type="hidden" id="total_quantity" value="' . $total_quantity . '">';
          echo '<input type="hidden" id="gstAmount" value="' . $totalprice . '">';
          ?>
          <!-- copy this code and print 5 times -->
        </tbody>
      </table>
      <div class="ap_inbill_list">
        <div class="ap_inbill_list_in">
          <div class="ap_inbill_title">Total Qty: <span id="ttl_quantity"></span></div>
          <div class="ap_inbill_value">Sub Total</div>
          <div class="ap_inbill_value" id="gstAmount_fill">5084.75</div>
        </div>
        <div class="ap_inbill_list_in">
          <div class="ap_inbill_title">CGST: </div>
          <div class="ap_inbill_value">9%</div>
          <div class="ap_inbill_value" id="cgst_print"><?= round($gstAmount, 0) ?></div>
        </div>
        <div class="ap_inbill_list_in">
          <div class="ap_inbill_title">SGST: </div>
          <div class="ap_inbill_value">9%</div>
          <div class="ap_inbill_value" id="sgst_print"><?= round($gstAmount, 0) ?></div>
        </div>
        <div class="tm_invoice_seperator"></div>
        <div class="ap_inbill_list_in">
          <div class="ap_inbill_title ap_inbill_focus">Grand Total:</div>
          <div class="ap_inbill_value ap_inbill_focus" id="print_grand_total"><?= $newTotal ?></div>
        </div>
        <tr>
          <td>Paid Via</td>
          <td></td>
          <td></td>
          <td id="paid_via"><?= $payment_method ?></td>
        </tr>
      </div>

      <div class="ap_inpos_invoice_footer">Thank You</div>
      <div class="ap_inpos_company_address" style="text-align: center;">GST No: 03AACCS29991ZA </div>
      <div class="ap_inpos_company_address" style="text-align: center;">Bank Details:</div>
      <div class="ap_inpos_company_address" style="text-align: center;">Bank Of India</div>
      <div class="ap_inpos_company_address" style="text-align: center;">AC No. 620225100001187</div>
      <div class="ap_inpos_company_address" style="text-align: center;">IFSC: BKID0006202<div>
          <div class="ap_inpos_company_address" style="text-align: center;">Bank of India, Sector 32, Chandigarh</div>
        </div>
      </div>
      </b>
      <!-- <script>
    window.onload = function() {
      var total_quantity = document.getElementById("total_quantity").value;
      var gstAmount = document.getElementById("gstAmount").value;
      document.getElementById("ttl_quantity").innerText = total_quantity;
      document.getElementById("gstAmount_fill").innerText = '₹ ' + gstAmount;
      window.print();
    }
  </script> -->