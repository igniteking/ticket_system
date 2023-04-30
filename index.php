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
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total Admin</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `user_data` WHERE `user_type` = 'admin'"))); ?></h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Tickets</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `ticket`"))); ?></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>68.8</span></p>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Users</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `client`"))); ?></h3>
                                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Products</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `product`"))); ?></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-7 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 col-lg-12 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <?php if (@$_GET['status'] == 1) {
                                                                    echo '<div class="col-md-12 btn btn-success text-white">
                                                                    <h6 class="mt-2">Ceated Successfully!</h6>
                                                                    </div>';
                                                                } ?>
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Create Ticket</h4>
                                                                    </div>
                                                                    <div id="performance-line-legend"></div>
                                                                </div>

                                                                <?php

                                                                if (@$_POST['create_user']) {
                                                                    $post_username = $_POST['username'];
                                                                    $post_email = $_POST['email'];
                                                                    $post_phone = $_POST['phone'];
                                                                    $ticket_code = $_POST['ticket_code'];
                                                                    $quantity = $_POST['quantity'];
                                                                    $ticket_check_in_date = $_POST['ticket_check_in_date'];
                                                                    $created_at = date('Y-m-d H:i:s');
                                                                    $product = $_POST['product'];
                                                                    $N = count($product);
                                                                    for ($i = 0; $i < $N; $i++) {
                                                                        ($product[$i] . " ");
                                                                    }
                                                                    $final_product = implode(",", $product);
                                                                    $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM client WHERE email = '$email'"));
                                                                    $check_ticket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_user_email = '$email'"));
                                                                    if ($check_ticket <= 0) {
                                                                        if ($check_user <= 0) {
                                                                            $create_user = mysqli_query($conn, "INSERT INTO `client`(`client_code`, `username`, `email`, `phone`, `created_at`) VALUES ('$ticket_code', '$post_username','$post_email','$post_phone','$created_at')");
                                                                        }
                                                                        $create_ticket = mysqli_query($conn, "INSERT INTO `ticket`(`ticket_code`, `ticket_username`, `ticket_user_email`, `ticket_quantity`,`ticket_check_in_date`, `product_id`, `product_status`, `created_at`) VALUES ('$ticket_code','$post_username','$post_email','$quantity', '$ticket_check_in_date', '$final_product','pending', '$created_at')");
                                                                        if ($create_ticket) {
                                                                            echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.php?status=1\">";
                                                                        } else {
                                                                            echo '<div class="col-md-12 btn btn-danger text-white">
                                                                        <h6 class="mt-2">Error!</h6>
                                                                        </div>';
                                                                            echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.php\">";
                                                                        }
                                                                    } else {
                                                                        echo '<div class="col-md-12 btn btn-danger text-white">
                                                                        <h6 class="mt-2">Ticket For This User Already Exists!</h6>
                                                                        </div>';
                                                                        echo "<meta http-equiv=\"refresh\" content=\"2; url=./index.php\">";
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="row">
                                                                    <form action="./index.php" class="forms-sample mt-2 row" method="post">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="username">Username</label>
                                                                            <input type="hidden" name="ticket_code" id="ticket_code" value="<?= rand(); ?>">
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
                                                                        </div>
                                                                        <div class="form-group col-md-4">
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
                                                                        </div>
                                                                        <div class="form-group col-md-4">
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
                                                                        <div class="form-group col-md-4">
                                                                            <label for="ticket_types">Ticket Type</label>
                                                                            <input list="ticket_type" class="form-control form-control-lg col-md-4" id="ticket_types" name="ticket_type" placeholder="Ticket Type" onchange="changeprice()">
                                                                            <datalist id="ticket_type">
                                                                                <option value="AMUSEMENT PARK">
                                                                                <option value="WUNDER WATER">
                                                                                <option value="COMBO – AMUSEMENT PARK + WATER PARK">
                                                                                <option value="Yearly Membership – Couple">
                                                                                <option value="Yearly Membership – Family">
                                                                            </datalist>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="quantity">Quantity</label>
                                                                            <input type="number" class="form-control form-control-lg col-md-4" id="quantity" onchange="getQuantity(this.value)" name="quantity" placeholder="Quantity">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="date">Check-In Date</label>
                                                                            <input type="date" class="form-control form-control-lg col-md-4" id="date" name="ticket_check_in_date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" placeholder="Check-In Date">
                                                                        </div>

                                                                        <label for="product">Add Product(s) </label>
                                                                        <?php $get_category = mysqli_query($conn, "SELECT * FROM product");
                                                                        while ($row = mysqli_fetch_array($get_category)) {
                                                                            $product_id = $row['product_id'];
                                                                            $product_name = $row['product_name'];
                                                                            $product_price = $row['product_price'];
                                                                            @++$i;
                                                                            echo '
                                                                                <div class="form-group col-md-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-label">
                                                                                        <input type="checkbox" name="product[]" value="' . $product_id . '" onchange="getProduct(' . $product_price . ')" id="product" class="form-check-input">
                                                                                        ' . $product_name . '
                                                                                    </label>
                                                                                    </div>
                                                                                    </div>';
                                                                        }
                                                                        ?>
                                                                        <div id="product_demo"></div>
                                                                        <div class="form-group">
                                                                            <input type="submit" name="create_user" class="btn-lg btn btn-primary me-2 text-white col-md-12">
                                                                            <input type="reset" value="Cancel" class="btn-lg btn btn-outline-danger col-md-12">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-5 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div id="ticket" class="col-12 col-lg-12 col-lg-12 grid-margin stretch-card">
                                                        <div class="card">
                                                            <div class="card-body mx-4">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <ul class="list-unstyled row">
                                                                            <li class="text-muted mt-1 col-md-6"><span class="text-black">Invoice</span> #<z id="bill_invoice"></z>
                                                                            </li>
                                                                            <li id="bill_username" class="text-black col-md-6">Username</li>
                                                                            <li id="bill_email" class="text-black col-md-6">Email</li>
                                                                            <li id="bill_mobile" class="text-black col-md-6">Mobile</li>
                                                                            <li id="bill_date" class="text-black mt-1 col-md-6">Date</li>
                                                                        </ul>
                                                                        <hr>
                                                                        <div class="col-xl-10">
                                                                            <p id="package_name">Package Name</p>
                                                                        </div>
                                                                        <div class="col-xl-2">
                                                                            <p class="float-end">₹ <z id="package_price"> 00.00</z>
                                                                            </p>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-10">
                                                                            <p>Quantity</p>
                                                                        </div>
                                                                        <div class="col-xl-2">
                                                                            <p class="float-end" id="bill_quantity">00
                                                                            </p>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-10">
                                                                            <p>Products Total</p>
                                                                        </div>
                                                                        <div class="col-xl-2">
                                                                            <p class="float-end" id="bill_product">₹00.00</p>
                                                                        </div>
                                                                        <hr style="border: 2px solid black;">
                                                                        <div class="row text-black">
                                                                            <div class="col-xl-12">
                                                                                <p class="float-end fw-bold">Total: ₹<z id="bill_total">00.00</z>
                                                                                </p>
                                                                            </div>
                                                                            <hr style="border: 2px solid black;">
                                                                        </div>
                                                                        <div class="row">
                                                                            <button onclick="printDiv('ticket')" class="btn btn-outline-info">Print</button>
                                                                            <button onclick="DownloadPdf('ticket')" class="btn btn-outline-warning">Download</button>
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
                    <script type="text/javascript">
                        function getProduct(str) {
                            checkbox = document.getElementById("product");
                            var loop = document.querySelectorAll('#product').length
                            console.log(loop);
                            if (checkbox.checked == true) {
                                document.getElementById("bill_product").innerHTML = checkbox.value;
                                console.log(checkbox.value);
                            } else if (checkbox.checked == false) {
                                document.getElementById("bill_product").innerHTML = '';
                                console.log("unchecked");
                            }
                            // let product_price = "";
                            // new_product_price = product_price + str;
                            // console.log(new_product_price);
                            // document.getElementById("bill_product").innerHTML = '<div class="col-xl-2"><p class="float-end">' + new_product_price + "</p>";
                            // for (var i = 0; i < 4; i++) {
                            //     // product_price[i] = document.getElementById('product' + i).value;
                            // }
                        }

                        function DownloadPdf(divName) {
                            var a = document.body.appendChild(
                                document.createElement("a")
                            );
                            a.download = divName + ".html";
                            a.href = "data:text/html," + document.getElementById(divName).innerHTML;
                            a.click(); //Trigger a click on the element

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
                            var invoice = document.getElementById('ticket_code').value;
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

                        function changeprice() {
                            var price = "";
                            if (document.getElementById('ticket_types').value != null) {
                                var package_name = document.getElementById('ticket_types').value;
                                if (package_name == "AMUSEMENT PARK") {
                                    price = "600.00";
                                } else if (package_name == "WUNDER WATER") {
                                    price = "1,250.00";
                                } else if (package_name == "COMBO – AMUSEMENT PARK + WATER PARK") {
                                    price = "1,300.00";
                                } else if (package_name == "Yearly Membership – Couple") {
                                    price = "5,990.00";
                                } else if (package_name == "Yearly Membership – Family") {
                                    price = "10,990.00";
                                }
                            }
                            document.getElementById('package_name').innerHTML = package_name;
                            document.getElementById('package_price').innerHTML = price;
                        }

                        function getQuantity(str) {
                            var quantity = str;
                            document.getElementById('bill_quantity').innerHTML = quantity;
                        }

                        document.getElementById("ticket_types").oninput = function() {
                            if (document.getElementById('quantity').value != null && document.getElementById('ticket_types').value != null) {
                                function billTotal() {
                                    let quantity = document.getElementById('quantity').value;
                                    let package_price = document.getElementById('package_price').innerHTML;
                                    console.log(package_price);
                                    console.log(quantity);
                                    var total_price = package_price * quantity;
                                    document.getElementById('bill_total').innerHTML = total_price;
                                }
                                billTotal()
                            }
                        }
                        document.getElementById("quantity").oninput = function() {
                            if (document.getElementById('quantity').value != null && document.getElementById('ticket_types').value != null) {
                                function billTotal() {
                                    let quantity = document.getElementById('quantity').value;
                                    let package_price = document.getElementById('package_price').innerHTML;
                                    console.log(package_price);
                                    console.log(quantity);
                                    var total_price = package_price * quantity;
                                    document.getElementById('bill_total').innerHTML = total_price;
                                }
                                billTotal()
                            }
                        }
                    </script>
                    <?php include('./components/footer.php') ?>
                    <?php include('./components/scripts.php') ?>