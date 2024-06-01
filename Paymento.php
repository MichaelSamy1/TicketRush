<?php
$totalPrice = isset($_GET['total_price']) ? floatval($_GET['total_price']) : 0;
$taxRate = 0.10; // 10% tax
$totalPriceWithTax = $totalPrice * (1 + $taxRate);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/Payment.css">
    <title>Ticket Rush | Payment</title>
    <style>
        /* Your styles */
        .info {
            direction: rtl;
            max-width: 70%;
            margin: auto;
            padding: 0 20px 40px 20px;
        }
        .dashed {
            border: #ffffff 1px dashed;
            opacity: 20%;
            margin: 0 auto;
            max-width: 70%;
        }
        .info-p {
            padding: 20px 50px 20px 20px;
        }
        .main {
            background: linear-gradient(#202020, #111111);
        }
    </style>
    <script>
        function firststep(totalPrice) {
            const API = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2T1RjM01qUTJMQ0p1WVcxbElqb2lhVzVwZEdsaGJDSjkua2N1YmF0UThnbUpHZFJzRE00SlAzQ3hLTEJmMnBVeXk5ejVySDZsZjlYby1OaEdkZE1yQmZjSmFXZWp4Ync1dTF6dGJvZHQ4OFBtQzc2alJjcXRFaVE'; // Your API key here

            // Call the function with the calculated total price including tax
            scriptJSProcess(API, totalPrice);
        }
    </script>
</head>
<body>
    <section class="content">
        <main class="navbar">
            <div class="nav-center">
                <a href="Index.php">Ticket Rush</a>
            </div>
        </main>
    </section>

    <section class="main">
        <div class="title-right">
            <h2>المراجعة والدفع</h2>
        </div>

        <div class="info">
            <h3>معلومات عن الفيلم</h3>
            <div class="info-p">
                <p><b>فيلم:</b> كينغدوم اوف ذا بلانيت اوف ذا ايبس</p>
                <p><b>المكان:</b> سيتي سنتر الاسكندرية</p>
                <p><b>الوقت:</b> 11:00 مساء الاثنين 13 مايو 2024</p>
                <p><b>الصالة:</b> CINEMA 3</p>
                <p><b>المقاعد:</b> G-8</p>
            </div>

            <div class="Ticket-price">
                <h3><img src="photos/ticket.png" alt="ticket" style="width: 20px;"> تذكرة عادية</h3>
                <p><?php echo htmlspecialchars($totalPrice); ?> EGP</p>
            </div>
            <div class="Ticket-tax">
                <h5>+ ضريبة القيمة المضافة</h5>
                <p>10%</p>
            </div>
            <br>
            <div class="Total-price">
                <h3>اجمالي الطلب</h3>
                <p><?php echo htmlspecialchars(number_format($totalPriceWithTax, 2)); ?> EGP</p>
            </div>
        </div>

        <hr class="dashed">
        <button onclick="firststep('<?php echo htmlspecialchars($totalPriceWithTax); ?>')">اكمال الشراء</button>
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
    </section>

    <script src="script.js"></script>
</body>
</html>
