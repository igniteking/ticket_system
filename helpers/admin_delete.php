<?php include('../connections/connection.php');
$admin_id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM `user_data` WHERE id = '$admin_id'");
if ($query) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=./admin_list.php?status=1\">";
}
