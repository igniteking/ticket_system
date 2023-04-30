<?php include('../connections/connection.php');
$client_email = $_GET['client_email'];
$query = mysqli_query($conn, "DELETE FROM `client` WHERE email = '$client_email'");
if ($query) {
    // echo "<meta http-equiv=\"refresh\" content=\"0; url=./clients_list.php?status=1\">";
} else {
    echo 'eooro!';
}
