<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="CSS/Index.css">
    <title>Ticket Rush | Events</title>
</head>
<body>
    <!-- Section 1 -->
    <section class="content">
        <!-- First Bar Contain left,right,center -->
        <main class="navbar">
            <!-- left Contain: Logo -->
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
            <!-- Center Bar Contain: Main,movies,cinemas -->
            <div class="nav-center">
                <a href="Index.php">الرئيسية</a>
                <a href="Cinema_Page.php">السينما</a>
                <a href="Theater_Page.php">المسرح</a>
                <a href="Matches.php">المباريات</a>
                <a href="Events.php" class="activehome">الحفلات</a>
                <a href="Parks.php">الحدائق</a>
            </div>
            <!-- Right Bar Contain: Search,Log In -->
            <div class="nav-right">
                <a href="Index.php">Ticket Rush</a>
                
            </div>
        </main>
    </section>

    <section class="main-movies">
        <div class="title-right">
            <h2>الحفلات</h2>
        </div>
        <br>
        <!-- Card 1 -->
        <?php
    $con = new mysqli("localhost","root","","ticket");
                  if($con->connect_error){
                      die("failed to connect:".$con->connect_error);}
                      else{
                        $q= "SELECT * FROM event WHERE event_type = ('Event')";
                        $result = $con->query($q);
                      } 
                      
                while($row = mysqli_fetch_array($result))
                        {echo "
        <div class='card' style='width: 90%; direction: rtl;'>
            <div class='poster'>
            <img src='data:image;base64,".base64_encode($row['image'])." ' alt='image'>
            </div>
            <div class='datalist' style='font-weight: 600; padding: 5px;'>
                <h1 style='margin-right: 30px;'>{$row['event_title']}</h1>
                <p><span><img src='photos/location.png' alt='' style='width: 18px; padding-left: 5px;'></span> مسرح الجمهورية</p>
                <p><span><img src='photos/date.png' alt='' style='width: 18px; padding-left: 5px;'></span>{$row['event_date']}</p>

                <div class='seemore_Book' style='direction: ltr; margin: 20px;'>
                    <a href='Theater-info.php'><button class='book' style='padding-right: 40px;'>احجز الان</button></a>
                </div>
            </div>
        </div>
        ";}
        ?>
    </section>




    <!-- <hr class="solid"> -->

    
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
    <script src="JS/Ticket_Rush(AR).js"></script>
    <script src="JS/info_Page_AR.js"></script>
</body>
</html>