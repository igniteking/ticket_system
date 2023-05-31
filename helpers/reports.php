<?php
include('../connections/connection.php');
$ticket_type = $_GET['ticket_type'];
$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket"));
if ($check_user > 0) {
    if ($date_from and $date_to) {
        $fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'");
        $coubnts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at BETWEEN '$date_from' AND '$date_to'"));

        if ($fetch_data) {
            echo '
            <div class="table-responsive">
            <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Ticket Code</th>
                <th>Username</th>
                <th>User Email</th>
                <th>Quantity</th>
                <th>Type</th>
                <th>Check In Date</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>';
            while ($row = mysqli_fetch_array($fetch_data)) {
                $ticket_code = $row['ticket_code'];
                $ticket_username = $row['ticket_username'];
                $ticket_user_email  = $row['ticket_user_email'];
                $ticket_quantity  = $row['ticket_quantity'];
                $ticket_name  = $row['ticket_name'];
                $ticket_check_in_date  = $row['ticket_check_in_date'];
                $ticket_user_email  = $row['ticket_user_email'];
                $created_at = $row['created_at'];
                echo '
            <tr>
            
            <td class="">' . $ticket_code . '</td>
            <td class="">' . $ticket_username . '</td>
            <td class="">' . $ticket_user_email . '</span></td>
            <td class="">' . $ticket_quantity . '</span></td>
            <td class="">' . $ticket_name . '</span></td>
            <td class="">' . $ticket_check_in_date . '</span></td>
            <td class="">' . $created_at . '</span></td>
            </tr>';
            }
            echo '</tbody>
            </table>
            <div class="text-center mt-5">
                <h4> <label style="color:#E74C3C" for="Total">Total :</label>' . $coubnts . '</h4>
            </div>';
        }
    } else {
        echo '<div class="col-md-12 btn btn-warning text-white">
            <h6 class="mt-2">Input Required Feilds!</h6>
            </div></div>';
    }
} else {
    echo '<div class="col-md-12 btn btn-danger text-white">
        <h6 class="mt-2">No Entry Exists!</h6>
    </div>';
}
