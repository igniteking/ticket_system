<?php
include('../connections/connection.php');
$post_username = $_GET['username'];
$post_email = $_GET['email'];
$post_phone = $_GET['phone'];
$client_code = $_GET['client_code'];
$quantity = $_GET['quantity'];
$discount = $_GET['discount'];
$payment_method = $_GET['payment_method'];
$ticket_types = $_GET['ticket_types'];
$product = array($_GET['product']);
($array = implode(",", $product));
$ticket_check_in_date = $_GET['ticket_check_in_date'];
$created_at = date('Y-m-d');

// // $product = $_GET['product_name'];
// $N = count($product);
// for ($i = 0; $i < $N; $i++) { // ($product[$i] . " " ); // } // $final_product=implode(",", $product); 
$check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM client WHERE email = '$email'"));
$check_ticket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_user_email = '$email'"));
if ($check_ticket <= 0) {
    if ($check_user <= 0) {
        $create_user = mysqli_query($conn, "INSERT INTO `client`(`client_code`, `username`, `email`, `phone`, `created_at`) VALUES ('$client_code', '$post_username','$post_email','$post_phone','$created_at')");
    }
    $create_ticket = mysqli_query($conn, "INSERT INTO `ticket`(`ticket_code`, `ticket_username`, `ticket_user_email`, `ticket_quantity`, `discount`, `payment_method`, `ticket_name`, `ticket_check_in_date`, `product_id`, `product_status`, `created_at`) VALUES ('$client_code','$post_username','$post_email','$quantity', '$discount', '$payment_method', '$ticket_types', '$ticket_check_in_date', '$array','pending', '$created_at')");
    if ($create_ticket) {
        echo '<div class="col-md-12 btn btn-success text-white">
            <h6 class="mt-2">Ceated Successfully!</h6>
            </div>';
    } else {
        echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">Error!</h6>
    </div>';
        echo "
    <meta http-equiv=\"refresh\" content=\"0; url=./index.php\">";
    }
} else {
    echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">Ticket For This User Already Exists!</h6>
    </div>';
    echo "
    <meta http-equiv=\"refresh\" content=\"2; url=./index.php\">";
}
