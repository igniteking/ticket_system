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
            <?php include('./components/sidebar.php');
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card" onclick="changeprice('0')">
                                <div class="card-body">
                                    <center>
                                        <h4 id="ticket_types">AMUSEMENT PARK</h4>
                                    </center>
                                </div>
                            </div>
                            <div class="card mt-4" onclick="changeprice('1')">
                                <div class="card-body">
                                    <center>
                                        <h4 id="ticket_types">WUNDER WATER</h4>
                                    </center>
                                </div>
                            </div>
                            <div class="card mt-4" onclick="changeprice('2')">
                                <div class="card-body">
                                    <center>
                                        <h4 id="ticket_types">COMBO – AMUSEMENT PARK + WATER PARK</h4>
                                    </center>
                                </div>
                            </div>
                            <div class="card mt-4" onclick="changeprice('3')">
                                <div class="card-body">
                                    <center>
                                        <h4 id="ticket_types">Yearly Membership – Couple</h4>
                                    </center>
                                </div>
                            </div>
                            <div class="card mt-4" onclick="changeprice('4')">
                                <div class="card-body">
                                    <center>
                                        <h4 id="ticket_types">Yearly Membership – Family</h4>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
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
                                                    <input type="number" class="form-control form-control-lg col-md-4" id="discount" name="discount" placeholder="Discount in INR">
                                                </div>
                                                <button type="button" onclick=" updatePrice()" class="btn btn-primary">Done</button>
                                            </div>
                                            <div class="modal-footer">
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
                                                    <div class="form-check">
                                                        <label class="form-check-label" for="radioOption1">
                                                            Cash
                                                            <input class="form-check-input" type="radio" name="radioGroup" checked id="radioOption1" value="Cash">
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <label class="form-check-label" for="radioOption2">
                                                            Card
                                                            <input class="form-check-input" type="radio" name="radioGroup" id="radioOption2" value="Card">
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <label class="form-check-label" for="radioOption3">
                                                            UPI
                                                            <input class="form-check-input" type="radio" name="radioGroup" id="radioOption3" value="UPI">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">Done</button>
                                            </div>
                                        </div>
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
                                                        <button onclick="printDivc('printed')" class="btn btn-inverse-info col-md-12"> <i class="mdi mdi-printer"></i> Print</button>
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
                    <div id="">
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
                            <z style="font-size:10px;" id="bill_username"></z>
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
                                            <h2></h2>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr class="tabletitle">
                                        <td>SGST</td>
                                        <td class="Rate">
                                            <h2>9%</h2>
                                        </td>
                                        <td class="payment" id="sgst_print">
                                            <h2></h2>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr class="tabletitle">
                                        <td>
                                            <h1>Grandtotal:</h1>
                                        </td>
                                        <td></td>
                                        <td class="payment">
                                            <h2 id="print_grand_total"></h2>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr class="tabletitle">
                                        <td>
                                            <h2>Paid Via Other</h2>
                                        </td>
                                        <td>
                                            <p id="paid_via"></p>
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
                </div><!--End Invoice-->
                <script type="text/javascript">
                    function updatePrice() {
                        var elements = document.getElementsByClassName('bill_quantity');
                        if (elements.length > 0) {
                            var firstElement = elements[0];
                            var elementId = firstElement.id;
                            elementId = elementId.toString();
                            elementId = elementId.slice(13, 33)
                            console.log('Element ID:', elementId);
                        } else {
                            console.log('No elements found with the class name:', elements);
                            location.reload();
                        }
                        var str = document.getElementById("bill_quantity" + elementId).value;
                        console.log("str " + str);
                        console.log("bill_quantity " + elementId)
                        billTotal(str, elementId)
                    }

                    function changeprice(val) {
                        var price = "";
                        if (document.getElementById('ticket_types').innerText != null) {
                            const package_name = document.querySelectorAll('#ticket_types');
                            // Get the first element using index
                            var selectedTicket = package_name[val].innerText;

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

                            function addRow() {
                                var id = Math.random(10);
                                // document.getElementById('add_item').innerHTML += '<tr id="' + id + '"><td id="package_name">' + selectedTicket + '</td><td><div class="row"><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="add_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-plus"></i></button></div><div class="col-md-8 d-flex justify-content-center align-items-center"><input type="number" min="1" value="1" name="bill_quantity" id="bill_quantity' + id + '" onchange="billTotal(this.value, ' + id + ')" class="form-control form-control-lg"></div><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="subtract_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-minus"></i></button></div></div></td><td><p class="">₹ <z id="package_price' + id + '">' + price + '</z></p></td><td><p class="">₹ <z id="total_ticket_price' + id + '"></z></p></td><td><button type="button" onclick="remove_item(' + id + ')" class="btn btn-inverse-danger btn-sm btn-rounded btn-icon"><i class="mdi mdi-close"></i></button></td></tr>';
                                // Create a new element
                                document.getElementById('new_bill_row').innerHTML += '<tr class="service" id="' + id + '"><td class="tableitem" id="package_name_new"><p class="itemtext">' + selectedTicket + '</p></td><td class="tableitem"><p class="itemtext" id="print_bill_quantity' + id + '"></p></td><td class="tableitem"><p class="itemtext">₹ ' + price + '</p></td><td class="tableitem"><p class="itemtext" id="print_ticket_price' + id + '">₹00.00</p></td></tr>';
                                var newElement = document.createElement("tr");
                                var myContainer = document.getElementById('add_item');
                                newElement.innerHTML = '<td id="package_name">' + selectedTicket + '</td><td><div class="row"><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="add_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-plus"></i></button></div><div class="col-md-8 d-flex justify-content-center align-items-center"><input type="number" min="1" value="1" name="bill_quantity" id="bill_quantity' + id + '" onchange="billTotal(this.value, ' + id + ')" class="form-control form-control-lg bill_quantity"></div><div class="col-md-2 d-flex justify-content-center align-items-center"><button type="button" onclick="subtract_item(' + id + ')" class="btn btn-inverse-dark btn-md btn-rounded btn-icon"><i class="mdi mdi-minus"></i></button></div></div></td><td><p class="">₹ <z id="package_price' + id + '">' + price + '</z></p></td><td><p class="">₹ <z id="total_ticket_price' + id + '"></z></p></td><td><button type="button" onclick="remove_item(' + id + ')" class="btn btn-inverse-danger btn-sm btn-rounded btn-icon"><i class="mdi mdi-close"></i></button></td>';
                                newElement.id = id;
                                // Append the new element to the container
                                myContainer.appendChild(newElement);
                                billTotal(1, id)
                            }
                        }
                        addRow();

                    }


                    function billTotal(str, id) {
                        str = str.toString();
                        var finalvalue = 0;
                        if (str.length > 0) {
                            var quantity = str;
                            console.log(quantity);
                        }
                        var package_price = document.getElementById('package_price' + id).innerText;

                        var total = package_price * quantity;

                        // GST rate (in decimal form)
                        const gstRate = 0.18;

                        // Calculate GST amount
                        var newAmount = total * gstRate;
                        var gstAmount = newAmount / 2;

                        // Calculate total value including GST
                        var totalValue = total + newAmount;

                        totalValue = Math.round(totalValue)
                        console.log(totalValue);
                        var discount = document.getElementById('discount').value;
                        console.log(discount)
                        if (discount.length > 0) {
                            totalValue = totalValue - discount;
                            console.log("Discounted price = " + totalValue);
                        }


                        gstAmount = Math.round(gstAmount)
                        var mathtotal = Math.round(total)
                        document.getElementById('total_ticket_price' + id).innerText = totalValue;
                        var add_amount = document.querySelectorAll("[id^='total_ticket_price']");
                        add_amount.forEach(add_amount => {
                            finalvalue += parseInt(add_amount.innerText);
                            console.log("add_amount = " + finalvalue)
                        });


                        document.getElementById('sgst_amount').innerHTML = gstAmount;
                        document.getElementById('cgst_amount').innerHTML = gstAmount;
                        document.getElementById('bill_total').innerHTML = finalvalue;
                        document.getElementById('print_ticket_price' + id).innerText = "₹" + mathtotal;
                        document.getElementById('print_bill_quantity' + id).innerText = "x" + quantity;
                        document.getElementById('cgst_print').innerText = "₹" + gstAmount;
                        document.getElementById('sgst_print').innerText = "₹" + gstAmount;
                        document.getElementById('print_grand_total').innerText = "₹" + finalvalue;
                        var radioButtons = document.getElementsByName('radioGroup');

                        for (var i = 0; i < radioButtons.length; i++) {
                            if (radioButtons[i].checked) {
                                var selectedValue = radioButtons[i].value;
                                console.log('Selected Value:', selectedValue);
                                document.getElementById('paid_via').innerText = selectedValue;
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

                        // Set the content of the new page
                        newWindow.document.open();
                        newWindow.document.write('<!DOCTYPE html><html><head><link rel="stylesheet" href="./style.css"></link></head><body>' + htmlContent + '</body></html>');
                        newWindow.onload = function() {
                            newWindow.print();
                        };
                        newWindow.document.close();
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

                    const tickets_name = [];
                    const quantity_name = [];

                    function onSubmitButton() {
                        var username = document.getElementById('username').value;
                        var client_code = document.getElementById('client_code').value;
                        var email = document.getElementById('email').value;
                        var mobile = document.getElementById('mobile').value;
                        var discount = document.getElementById('discount').value;
                        var payment_method = document.getElementById('paid_via').innerText;
                        var date = document.getElementById('date').value;


                        const ticketsname = Array.from(document.querySelectorAll('#package_name'));
                        const tickets_name = ticketsname.map(element => element.innerHTML).join(',');
                        const quantityname = Array.from(document.querySelectorAll('[id^="bill_quantity"]'));
                        const quantity_name = quantityname.map(element => element.value).join(',');

                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();

                        // Define the AJAX request
                        xhr.open("GET", "./helpers/process.php?username=" + username + "&&payment_method=" + payment_method + "&&ticket_check_in_date=" + date + "&&discount=" + discount + "&&ticket_types=" + tickets_name + "&&email=" + email + "&&phone=" + mobile + "&&client_code=" + client_code + "&&quantity=" + quantity_name);
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
                        printDivc('printed')

                    }

                    function getUsername(str) {
                        var username = str;
                        document.getElementById('bill_username').innerText = username;
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

                    function add_item(id) {
                        var newValue = document.getElementById('bill_quantity' + id).value++;
                        newValue++;
                        if (newValue >= 0) {
                            billTotal(newValue, id);
                        }
                    }

                    function subtract_item(id) {
                        var newValue = document.getElementById('bill_quantity' + id).value;
                        if (newValue > 1) {
                            var newValue = document.getElementById('bill_quantity' + id).value--;
                            newValue--;
                            newValue = newValue.toString();
                            console.log(newValue);
                            billTotal(newValue, id);
                        }
                    }

                    function remove_item(id) {
                        document.getElementById(id).remove();
                        var newValue = 0;
                        newValue = newValue.toString()
                        updatePrice()
                    }
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>