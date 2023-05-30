<?php include('../connections/connection.php');
$ticket_code = $_GET['ticket_code'];
$query = mysqli_query($conn, "UPDATE `ticket`SET `cancel_ticket` = '1' WHERE ticket_code = '$ticket_code'");
if ($query) {
    echo '<div class="col-md-12 btn btn-success text-white">Ticket Cancelled Successfully</div>';  
}
?>