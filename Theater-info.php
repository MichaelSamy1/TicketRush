<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <link rel="stylesheet" href="CinemaAR.css"> -->
    <link rel="stylesheet" href="CSS/Info_Page_AR.css">
    <title>Ticket Rush | Theater Info Page</title>
</head>
<body>
    <!-- Loading -->


    <section class="content">
        <!-- First Bar Contain left,right,center -->
        <main class="navbar">
            <!-- left Contain: Logo(Cinema Time Logo) -->
            <div class="nav-left">
                <a href="Log_in_Page.html">
                    <Button>تسجيل خروج</Button>
                </a>    
                <div class="search-container">
                    <span src="photos/search.png" onclick="toggleSearch()">
                        search
                    </span>
                    <input type="text" class="search-input" id="searchInput" placeholder="Search...">
                </div>
            </div>
            
            <!-- <div class="nav-list-phone">
                <select name="" id="">
                    <li>hello</li>
                    <li>my</li>
                    <li>game</li>
                    <li>two</li>
                </select>
            </div> -->

            <!-- Center Bar Contain: Main,movies,cinemas -->
            <div class="nav-center">
                <a href="Index.php">الرئيسية</a>
                <a href="Cinema_Page.php">السينما</a>
                <a href="Theater_Page.php" class="activehome">المسرح</a>
                <a href="Matches.php">المباريات</a>
                <a href="Events.php">الحفلات</a>
                <a href="Parks.php">الحدائق</a>
            </div>
            <!-- Right Bar Contain: Search,Log In -->
            <div class="nav-right">
                <a href="Index.php">Ticket Rush</a>
                
            </div>
        </main>
    </section>

    <?php
    $id=$_GET['id'];
    $con = new mysqli("localhost","root","","ticket");
                  if($con->connect_error){
                      die("failed to connect:".$con->connect_error);}
                      else{
                        $q = "SELECT * FROM event WHERE event_type = 'Theater' AND event_id = $id";
                        $result = $con->query($q);
                      } 
                      
                while($row = mysqli_fetch_array($result))
                        {echo "

    <section class='main-movies'>
        <div class='title-right'>
            <h2>{$row['event_title']}</h2>
        </div>

        <br>
        
        <!-- Movies Cards -->
        <div class='card#' style='width: 100%; direction: rtl; height: 400px; padding-right: 50px;'>

        <img src='data:image;base64,".base64_encode($row['image'])." ' alt='image' style='border-radius: 10px; margin-left: 20px; width: 984px;'>
            <div class='datalist#' style='font-weight: 600; padding: 5px; color: white;'>
                <p>مسرح الجمهورية</p>
                <p>{$row['event_date']}</p>
            </div>
        </div>
        
        
        
        <div class='seemore_Book'>
            <p class='center-align'><button id='scrollBtn' class='book'>اسعار التذاكر</button></p>
        </div>
    </section>
    <hr class='dashed'>


    <hr class='dashed'>
    <section class='showtime' id='showtime'>

        <h2 class='####highlight'>
        {$row['event_title']}
        </h2>
        <div class='dates'>
            <h3 class='highlight'>
                مسرح الجمهورية
            </h3>
            <ol>
                <li>
                    <strong>Parterre</strong>
                    <ol>
                        <li class='button'>
                            <a href='Payment.html'>100EGP</a>
                        </li>
                    </ol>
                </li>
                <li>
                    <strong>Baignoire</strong>
                    <ol>
                        <li class='button'>
                            <a href='Payment.html'>100EGP</a>
                        </li>
                    </ol>
                </li>
                <li>
                    <strong>Loge</strong>
                    <ol>
                        <li class='button'>
                            <a href='payment.html'>80EGP</a>
                        </li>
                    </ol>
                </li>
                <li>
                    <strong>Balcony</strong>
                    <ol>
                        <li class='button'>
                            <a href='payment.html'>70EGP</a>
                        </li>
                    </ol>
                </li>
            </ol>
            
        </div>
    </section>
    ";}
    ?>
    <hr class="solid">

    <!-- CopyRights -->
    <section class="copyrights">
            <div class="p-left">
                <!-- <img src="photos/payments/GooglePay.png" alt="">
                <img src="photos/payments/ApplePay.png" alt=""> -->
                <img src="photos/payments/Mastercard.png" alt="">
                <img src="photos/payments/Visa.png" alt="">
                <!-- <img class="fawry" src="photos/payments/fawry_pay.png" alt=""> -->
    
                
            </div>
            <div class="p-right">
                <h3><span>Ticket Rush</span>. كل الحقوق محفوظة © 2024</h3>
            </div>
        </section>
    <script src="JS/info_Page_AR.js"></script>
</body>
</html>