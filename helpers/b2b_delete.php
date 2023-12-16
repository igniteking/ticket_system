<?php include('../connections/connection.php');
$ticket_code = $_GET['ticket_code'];
$query = mysqli_query($conn, "DELETE FROM `b2b_ticket` WHERE ticket_code = '$ticket_code'");
if ($query) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=./b2b_list.php?status=1\">";
}
