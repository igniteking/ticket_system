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
                                        <h4 id="ticket_types">COUPLE</h4>
                                    </center>
                                </div>
                            </div>
                            <div class="card mt-4 btn" id="4" onclick="changeprice('4')">
                                <div class="">
                                    <center>
                                        <h4 id="ticket_types">FAMILY</h4>
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
                                    <div type="button" class="card mt-4 bg-info text-white btn text-center" style="font-size: 17px; width: 100%; height: 60px; font-weight: 600;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add User Details</div>
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
                                                        <p>CGST</p>
                                                    </th>
                                                    <th class="d-flex justify-content-center align-items-center">
                                                        <p>9%</p>
                                                    </th>
                                                    <th>
                                                        ₹<z id="cgst_amount">00.00</z>
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <p>SGST</p>
                                                    </th>
                                                    <th class="d-flex justify-content-center align-items-center">
                                                        <p>9%</p>
                                                    </th>
                                                    <th>
                                                        ₹<z id="sgst_amount">00.00</z>
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
                                    <th scope="row">CGST</th>
                                    <td>9%</td>
                                    <td id="cgst_print"></td>
                                    <td id="hidden_print"></td>
                                </tr>
                                <tr>
                                    <th scope="row">SGST</th>
                                    <td>9%</td>
                                    <td id="sgst_print"></td>
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
</body>

</html>
<!--End Invoice-->
<script src="./b2b.js"></script>
<?php include('./components/footer.php') ?>
<?php include('./components/scripts.php') ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>