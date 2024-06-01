<?php
// Start output buffering to prevent any output before header
ob_start();

$con = new mysqli("localhost", "root", "", "ticket");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

// Log the start of the script
error_log("store_seats.php started");

if (isset($_POST['selectedSeats'])) {
    $selected_seats = $_POST['selectedSeats'];
    $event_id = $con->real_escape_string($_POST['event_id']);
    $total_price = $con->real_escape_string($_POST['total_price']); // Get the total price

    $seat_numbers = array_map(function($seat) use ($con) {
        return "'" . $con->real_escape_string($seat) . "'";
    }, $selected_seats);
    
    $seat_list = implode(",", $seat_numbers);

    $sql = "UPDATE seat SET is_booked = 1 WHERE seat_number IN ($seat_list) AND event_id = $event_id";
    
    if ($con->query($sql) === TRUE) {
        // Successful booking, redirect to payment page with the total price
        header("Location: Paymento.php?total_price=$total_price");
        exit();
    } else {
        // Error occurred while updating record
        exit();
    }
} else {
    // No seats selected or invalid request
    exit();
}

$con->close();
?>
