<?php include('../connections/connection.php');
$rowId = $_GET['ticket_id'];

$query = "SELECT * FROM ticket WHERE id = $rowId";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $deleteQuery = "DELETE FROM ticket WHERE id = $rowId";
    mysqli_query($conn, $deleteQuery);

    // // // Remove the primary key
    $updateQuery = "ALTER TABLE `waterpark`.`ticket` DROP PRIMARY KEY, MODIFY id INT NOT NULL";
    mysqli_query($conn, $updateQuery);

    $final = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `ticket`")) + 1;
    // Prepare the SQL query
    for ($i = $rowId; $i < $final; $i++) {
        $sqlUpdate = mysqli_query($conn, "UPDATE ticket SET id = $i  WHERE id = $i + 1");
    }

    $create  = mysqli_query($conn, "ALTER TABLE `ticket` ADD PRIMARY KEY(`id`);");
    $insert_key = mysqli_query($conn,  "ALTER TABLE `ticket` MODIFY `id` INT(11) NULL AUTO_INCREMENT;");

    echo 'Deleted!';
    echo "<meta http-equiv=\"refresh\" content=\"3; url=./ticket_list.php\">";
}
