<?php include('../connections/connection.php');
$client_code = $_GET['client_code'];
$query = mysqli_query($conn, "DELETE FROM `client` WHERE client_code = '$client_code'");
$query_ticket = mysqli_query($conn, "DELETE FROM `ticket` WHERE ticket_code = '$client_code'");
if ($query AND $query_ticket) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=./clients_list.php?status=1\">";
}
