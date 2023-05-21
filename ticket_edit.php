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
                                        <?php } else { ?>
                                            <div class="row">
                                                <div class="col-lg-7 d-flex flex-column">
                                                    <div class="row flex-grow">
                                                        <div class="col-12 col-lg-12 col-lg-12 grid-margin stretch-card">
                                                            <div class="card card-rounded">
                                                                <div class="card-body">
                                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                                        <div>
                                                                            <h4 class="card-title card-title-dash">Create Ticket</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div id="notification"></div>
                                                                    <div class="row">
                                                                        <?php
                                                                        $ticket_code_get = $_GET['ticket_code'];
                                                                        $fetch_ticket_data = mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_code = '$ticket_code_get'");
                                                                        while($rows = mysqli_fetch_array($fetch_ticket_data)){
                                                                            $username_get = $_GET['username'];
                                                                        }
                                                                        ?>
                                                                        <div class="form-group col-md-4">
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
                                                                            <input type="number" class="form-control form-control-lg col-md-4" id="quantity" onchange="billTotal(this.value)" name="quantity" placeholder="Quantity">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="date">Check-In Date</label>
                                                                            <input type="date" class="form-control form-control-lg col-md-4" id="date" name="ticket_check_in_date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" placeholder="Check-In Date">
                                                                        </div>

                                                                        <label for="">Add Product(s) </label>
                                                                        <div class="form-group col-md-5">
                                                                            <select class="js-example-basic-multiple w-100 form-control-lg" name="product_name" id="product_name">
                                                                                <?php $get_category = mysqli_query($conn, "SELECT * FROM product");
                                                                                while ($row = mysqli_fetch_array($get_category)) {
                                                                                    $product_id = $row['product_id'];
                                                                                    $product_name = $row['product_name'];
                                                                                    $product_price = $row['product_price'];
                                                                                    echo '
                                                                                    <option value="' . $product_id . '">' . $product_name . '/' . $product_price . '</option>
                                                                                    ';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <input type="number" class="form-control form-control-lg" id="product_quantity" name="product_quantity">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="text-white btn btn-lg btn-primary" onclick="addToCart()" name="">+</div>

                                                                            <div class="text-white btn btn-lg btn-danger" onclick="removeToCart()" name="">-</div>
                                                                        </div>
                                                                        <div id="product_demo"></div>
                                                                        <div class="form-group">
                                                                            <input type="submit" name="create_user" onclick="onSubmitButton()" class="btn-lg btn btn-primary me-2 text-white col-md-12">
                                                                            <input type="reset" value="Cancel" class="btn-lg btn btn-outline-danger col-md-12">
                                                                        </div>
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
                                                                        <?php
                                                                        $fetch_ticket = mysqli_query($conn, "SELECT * FROM ticket");
                                                                        while ($row = mysqli_fetch_array($fetch_ticket)) {
                                                                        }
                                                                        ?>
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
                                                                                <p class="float-end">₹ <z id="package_price">00.00</z>
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
                                                                        <div id="bill_prod" class="row"></div>
                                                                        <div class="row">
                                                                            <div class="col-xl-10">
                                                                                <p>Products Total</p>
                                                                            </div>
                                                                            <div class="col-xl-2">
                                                                                <p class="float-end" id="product_total"></p>
                                                                            </div>
                                                                            <hr style="border: 2px solid black;">
                                                                            <div class="row text-black">
                                                                                <div class="col-xl-12">
                                                                                    <p class="float-end fw-bold">Total: ₹<z id="bill_total">00.00</z>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <hr style="border: 2px solid black;">
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
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function billTotal(str) {
                            if (str.length > 0) {
                                var quantity = str;
                            }
                            document.getElementById('bill_quantity').innerHTML = quantity;
                            var package_price = document.getElementById('package_price').innerHTML;
                            var product_total = document.getElementById('product_total').innerHTML;
                            console.log(product_total.length)
                            if (product_total.length > 0) {
                                var new_product_price = parseInt(product_total);
                                total = package_price * quantity;
                                total = total + new_product_price;
                            } else {
                                var total = package_price * quantity;
                            }
                            document.getElementById('bill_total').innerHTML = total;
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
                            var [product_name, product_price] = product_name.options[product_name.selectedIndex].text.split('/');
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
                            var ticket_types = document.getElementById('ticket_types').value;
                            var quantity = document.getElementById('product_quantity').value;
                            var date = document.getElementById('date').value;


                            // Create a new XMLHttpRequest object
                            const xhr = new XMLHttpRequest();

                            // Define the AJAX request
                            xhr.open("GET", "./helpers/process.php?username=" + username + "&&email=" + email + "&&phone=" + mobile + "&&client_code=" + client_code + "&&quantity=" + quantity + "&&product=" + myObj + "&&ticket_check_in_date=" + date);
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

                        function changeprice() {
                            var price = "";
                            if (document.getElementById('ticket_types').value != null) {
                                var package_name = document.getElementById('ticket_types').value;
                                if (package_name == "AMUSEMENT PARK") {
                                    price = "600.00";
                                } else if (package_name == "WUNDER WATER") {
                                    price = "1250.00";
                                } else if (package_name == "COMBO – AMUSEMENT PARK + WATER PARK") {
                                    price = "1300.00";
                                } else if (package_name == "Yearly Membership – Couple") {
                                    price = "5990.00";
                                } else if (package_name == "Yearly Membership – Family") {
                                    price = "10990.00";
                                }
                            }
                            document.getElementById('package_name').innerHTML = package_name;
                            document.getElementById('package_price').innerHTML = price;
                        }
                    </script>
                    <?php include('./components/footer.php') ?>
                    <?php include('./components/scripts.php') ?>