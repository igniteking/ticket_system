<?php include('../connections/connection.php');
$ticket_code = $_GET['ticket_code'];
$user_type = $_GET['user_type'];
if($user_type == 'admin'){
    $query = mysqli_query($conn, "UPDATE `ticket`SET `cancel_ticket` = 'pending' WHERE ticket_code = '$ticket_code'");
} else {
    $query = mysqli_query($conn, "UPDATE `ticket`SET `cancel_ticket` = '1' WHERE ticket_code = '$ticket_code'");
}
if ($query) {
    echo '<div class="col-md-12 btn btn-success text-white">Ticket Cancelled Successfully</div>';  
    echo "<meta http-equiv=\"refresh\" content=\"3; url=./ticket_list.php\">";

}
