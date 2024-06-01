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
    <title>Ticket Rush | Info Page</title>
    <style>
        /* Search Bar */
        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .search-input {
            display: none;
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            position: absolute;
            left: 0;
            top: 100%;
        }

        .search-input.active {
            display: block;
        }
    </style>
</head>
<body>
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
                        بحث
                    </span>
                    <input type="text" class="search-input" id="searchInput" placeholder="Search...">
                </div>
            </div>

            <!-- Center Bar Contain: Main,movies,cinemas -->
            <div class="nav-center">
                <a href="Index.php">الرئيسية</a>
                <a href="Cinema_Page.php" class="activehome">السينما</a>
                <a href="Theater_Page.php">المسرح</a>
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
                        $q = "SELECT * FROM event WHERE event_type = 'Cinema' AND event_id = $id";
                        $result = $con->query($q);
                      } 
                      
                while($row = mysqli_fetch_array($result))
                        {echo "
    <section class='main-movies'>
        <div class='age-rate'>
            <p>{$row['age_rating']}</p>
        </div>
        <div class='title-right'>
            <h2>{$row['event_title']}</h2>
        </div>

        <br>
        
        <!-- Movies Cards -->
        <section class='main_poster'>
            <div class='poster'>
            <img src='data:image;base64,".base64_encode($row['image'])." ' alt='image'>
            </div>
            <div class='Trailer_video'>
                <div class='player'>
                    <iframe width='619' height='398' src={$row['link']} title= {$row['event_title']}.' الاعلان الرسمي' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen>
                    </iframe>
                </div>
            </div>
        </section>        

        
        
        
        <div class='seemore_Book'>
            <p class='center-align'><button id='scrollBtn' class='book'>مواعيد العرض</button></p>
        </div>
    </section>
    <hr class='dashed'>

    <section class='data'>
        <aside>
            <p>
                <strong>النوع:</strong>
                {$row['movie_type']}
            </p>
            <p>
                <strong>  طاقم العمل:</strong>
                {$row['character1']}
           </p>
            <p>
                <strong>  اللغة:</strong>
                {$row['language']}
            </p>
            <p>
                <strong>  ترجمة:</strong>
                {$row['subtilte']}
            </p>
        </aside>
        <article>
            <p>{$row['info']}</p>
        </article>
    </section>
    ";}
    ?>


    <hr class="dashed">
    <section class="showtime" id="showtime">

        <h2 class="####highlight">
            رحلة 404 - اوقات العرض
        </h2>
        <nav class="datafilter">
            <div class="scroll">
                <div class="viewport">
                    <ol>
                        <li>
                            <a  class="active-day" href="">اليوم</a>
                        </li>
                        <li>
                            <a href="">غدا</a>
                        </li>
                        <li>
                            <a href="">الاحد</a>
                        </li>
                        <li>
                            <a href="">الاثنين</a>
                        </li>
                        <li>
                            <a href="">الثلاثاء</a>
                        </li>
                        <li>
                            <a href="">الاربعاء</a>
                        </li>
                        <li>
                            <a href="">الخميس</a>
                        </li>
                    </ol>
                </div>
            </div>
        </nav>
        <div class="dates">
            <h3 class="highlight">
                سيتي سنتر ألماظة
            </h3>
            <ol>
                <li>
                    <strong>عادية | Standard</strong>
                    <ol>
                        <li class="button">
                            <a href="Seat.php">8:00 مساء</a>
                        </li>
                        <li class="button">
                            <a href="Seat.php">10:00 مساء</a>
                        </li>
                    </ol>
                </li>
            </ol>

            <h3 class="highlight">مول مصر</h3>
            <ol>
                <li>
                    <strong>عادية | Standard</strong>
                    <ol>
                        <li class="button">
                            <a href="Seat.php">8:00 مساء</a>
                        </li>
                        <li class="button">
                            <a href="Seat.php">10:00 مساء</a>
                        </li>
                    </ol>
                </li>
            </ol>
        </div>
    </section>
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
    <script src="JS/Ticket_Rush(AR).js"></script>
</body>
</html>