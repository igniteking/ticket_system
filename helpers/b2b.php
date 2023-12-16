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
$gst_number = $_GET['gst_number'];
// $product = array($_GET['product']);
// ($array = implode(",", $product));
$ticket_check_in_date = $_GET['ticket_check_in_date'];
$created_at = date('Y-m-d');

// $product = $_GET['product_name'];
// $N = count($product);
// for ($i = 0; $i < $N; $i++) { // ($product[$i] . " " ); // } // $final_product=implode(",", $product); 
$check_ticket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM b2b_ticket WHERE ticket_code = '$client_code'"));
$check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buisness WHERE buisness_code = '$client_code'"));
if ($check_user == 0) {
    $create_user = mysqli_query($conn, "INSERT INTO `buisness`(`buisness_code`, `username`, `address`, `gst`, `created_at`) VALUES ('$client_code', '$post_username','$post_email','$gst_number','$created_at')");
}
if ($check_ticket >= 0) {
    $create_ticket = mysqli_query($conn, "INSERT INTO `b2b_ticket`(`ticket_code`, `gst`, `ticket_username`, `ticket_gst`, `ticket_quantity`, `discount`, `payment_method`, `ticket_name`, `ticket_check_in_date`, `product_id`, `product_status`, `created_at`) VALUES ('$client_code', '$gst_number', '$post_username','$post_phone', '$quantity', '$discount', '$payment_method', '$ticket_types', '$ticket_check_in_date', '','pending', '$created_at')");
    if ($create_ticket) {
        echo '<div class="col-md-12 btn btn-success text-white">
            <h6 class="mt-2">Ceated Successfully!</h6>
            </div>';
        echo "<meta http-equiv=\"refresh\" content=\"0; url=./b2b.php\">";
    } else {
        echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">Error!</h6>
    </div>';
        echo "<meta http-equiv=\"refresh\" content=\"0; url=./b2b.php\">";
    }
}
