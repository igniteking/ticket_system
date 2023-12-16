<?php include('../connections/connection.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&family=Poppins&display=swap" rel="stylesheet" />
</head>
<style>
  * {
    font-weight: 700 !important;
  }

  hr {
    height: 3px;
    color: black;
    background-color: black;
  }

  .details {
    border: 0px;
  }

  th {
    font-weight: 400;
  }
</style>

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
        <div class="line"></div>
      </div>
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
    <div class="row">
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
    <table class="table">
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
          $totalprice += $price;
          $total = $price * $quantity;
          $gstRate = 18;
          // Calculate the GST amount
          $gstAmount = ($total * $gstRate) / 100;

          // Calculate the total amount including GST
          $totalAmount = round($total + $gstAmount, 1);

          echo '
          <tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
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
    <div class="line"></div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Total Qty: <span id="ttl_quantity">0</span></th>
          <th scope="col">Sub Total</th>
          <th scope="col" id="gstAmount_fill">₹ 00.00</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">CGST</th>
          <td>9%</td>
          <td>₹ <?= round($gstAmount, 0) ?></td>
        </tr>
        <tr>
          <th scope="row">SGST</th>
          <td>9%</td>
          <td>₹ <?= round($gstAmount, 0) ?></td>
        </tr>
        <tr>
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
  </center>
  <script>
    window.onload = function() {
      var total_quantity = document.getElementById("total_quantity").value;
      var gstAmount = document.getElementById("gstAmount").value;
      document.getElementById("ttl_quantity").innerText = total_quantity;
      document.getElementById("gstAmount_fill").innerText = '₹ ' + gstAmount;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>