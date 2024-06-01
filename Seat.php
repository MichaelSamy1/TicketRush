<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ticket");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
}

$event_id = $_GET['id'];
$sql = "SELECT * FROM seat WHERE event_id = $event_id";
$result = $conn->query($sql);

$seats = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seats[$row['seat_number']] = $row['is_booked'];
    }
} else {
    echo "No seats available for this event.";
    exit;
}

$seat_price = 200; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket Rush | Seat Select</title>
    <link rel="stylesheet" href="CSS/Seat.css">
    <style>
        .seat {
            width: 30px;
            height: 30px;
            border: 1px solid black;
            margin: 5px;
            display: inline-block;
            cursor: pointer;
        }
        .booked {
            background-color: gray;
            pointer-events: none;
        }
        .selected {
            background-color: blue;
        }
    </style>
</head>
<body>
    <section class="content">
        <main class="navbar">
            <div class="nav-center">
                <a href="Index.php">Ticket Rush</a>
            </div>
        </main>
    </section>

    <div class="title-right">
        <h2>اختيار المقاعد</h2>
    </div>

    <div class="center">
        <div class="tickets">
            <div class="ticket-selector">
                <div class="head">
                    <div class="title">رحلة 404</div>
                </div>

                <div class="seats">
                    <div class="status">
                        <div class="item">متاح</div>
                        <div class="item">محجوز</div>
                        <div class="item">مقعدك</div>
                    </div>

                    <label for="screen" class="screen">الشاشة</label>

                    <form method="POST" action="store_seats.php" id="seatForm">
    <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">
    <input type="hidden" name="total_price" id="total_price" value="0"> 
    <div class="all-seats">
        <?php
        $rows = 5; 
        $cols = 10; 
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $cols; $j++) {
                $seat_number = "R{$i}C{$j}";
                $is_booked = isset($seats[$seat_number]) && $seats[$seat_number];
                $class = $is_booked ? 'booked' : 'available';
                echo "<input type='checkbox' name='selectedSeats[]' id='s{$i}{$j}' value='{$seat_number}' class='seat-checkbox' " . ($is_booked ? 'disabled' : '') . "/>";
                echo "<label for='s{$i}{$j}' class='seat {$class}' data-seat-number='{$seat_number}'></label>";
            }
            echo "<br>";
        }
        ?>
    </div>
    <div class="price">
        <div class="total">
            <span> <span class="count">0</span> تذكرة </span>
            <div class="amount">0</div>
        </div>
        <div class="seemore_Book">
            <button type="submit" name="submit" value="submit" id="bookSeats" class="book">تأكيد المقاعد</button>
        </div>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>

    <hr class="solid">
    <section class="copyrights">
        <div class="p-left">
            <img src="photos/payments/Mastercard.png" alt="">
            <img src="photos/payments/Visa.png" alt="">
        </div>
        <div class="p-right">
            <h3><span>Ticket Rush</span>. كل الحقوق محفوظة © 2024</h3>
        </div>
    </section>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const seatsContainer = document.querySelector('.all-seats');
    const totalPriceInput = document.getElementById('total_price');

    const tickets = seatsContainer.querySelectorAll("input[name='selectedSeats[]']");
    tickets.forEach((ticket) => {
        ticket.addEventListener("change", () => {
            let amount = parseInt(document.querySelector(".amount").innerHTML);
            let count = parseInt(document.querySelector(".count").innerHTML);

            if (ticket.checked) {
                count += 1;
                amount += 200;
                ticket.nextElementSibling.classList.add('selected'); // Highlight the seat visually when selected
            } else {
                count -= 1;
                amount -= 200;
                ticket.nextElementSibling.classList.remove('selected'); // Remove highlight when deselected
            }
            document.querySelector(".amount").innerHTML = amount;
            document.querySelector(".count").innerHTML = count;
            totalPriceInput.value = amount; // Set the total price in the hidden input field
        });
    });
});
</script>
    
</body>
</html>
