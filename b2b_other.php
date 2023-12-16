<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>
<?php
if (isset($_SESSION['email'])) {
} else {
  echo "<meta http-equiv=\"refresh\" content=\"0; url=./helpers/logout.php\">";
  exit();
}
?>

<body class="sidebar-icon-only">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include('./components/navbar.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include('./components/sidebar.php');
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-2">
              <div class="card btn" id="0" onclick="changeprice('0')">
                <div class="">
                  <center>
                    <h4 id="ticket_types">AMUSEMENT</h4>
                  </center>
                </div>
              </div>
              <div class="card mt-4 btn" id="1" onclick="changeprice('1')">
                <div class="">
                  <center>
                    <h4 id="ticket_types">WUNDER WATER</h4>
                  </center>
                </div>
              </div>
              <div class="card mt-4 btn" id="2" onclick="changeprice('2')">
                <div class="">
                  <center>
                    <h4 id="ticket_types">COMBO</h4>
                  </center>
                </div>
              </div>
              <div class="card mt-4 btn" id="3" onclick="changeprice('3')">
                <div class="">
                  <center>
                    <h4 id="ticket_types">Couple</h4>
                  </center>
                </div>
              </div>
              <div class="card mt-4 btn" id="4" onclick="changeprice('4')">
                <div class="">
                  <center>
                    <h4 id="ticket_types">Family</h4>
                  </center>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Buisness Details</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label for="username">Legal Name</label>
                          <input type="hidden" name="client_code" id="client_code" value="<?= rand(); ?>">
                          <input type="hidden" name="created_by" id="created_by" value="<?= $_SESSION['email'] ?>">
                          <input type="hidden" name="bill_invoice_value" id="bill_invoice_value" value="<?php $es = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `ticket`")) + 1;
                                                                                                        if ($es < 10) {
                                                                                                          echo '00' . $es;
                                                                                                        } else if ($es < 100) {
                                                                                                          echo '0' . $es;
                                                                                                        } else {
                                                                                                          echo $es;
                                                                                                        } ?>">
                          <input list="username" class="form-control form-control-lg col-md-4" id="username" onchange="getUsername(this.value)" name="username" placeholder="Username">
                          <datalist id="username">
                            <?php
                            $username_fetch = mysqli_query($conn, "SELECT * FROM client");
                            while ($rows = mysqli_fetch_array($username_fetch)) {
                              $username_list = $rows['username'];
                              echo '<option value="' . $username_list . '">';
                            }
                            ?>
                          </datalist>
                          <label for="mobile">GST Details</label>
                          <input type="text" class="form-control form-control-lg col-md-4" id="gst_number" onchange="getGST(this.value)" name="gst_number">
                          <label for="email">Email</label>
                          <input list="email" class="form-control form-control-lg col-md-4" id="email" onchange="getEmail(this.value)" name="email" placeholder="Email">
                          <datalist id="email">
                            <?php
                            $email_fetch = mysqli_query($conn, "SELECT * FROM client");
                            while ($rows = mysqli_fetch_array($email_fetch)) {
                              $email_list = $rows['email'];
                              echo '<option value="' . $email_list . '">';
                            }
                            ?>
                          </datalist>
                          <label for="mobile">Mobile</label>
                          <input list="number" class="form-control form-control-lg col-md-4" id="mobile" onchange="getMobile(this.value)" name="phone" placeholder="Mobile number">
                          <datalist id="number">
                            <?php
                            $phone_fetch = mysqli_query($conn, "SELECT * FROM client");
                            while ($rows = mysqli_fetch_array($phone_fetch)) {
                              $phone_list = $rows['phone'];
                              echo '<option value="' . $phone_list . '">';
                            }
                            ?>
                          </datalist>
                          <label for="mobile">Check-In Date</label>
                          <input type="date" class="form-control form-control-lg col-md-4" id="date" min="<?php echo date('Y-m-d'); ?>" onchange="getDate(this.value)" name="date">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Done</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Discount</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label for="discount">Discount (INR)</label>
                          <input type="number" onblur="updatePrice()" class="form-control form-control-lg col-md-4" id="discount" name="discount" placeholder="Discount in INR">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Done</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-10">
              <div id="notification"></div>
              <div class="row">
                <div class="col-md-6">
                  <div type="button" class="card mt-4 bg-info text-white btn text-center" style="font-size: 17px; width: 100%; height: 60px; font-weight: 600;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Buisness Details</div>
                </div>
                <div class="col-md-6">
                  <div type="button" class="card mt-4 bg-info text-white btn text-center" style="font-size: 17px; width: 100%; height: 60px; font-weight: 600;" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Add Discount</div>
                </div>
              </div>
              <div class="row card-body">
                <label for="payment_method">Payment Method</label>
                <div class="col-md-2">
                  <div class="form-check">
                    <label class="form-check-label" for="radioOption1">
                      Cash
                      <input class="form-check-input" onclick="payment_type(this.value)" type="radio" name="radioGroup" checked id="radioOption1" value="Cash">
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <label class="form-check-label" for="radioOption2">
                      Card
                      <input class="form-check-input" onclick="payment_type(this.value)" type="radio" name="radioGroup" id="radioOption2" value="Card">
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <label class="form-check-label" for="radioOption4">
                      Phonepe
                      <input class="form-check-input" onclick="payment_type(this.value)" type="radio" name="radioGroup" id="radioOption4" value="Phonepe">
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <label class="form-check-label" for="radioOption5">
                      NEFT/RTGS
                      <input class="form-check-input" onclick="payment_type(this.value)" type="radio" name="radioGroup" id="radioOption5" value="NEFT/RTGS">
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <label class="form-check-label" for="radioOption6">
                      Shoutlo
                      <input class="form-check-input" onclick="payment_type(this.value)" type="radio" name="radioGroup" id="radioOption6" value="Shoutlo">
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-check">
                    <label class="form-check-label" for="radioOption7">
                      Razorpay
                      <input class="form-check-input" onclick="payment_type(this.value)" type="radio" name="radioGroup" id="radioOption7" value="Razorpay">
                    </label>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ticket Items</h4>
                  <div class="table-responsive" id="ticket">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Items
                          </th>
                          <th class="d-flex justify-content-center align-items-center">
                            Quantity
                          </th>
                          <th>
                            Price / Ticket
                          </th>
                          <th>
                            Discount
                          </th>
                          <th>
                            Total Ticket Price
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody id="add_item">
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>
                            <p>IGST</p>
                          </th>
                          <th class="d-flex justify-content-center align-items-center">
                            <p>18%</p>
                          </th>
                          <th>
                            ₹<z id="igst_amount">00.00</z>
                          </th>
                          <th>
                          </th>
                          <th>
                          </th>
                        </tr>
                        <tr>
                          <th>
                            <p>Total</p>
                          </th>
                          <th>
                          </th>
                          <th>
                          </th>
                          <th>
                            ₹<z id="bill_total">00.00</z>
                          </th>
                          <th>
                          </th>
                        </tr>
                        <tr>
                          <td>
                            <button onclick="onSubmitButton('ticket')" class="btn btn-inverse-primary col-md-12"><i class="mdi mdi-download"></i> Save & Print</button>
                            <?php if ($user_type == 'superadmin') { ?><button onclick="printDivc('printed')" class="btn btn-inverse-info col-md-12"> <i class="mdi mdi-printer"></i> Print</button><?php } ?>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="printed" style="display: none;">
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
              <div class="col-6">
                <p>
                  <label>Legal Name:</label>
                  <label for="" id="bill_username"></label>
                </p>
              </div>
              <div class="col-6">
                <p>
                  <label>GST Number:</label>
                  <label for="" id="bill_gst_number"></label>
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
                  <?= date('d/m/Y H:i') ?>
                </p>
              </div>
              <div class="col">
              </div>
            </div>
            <div class="row" style="margin-top: -15px">
              <div class="col">
                <p>
                  <label for="">Cashier: </label>
                  <label for=""><?= $username ?></label>
                </p>
              </div>
              <div class="col">
                <p>
                  <label for="">Bill no.</label>
                  <label for="" id="bill_invoice"></label>
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
              <tbody id="new_bill_row">
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
                <tr>
                  <th scope="row">IGST</th>
                  <td>18%</td>
                  <td id="igst_print"></td>
                </tr>
                <tr style="border-top: 2px solid #000; border-bottom: 2px solid #000;">
                  <th></th>
                  <td>
                    <h3>Grand Total:</h3>
                  </td>
                  <td id="print_grand_total"></td>
                </tr>
                <tr>
                  <th scope="row">Paid Via: <z id="paid_via"></z>
                  </th>
                  <td id="paid_via"></td>
                  <th></th>
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
        </div>
        <script>
          function payment_type(val) {
            document.getElementById("paid_via").innerText = val;
          }

          function updatePrice() {
            var elements = document.getElementsByClassName("bill_quantity");
            if (elements.length > 0) {
              var firstElement = elements[0];
              var elementId = firstElement.id;
              elementId = elementId.toString();
              elementId = elementId.slice(13, 33);
            } else {
              location.reload();
            }
            var str = document.getElementById("bill_quantity" + elementId).value;
            billTotal(str, elementId);
          }

          var at = 0;
          var at_id = 0;
          var wt = 0;
          var wt_id = 0;
          var caw = 0;
          var acw_id = 0;
          var ymc = 0;
          var ymc_id = 0;
          var ymf = 0;
          var ymf_id = 0;
          var price = "";

          function changeprice(val) {
            if (document.getElementById("ticket_types").innerText != null) {
              const package_name = document.querySelectorAll("#ticket_types");
              // Get the first element using index
              var selectedTicket = package_name[val].innerText;

              if (selectedTicket == "AMUSEMENT") {
                if (at <= 0) {
                  price = "508.47";
                  document.getElementById(val).style =
                    "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
                  at_id = addRow();
                  at = 1;
                } else {
                  add_item(at_id);
                }
              } else if (selectedTicket == "WUNDER WATER") {
                if (wt <= 0) {
                  price = "1059.32";
                  document.getElementById(val).style =
                    "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
                  wt_id = addRow();
                  wt = 1;
                } else {
                  add_item(wt_id);
                }
              } else if (selectedTicket == "COMBO") {
                if (caw <= 0) {
                  price = "1101.69";
                  document.getElementById(val).style =
                    "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
                  caw_id = addRow();
                  caw = 1;
                } else {
                  add_item(caw_id);
                }
              } else if (selectedTicket == "Couple") {
                if (ymc <= 0) {
                  price = "5076.27";
                  document.getElementById(val).style =
                    "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
                  ymc_id = addRow();
                  ymc = 1;
                } else {
                  add_item(ymc_id);
                }
              } else if (selectedTicket == "Family") {
                if (ymf <= 0) {
                  price = "9313.56";
                  document.getElementById(val).style =
                    "box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;";
                  ymf_id = addRow();
                  ymf = 1;
                } else {
                  add_item(ymf_id);
                }
              }

              function addRow() {
                var id = Math.random(10);
                // document.getElementById('add_item').innerHTML += '<tr id="' + id + '"><td id="package_name">' + selectedTicket + '</td><td><div class="row"><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="add_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-plus"></i></button></div><div class="col-md-8 d-flex justify-content-center align-items-center"><input type="number" min="1" value="1" name="bill_quantity" id="bill_quantity' + id + '" onchange="billTotal(this.value, ' + id + ')" class="form-control form-control-lg"></div><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="subtract_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-minus"></i></button></div></div></td><td><p class="">₹ <z id="package_price' + id + '">' + price + '</z></p></td><td><p class="">₹ <z id="total_ticket_price' + id + '"></z></p></td><td><button type="button" onclick="remove_item(' + id + ')" class="btn btn-inverse-danger btn-sm btn-rounded btn-icon"><i class="mdi mdi-close"></i></button></td></tr>';
                // Create a new element
                document.getElementById("new_bill_row").innerHTML +=
                  '<tr class="service" id="' +
                  id +
                  '"><td class="tableitem" id="package_name_new"><p class="itemtext">' +
                  selectedTicket +
                  '</p></td><td class="tableitem"><p class="itemtext" id="print_bill_quantity' +
                  id +
                  '"></p></td><td class="tableitem"><p class="itemtext">₹ ' +
                  price +
                  '</p></td><td class="tableitem"><p class="itemtext" id="print_ticket_discount' +
                  id +
                  '"></p></td><td class="tableitem"><p class="itemtext" id="print_ticket_price' +
                  id +
                  '">₹00.00</p></td>';
                var newElement = document.createElement("tr");
                var myContainer = document.getElementById("add_item");
                newElement.innerHTML =
                  '<td id="package_name">' +
                  selectedTicket +
                  '</td><td><div class="row"><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="add_item(' +
                  id +
                  ')" class="btn btn-inverse-dark btn-sm btn-rounded btn-icon"><i class="mdi mdi-plus"></i></button></div><div class="col-md-8 d-flex justify-content-center align-items-center"><input type="number" min="1" value="1" name="bill_quantity" id="bill_quantity' +
                  id +
                  '" onchange="billTotal(this.value, ' +
                  id +
                  ')" class="form-control form-control bill_quantity"></div><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="subtract_item(' +
                  id +
                  ')" class="btn btn-inverse-dark btn-sm btn-rounded btn-icon"><i class="mdi mdi-minus"></i></button></div></div></td><td><p class="">₹<span id="package_price' +
                  id +
                  '">' +
                  price +
                  '</span></td><td><p class=""><div class="input-group"><input id="package_discount_inclusive' +
                  id +
                  '" type="number" class="form-control" onblur="getDisccount(' +
                  id +
                  ", " +
                  price +
                  ',this.value)" min="0" max="' +
                  price +
                  '" placeholder="00.00" step="0.01"></td><td><p class="">₹ <z id="total_ticket_price' +
                  id +
                  '"></z></p></td><td><button type="button" onclick="remove_item(' +
                  id +
                  ')" class="btn btn-inverse-danger btn-sm btn-rounded btn-icon"><i class="mdi mdi-close"></i></button></td>';
                newElement.id = id;
                // Append the new element to the container
                myContainer.appendChild(newElement);
                billTotal(1, id);
                return id;
              }
            }
          }

          function getDisccount(id, price, discount) {
            var bill_quantity_discount = document.getElementById(
              "bill_quantity" + id
            ).value;
            console.log("Disccount Price: " + discount);
            if (discount > price) {
              document.getElementById(
                "package_discount_inclusive" + id
              ).style.borderColor = "red";
            } else {
              document.getElementById(
                "package_discount_inclusive" + id
              ).style.borderColor = "";
              billTotal(bill_quantity_discount, id);
            }
          }

          function billTotal(str, id) {
            str = str.toString();
            var finalvalue = 0;
            var print_bill_quantity_final = 0;
            if (str.length > 0) {
              var quantity = str;
            }
            var package_price = document.getElementById("package_price" + id).innerText;
            var total = package_price * quantity;
            // GST rate (in decimal form)
            const gstRate = 0.18;

            // Calculate GST amount
            var newAmount = total * gstRate;
            var gstAmount = newAmount / 2;
            // Calculate total value including GST
            var totalValue = total + newAmount;

            console.log("totalValue amount : " + totalValue);
            var package_discount_inclusive = document.getElementById(
              "package_discount_inclusive" + id
            ).value;
            package_discount_inclusivestr = package_discount_inclusive.toString();
            if (package_discount_inclusivestr.length > 0) {
              var package_discount_inclusive_final =
                package_discount_inclusive * quantity;
              totalValue = totalValue - package_discount_inclusive_final;
            } else {
              var total = package_price * quantity;
            }
            var package_price = document.getElementById("package_price" + id).innerText;
            var total = package_price * quantity;

            totalValue = Math.round(totalValue, 3);
            var discount = document.getElementById("discount").value;
            if (discount.length > 0) {
              totalValue = totalValue - discount;
            }
            console.log(totalValue);

            gstAmount = gstAmount.toFixed(2);
            var mathtotal = total;
            document.getElementById("total_ticket_price" + id).innerText = totalValue;
            var add_amount = document.querySelectorAll("[id^='total_ticket_price']");
            add_amount.forEach((add_amount) => {
              finalvalue += parseInt(add_amount.innerText);
            });

            function calculateExcludingGST(totalAmount, gstPercentage) {
              var excludingGST = totalAmount / (1 + gstPercentage / 100);
              return excludingGST.toFixed(0);
            }

            // Example usage
            var totalAmount = finalvalue; // Total amount including GST
            var gstPercentage = 18; // GST percentage

            var excludingGST = calculateExcludingGST(totalAmount, gstPercentage);
            var newAmount = calculateExcludingGST(totalAmount, gstPercentage);
            excludingGST = excludingGST * 0.18;
            excludingGST = excludingGST.toFixed(2);

            document.getElementById("igst_amount").innerHTML = excludingGST;
            document.getElementById("bill_total").innerHTML = finalvalue;
            document.getElementById("print_ticket_price" + id).innerText =
              "₹" + totalValue;
            document.getElementById("print_ticket_discount" + id).innerText =
              package_discount_inclusive;
            document.getElementById("print_bill_quantity" + id).innerText =
              "x" + quantity;
            document.getElementById("igst_print").innerText = "₹" + excludingGST;
            document.getElementById("print_grand_total").innerText = "₹" + finalvalue;
            document.getElementById("gstAmount_fill").innerText = "₹" + newAmount;
            document.getElementById("bill_invoice").innerText =
              document.getElementById("bill_invoice_value").value;
            var print_bill_quantity1 = document.querySelectorAll("[id^='bill_quantity']");
            print_bill_quantity1.forEach((print_bill_quantity1) => {
              print_bill_quantity_final += parseInt(print_bill_quantity1.value);
            });
            console.log(print_bill_quantity_final);
            document.getElementById("ttl_quantity").innerText = print_bill_quantity_final;

            var radioButtons = document.getElementsByName("radioGroup");

            for (var i = 0; i < radioButtons.length; i++) {
              if (radioButtons[i].checked) {
                var selectedValue = radioButtons[i].value;
                document.getElementById("paid_via").innerText = selectedValue;
                break;
              }
            }
          }

          function printDivc(divname) {
            var contentDiv = document.getElementById(divname);

            // Get the HTML content
            var htmlContent = contentDiv.innerHTML;

            // Get the CSS styles
            var styleContent = "";
            var styleTags = contentDiv.getElementsByTagName("style");
            for (var i = 0; i < styleTags.length; i++) {
              styleContent += styleTags[i].innerHTML;
            }
            // Create a new window
            var newWindow = window.open("", "_blank");
            var style =
              '<link rel="stylesheet" type="text/css" href="./test.css"></link></head>';
            // Set the content of the new page
            newWindow.document.open();
            newWindow.document.write(
              "<!DOCTYPE html><html><head><title>Invoice</title><link rel='stylesheet' type='text/css' href='./test.css'></link></head>" +
              "<style>* {font-weight: 700 !important;}.line {height: 1px;color: black;width: 100%;background-color: black;border: 1px solid black;}hr {height: 3px;color: black;background-color: black;}.details {border: 0px;}th {font-weight: 400;}tr {border-bottom: 1px solid black;}</style><body>" +
              htmlContent + "</body></html><script>window.onload = function () { window.print() }"
            );
            newWindow.onload = function() {
              newWindow.print();
            };
            newWindow.document.close();
          }

          function removeToCart() {
            remove = document.querySelectorAll("#delete");
            remove.forEach((box) => {
              box.remove();
            });
            document.getElementById("product_total").innerHTML = "";
          }

          let numberValue = 0;
          const myObj = [];

          function addToCart() {
            var product_name = document.getElementById("product_name");
            var product_quantity = document.getElementById("product_quantity").value;
            var [product_name, product_price] =
            product_name.options[product_name.selectedIndex].text.split(" || ₹ ");
            document.getElementById("bill_prod").innerHTML +=
              '<div class="col-xl-10" id="delete"><p id="arrText">' +
              product_name +
              '</p></div><div id="delete" class="col-xl-2"><p class="float-end" id="arrVal">X' +
              product_quantity +
              "</p></div>";
            var sum = product_quantity * product_price;
            const myPara = document.getElementById("product_total");
            if (myPara.innerHTML.length > 0) {
              // Get the value of the innerHTML and convert it to a number
              var innerValue = parseInt(myPara.innerHTML);
              sum = innerValue + sum;
            }
            document.getElementById("product_total").innerHTML = sum;
            var str = document.getElementById("bill_quantity").innerHTML;

            billTotal(str);

            var product_id = document.getElementById("product_name").value;
            myObj[product_id] = product_quantity + "," + product_name;
            var new_obj = myObj.join(",");
          }

          const tickets_name = [];
          const quantity_name = [];

          function onSubmitButton() {
            var username = document.getElementById("username").value;
            var gst_number = document.getElementById("gst_number").value;
            var client_code = document.getElementById("client_code").value;
            var email = document.getElementById("email").value;
            var mobile = document.getElementById("mobile").value;
            var discount = document.getElementById("discount").value;
            var payment_method = document.getElementById("paid_via").innerText;
            var date = document.getElementById("date").value;
            var created_by = document.getElementById("created_by").value;

            const ticketsname = Array.from(document.querySelectorAll("#package_name"));
            const tickets_name = ticketsname
              .map((element) => element.innerHTML)
              .join(",");
            const quantityname = Array.from(
              document.querySelectorAll('[id^="bill_quantity"]')
            );
            const quantity_name = quantityname.map((element) => element.value).join(",");
            console.log(quantity_name.length);
            if (quantity_name.length > 0) {
              // Create a new XMLHttpRequest object
              const xhr = new XMLHttpRequest();
              // Define the AJAX request
              xhr.open(
                "GET",
                "./helpers/b2b.php?username=" +
                username +
                "&&gst_number=" +
                gst_number +
                "&&payment_method=" +
                payment_method +
                "&&ticket_check_in_date=" +
                date +
                "&&discount=" +
                discount +
                "&&ticket_types=" +
                tickets_name +
                "&&email=" +
                email +
                "&&phone=" +
                mobile +
                "&&client_code=" +
                client_code +
                "&&quantity=" +
                quantity_name +
                "&&created_by=" +
                created_by
              );
              xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                  const response = xhr.responseText;
                  document.getElementById("notification").innerHTML = response;
                  // Do something with the response data
                }
              };
              // Send the AJAX request with the data
              xhr.send();
              printDivc("printed");
            } else {
              alert("Please Select a ticket.");
            }
          }

          function getUsername(str) {
            var username = str;
            document.getElementById("bill_username").innerText = username;
          }

          function getGST(str) {
            var gst_number = str;
            document.getElementById("bill_gst_number").innerHTML = gst_number;
          }

          function getEmail(str) {
            var email = str;
            document.getElementById("bill_email").innerHTML = email;
          }

          function getMobile(str) {
            var mobile = str;
            document.getElementById("bill_mobile").innerHTML = mobile;
          }

          function add_item(id) {
            var newValue = document.getElementById("bill_quantity" + id).value++;
            newValue++;
            if (newValue >= 0) {
              billTotal(newValue, id);
            }
          }

          function subtract_item(id) {
            var newValue = document.getElementById("bill_quantity" + id).value;
            if (newValue > 1) {
              var newValue = document.getElementById("bill_quantity" + id).value--;
              newValue--;
              newValue = newValue.toString();
              billTotal(newValue, id);
            }
          }

          function remove_item(id) {
            if (id == at_id) {
              document.getElementById("0").style.boxShadow = "none";
              at_id = 0;
              at = 0;
              document.getElementById(id).remove();
              var newValue = 0;
              newValue = newValue.toString();
            } else if (id == wt_id) {
              document.getElementById("1").style.boxShadow = "none";
              wt_id = 0;
              wt = 0;
              document.getElementById(id).remove();
              var newValue = 0;
              newValue = newValue.toString();
            } else if (id == caw_id) {
              document.getElementById("2").style.boxShadow = "none";
              caw_id = 0;
              caw = 0;
              document.getElementById(id).remove();
              var newValue = 0;
              newValue = newValue.toString();
            } else if (id == ymc_id) {
              document.getElementById("3").style.boxShadow = "none";
              ymc_id = 0;
              ymc = 0;
              document.getElementById(id).remove();
              var newValue = 0;
              newValue = newValue.toString();
            } else if (id == ymf_id) {
              document.getElementById("4").style.boxShadow = "none";
              ymf_id = 0;
              ymf = 0;
              document.getElementById(id).remove();
              var newValue = 0;
              newValue = newValue.toString();
            }
            updatePrice();
          }
        </script>
        <?php include('./components/footer.php') ?>
        <?php include('./components/scripts.php') ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>