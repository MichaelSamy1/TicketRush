<?php
$conn = new mysqli("localhost", "root", "", "ticket");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check the entire POST data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (!isset($_POST['selectedSeats']) || !isset($_POST['event_id'])) {
        die("Error: 'selectedSeats' or 'event_id' key is missing in the POST data.");
    }

    $seats = $_POST['selectedSeats'];
    $event_id = intval($_POST['event_id']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        foreach ($seats as $seat_number) {
            // Debugging: Print the seat number and event_id
            echo "Booking seat: $seat_number for event: $event_id<br>";

            // Check if the seat is already booked
            $sql = "SELECT seat_id, is_booked FROM seat WHERE seat_number = '$seat_number' AND event_id = $event_id";
            echo "Executing SQL: $sql<br>"; // Debugging: Print the SQL query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if ($row['is_booked'] == 0) {
                    $seat_id = $row['seat_id'];
                    // Assume user_id is 1 for this example
                    $user_id = 1;
                    $update_seat = "UPDATE seat SET is_booked = 1 WHERE seat_id = $seat_id";
                    $book_seat = "INSERT INTO booking (id, seat_id) VALUES ($user_id, $seat_id)";

                    // Debugging: Print the update and insert queries
                    echo "Executing SQL: $update_seat<br>";
                    echo "Executing SQL: $book_seat<br>";

                    if (!$conn->query($update_seat) || !$conn->query($book_seat)) {
                        throw new Exception("Error booking seat $seat_number");
                    }
                } else {
                    throw new Exception("Seat $seat_number is already booked");
                }
            } else {
                throw new Exception("Seat $seat_number does not exist");
            }
        }
        // Commit the transaction
        $conn->commit();
        echo "success";
    } catch (Exception $e) {
        // Rollback the transaction
        $conn->rollback();
        echo $e->getMessage();
    }
}
$conn->close();
?>
