<?php
$filename = 'export_ticket ' . date('Y-m-d') . '.csv';
$export_data = unserialize($_POST['export_data']);
$heading_arr = array(
    "Ticket Id", "Name", "Email", "QTY", "Type", "CheckIn Date", "Discount",
    "Discount/ticket", "Total Price", "GST (9%)", "Method", "Ticket Status", "Date"
);

// File creation
$file = fopen($filename, "w");

// Add the header to the CSV
fputcsv($file, $heading_arr);

// Add the data
foreach ($export_data as $line) {
    fputcsv($file, $line);
}

fclose($file);

// Download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/csv; ");
readfile($filename);

// Delete the file
unlink($filename);

exit();
?>
