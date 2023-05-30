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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="statistics-title">Total Admin</p>
                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `user_data` WHERE `user_type` = 'admin'"))); ?></h3>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Total Food Stalls</p>
                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `user_data` WHERE `user_type` = 'food_stall'"))); ?></h3>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Total Tickets</p>
                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `ticket`"))); ?></h3>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Total Users</p>
                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `client`"))); ?></h3>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Total Products</p>
                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `product`"))); ?></h3>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Total Category</p>
                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `category`"))); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($user_type == 'food_stall') { ?>
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="card-body">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Ticket List (Food)</h4>
                                                <div class="row">
                                                    <form action="./index.php" method="get">
                                                        <div class="form-group row">
                                                            <div class="col-sm-9">
                                                                <input type="text" name="ticket_code" class="form-control" placeholder="Search Ticket Code" onblur="this.form.submit()" id="ticket_code">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <a href="./index.php" class="btn btn-outline-danger col-md-12">Reset</a>
                                                            </div>
                                                    </form>
                                                </div>
                                                <div id="notification"></div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Ticket Code</th>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th>Quantity / Food Item</th>
                                                                <th>Action(s)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ticket_code = @$_GET['ticket_code'];
                                                            if ($ticket_code) {
                                                                $get_client = mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_code LIKE '%$ticket_code%'");
                                                                $count = mysqli_num_rows($get_client);
                                                            } else {
                                                                $get_client = mysqli_query($conn, "SELECT * FROM ticket ORDER BY created_at ASC LIMIT 20");
                                                                $count = mysqli_num_rows($get_client);
                                                            }
                                                            while ($row = mysqli_fetch_array($get_client)) {
                                                                $ticket_code = $row['ticket_code'];
                                                                $ticket_username = $row['ticket_username'];
                                                                $ticket_user_email = $row['ticket_user_email'];
                                                                $ticket_quantity = $row['ticket_quantity'];
                                                                $product_id = $row['product_id'];
                                                                $product_status = $row['product_status'];
                                                                $explode = explode(',', $product_id);
                                                                $created_at = $row['created_at'];
                                                                if ($count = 0) {
                                                                    echo 'No user Found!';
                                                                } else {
                                                                    echo '<tr>
                                                                                <td>' . $ticket_code . '</td>
                                                                                <td>' . $ticket_username . '</td>
                                                                                <td>' . $ticket_user_email . '</td>
                                                                                <td><h1 class="display-5">';
                                                                    foreach ($explode as $key => $value) {
                                                                        if (@$i % 2 == 0) {
                                                                            echo $value . " " . "<br>";
                                                                        } else {
                                                                            echo $value . "x ";
                                                                        }
                                                                        @$i++;
                                                                    }
                                                                    echo '</h1></td>
                                                                                <td>'; ?>
                                                                    <form action="./index.php" method="GET">
                                                                        <select class="form-control-lg form-control" name="status" id="status" onchange="this.form.submit();">
                                                                            <option value="<?= $product_status ?>"><?= $product_status ?></option>
                                                                            <option value="completed">Completed</option>
                                                                        </select>
                                                                        <input type="hidden" name="ticket_code" value="<?= $ticket_code ?>">
                                                                    </form>
                                                            <?php echo '
                                                                                </td>
                                                                                </tr>';
                                                                }
                                                            }
                                                            if (@$_GET['status'] and @$_GET['ticket_code']) {
                                                                $status = $_GET['status'];
                                                                $ticket_code = $_GET['ticket_code'];
                                                                $update = mysqli_query($conn, "UPDATE `ticket` SET `product_status`='$status' WHERE ticket_code = '$ticket_code'");
                                                                if ($update) {
                                                                    echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.php\">";
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?><br>
                        <div class="row">
                            <div class="card col-md-2 mx-2" onclick="changeprice('0')">
                                <div class="card-body">
                                    <div class="card-heading">
                                        <center>
                                            <h4 id="ticket_types">AMUSEMENT PARK</h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-2 mx-2" onclick="changeprice('1')">
                                <div class="card-body">
                                    <div class="card-heading">
                                        <center>
                                            <h4 id="ticket_types">WUNDER WATER</h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-3 mx-2" onclick="changeprice('2')">
                                <div class="card-body">
                                    <div class="card-heading">
                                        <center>
                                            <h4 id="ticket_types">COMBO – AMUSEMENT PARK + WATER PARK</h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-2 mx-2" onclick="changeprice('3')">
                                <div class="card-body">
                                    <div class="card-heading">
                                        <center>
                                            <h4 id="ticket_types">Yearly Membership – Couple</h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-2 mx-2" onclick="changeprice('4')">
                                <div class="card-body">
                                    <div class="card-heading">
                                        <center>
                                            <h4 id="ticket_types">Yearly Membership – Family</h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6" id="mainbox" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex justify-content-between align-items-start">
                                            <div>
                                                <h4 class="card-title card-title-dash">Create Ticket</h4>
                                            </div>
                                        </div><br>
                                        <div id="notification"></div>
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add User Details</button>
                                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Add Payment Method</button>
                                        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Add Discount</button>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="username">Username</label>
                                                                <input type="hidden" name="client_code" id="client_code" value="<?= rand(); ?>">
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
                                                                <input type="number" class="form-control form-control-lg col-md-4" id="discount" name="discount" placeholder="Discount in INR">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary">Done</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Payment Method</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="payment_method">Payment Method</label>
                                                                <select class="form-control form-control-lg col-md-4" id="payment_method" name="payment_method">
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Card">Card</option>
                                                                    <option value="UPI">UPI</option>
                                                                    <option value="NEFT">NEFT</option>
                                                                    <option value="Due">Due</option>
                                                                    <option value="RTGS">RTGS</option>
                                                                    <option value="IMPS">IMPS</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary">Done</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control form-control-lg col-md-12" id="quantity" onchange="billTotal(this.value)" name="quantity" placeholder="Quantity">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="date">Check-In Date</label>
                                                <input type="date" class="form-control form-control-lg col-md-4" id="date" name="ticket_check_in_date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" placeholder="Check-In Date">
                                            </div>

                                            <div class="row">
                                                <label for="">Add Product(s) </label>
                                                <div class="form-group col-md-5">
                                                    <select class="js-example-basic-multiple w-100 form-control-lg" name="product_name" id="product_name">
                                                        <?php $get_category = mysqli_query($conn, "SELECT * FROM product");
                                                        while ($row = mysqli_fetch_array($get_category)) {
                                                            $product_id = $row['product_id'];
                                                            $product_name = $row['product_name'];
                                                            $product_price = $row['product_price'];
                                                            echo '
                                                        <option value="' . $product_id . '">' . $product_name . ' || ₹ ' . $product_price . '</option>
                                                        ';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="number" class="form-control form-control-lg" id="product_quantity" name="product_quantity">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="text-white btn btn-primary" onclick="addToCart()" name="">+</div>
                                                    <div class="text-white btn btn-danger" onclick="removeToCart()" name="">-</div>
                                                </div>
                                            </div>
                                            <div id="product_demo"></div>
                                            <div class="form-group">
                                                <input type="submit" name="create_user" onclick="onSubmitButton()" class="btn btn-primary text-white col-md-12">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="mainbox2" style="display: none;">
                                <div class="row flex-grow">
                                    <div id="ticket" class="col-12 col-lg-12 col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body mx-4">
                                                <div class="container">
                                                    <center>
                                                        <h4><b>Surya Funcity Limited</b></h4>
                                                    </center>
                                                    <h6 class="text-center">Vill Dafarpur, Chandigarh - Barwala Highway,<br> Distt SAS Nagar Mohali, Punjab - 140201</h6><br><br>
                                                    <?php
                                                    $fetch_ticket = mysqli_query($conn, "SELECT * FROM ticket");
                                                    while ($row = mysqli_fetch_array($fetch_ticket)) {
                                                    }
                                                    ?>
                                                    <div class="row">
                                                        <ul class="list-unstyled row">
                                                            <hr>
                                                            <li id="bill_username" class="text-black col-md-6">Username</li><br><br>
                                                            <hr>
                                                            <li id="bill_date" class="text-black mt-1 col-md-6">Date</li>
                                                            </li>
                                                            <li class="text-muted mt-1 col-md-6"><span class="text-black">Invoice</span> #<z id="bill_invoice"></z>
                                                            <li id="bill_email" class="text-black col-md-6">Email</li>
                                                            <li id="bill_mobile" class="text-black col-md-6">Mobile</li>
                                                        </ul>
                                                        <hr>
                                                        <div class="col-xl-5">
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <p>Quantity</p>
                                                        </div>
                                                        <div class="col-xl-2">
                                                            <p>Price</p>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <p id="package_name">Package Name</p>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <p id="">x<z id="bill_quantity">00</z>
                                                            </p>
                                                        </div>
                                                        <div class="col-xl-2">
                                                            <p class="">₹ <z id="package_price">00.00</z>
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
                                                        <div class="col-xl-5">
                                                            <p>CGST</p>
                                                        </div>
                                                        <div class="col-xl-2">
                                                            <p class="float-end">9%</p>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <p class="float-end" id="cgst_amount"></p>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <p>SGST</p>
                                                        </div>
                                                        <div class="col-xl-2">
                                                            <p class="float-end">9%</p>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <p class="float-end" id="sgst_amount"></p>
                                                        </div>

                                                        <hr style="border: 2px solid black;">

                                                        <div class="row text-black">
                                                            <div class="col-xl-12">
                                                                <p class="float-end fw-bold">Total: ₹<z id="bill_total">00.00</z>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 2px solid black;">
                                                        <center>
                                                            <h4>Thankyou</h4>
                                                        </center>
                                                        <h6 class="text-center text-muted">GST NO: 03AACCS2999FIZA <br> Bank Details: <br> Bank of India AC NO: 620225100001187 <br> Bank Of India, Sector 32, Chandigarh</h6><br><br>
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
            <?php } ?>
            <script type="text/javascript">
                function billTotal(str) {
                    if (str.length > 0) {
                        var quantity = str;
                    }
                    document.getElementById('bill_quantity').innerHTML = quantity;
                    var package_price = document.getElementById('package_price').innerHTML;
                    var product_total = document.getElementById('product_total').innerHTML;
                    var discount = document.getElementById('discount').value;
                    console.log(discount)
                    if (discount.length > 0) {
                        package_price = package_price - discount;
                    }
                    if (product_total.length > 0) {
                        var new_product_price = parseInt(product_total);
                        console.log(new_product_price)
                        var ticket_product_price = package_price * quantity;
                        console.log(ticket_product_price);

                        // GST rate (in decimal form)
                        const gstRate = 0.18;

                        // Calculate GST amount
                        var newAmount = ticket_product_price * gstRate;
                        var gstAmount = newAmount / 2;

                        // Calculate total value including GST
                        var totalValue = ticket_product_price + newAmount;

                        // addming price of products
                        totalValue = new_product_price + totalValue;
                        totalValue = Math.round(totalValue)
                        gstAmount = Math.round(gstAmount)
                        document.getElementById('sgst_amount').innerHTML = gstAmount;
                        document.getElementById('cgst_amount').innerHTML = gstAmount;
                        document.getElementById('bill_total').innerHTML = totalValue;

                    } else {
                        var total = package_price * quantity;

                        // GST rate (in decimal form)
                        const gstRate = 0.18;

                        // Calculate GST amount
                        var newAmount = total * gstRate;
                        var gstAmount = newAmount / 2;

                        // Calculate total value including GST
                        var totalValue = total + newAmount;

                        totalValue = Math.round(totalValue)
                        gstAmount = Math.round(gstAmount)

                        document.getElementById('sgst_amount').innerHTML = gstAmount;
                        document.getElementById('cgst_amount').innerHTML = gstAmount;
                        document.getElementById('bill_total').innerHTML = totalValue;

                    }

                }

                function removeToCart() {
                    remove = document.querySelectorAll('#delete');
                    remove.forEach(box => {
                        box.remove();
                    });
                    document.getElementById('product_total').innerHTML = '';
                }

                let numberValue = 0;
                const myObj = [];

                function addToCart() {
                    var product_name = document.getElementById('product_name');
                    var product_quantity = document.getElementById('product_quantity').value;
                    var [product_name, product_price] = product_name.options[product_name.selectedIndex].text.split(' || ₹ ');
                    document.getElementById('bill_prod').innerHTML += '<div class="col-xl-10" id="delete"><p id="arrText">' + product_name + '</p></div><div id="delete" class="col-xl-2"><p class="float-end" id="arrVal">X' + product_quantity + '</p></div>';
                    var sum = product_quantity * product_price;
                    const myPara = document.getElementById("product_total");
                    if (myPara.innerHTML.length > 0) {
                        // Get the value of the innerHTML and convert it to a number
                        var innerValue = parseInt(myPara.innerHTML);
                        sum = innerValue + sum;
                    }
                    document.getElementById('product_total').innerHTML = sum;
                    var str = document.getElementById('bill_quantity').innerHTML;

                    billTotal(str);

                    var product_id = document.getElementById('product_name').value;
                    myObj[product_id] = product_quantity + "," + product_name;
                    var new_obj = myObj.join(",")
                    console.log(new_obj);

                }

                function onSubmitButton() {
                    var client_code = document.getElementById('client_code').value;
                    var username = document.getElementById('username').value;
                    var email = document.getElementById('email').value;
                    var mobile = document.getElementById('mobile').value;
                    var ticket_types = document.getElementById('package_name').innerHTML;
                    var quantity = document.getElementById('product_quantity').value;
                    var date = document.getElementById('date').value;
                    var discount = document.getElementById('discount').value;
                    var payment_method = document.getElementById('payment_method').value;


                    // Create a new XMLHttpRequest object
                    const xhr = new XMLHttpRequest();

                    // Define the AJAX request
                    xhr.open("GET", "./helpers/process.php?username=" + username + "&&payment_method=" + payment_method + "&&discount=" + discount + "&&ticket_types=" + ticket_types + "&&email=" + email + "&&phone=" + mobile + "&&client_code=" + client_code + "&&quantity=" + quantity + "&&product=" + myObj + "&&ticket_check_in_date=" + date);
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

                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }


                function getUsername(str) {
                    var username = str;
                    document.getElementById('bill_username').innerHTML = username;
                    document.getElementById('bill_date').innerHTML = Date();

                }

                window.onload = function getInvoice() {
                    var invoice = document.getElementById('client_code').value;
                    document.getElementById('bill_invoice').innerHTML = invoice;
                }


                function getEmail(str) {
                    var email = str;
                    document.getElementById('bill_email').innerHTML = email;
                }

                function getMobile(str) {
                    var mobile = str;
                    document.getElementById('bill_mobile').innerHTML = mobile;
                }

                function changeprice(val) {
                    var price = "";
                    if (document.getElementById('ticket_types').innerText != null) {
                        const package_name = document.querySelectorAll('#ticket_types');
                        // Get the first element using index
                        var selectedTicket = package_name[val].innerText;
                        console.log(selectedTicket);

                        if (selectedTicket) {
                            document.getElementById('mainbox').style.display = 'block';
                            document.getElementById('mainbox2').style.display = 'block';
                        }

                        if (selectedTicket == "AMUSEMENT PARK") {
                            price = "508.47";
                        } else if (selectedTicket == "WUNDER WATER") {
                            price = "1059.32";
                        } else if (selectedTicket == "COMBO – AMUSEMENT PARK + WATER PARK") {
                            price = "1101.69";
                        } else if (selectedTicket == "Yearly Membership – Couple") {
                            price = "5076.27";
                        } else if (selectedTicket == "Yearly Membership – Family") {
                            price = "9313.56";
                        }
                    }

                    document.getElementById('package_name').innerHTML = selectedTicket;
                    document.getElementById('package_price').innerHTML = price;
                }
            </script>
            <?php include('./components/footer.php') ?>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <?php include('./components/scripts.php') ?>