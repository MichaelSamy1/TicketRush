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
    <link rel="stylesheet" href="CSS/Index.css">
    <title>Ticket Rush | Matches(البطولات)</title>
    <style>
        .link-container {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            margin: 0px 50px 20px auto; /* Center the links horizontally */
        }

        .link-container a {
            margin-left: 20px;
            padding: 10px 30px;
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            transition: .2s;
            border: #185099 solid 2px;
            border-radius: 64px;
            background: black;
        }
        .link-container a:hover ,.activetab{
            color: #185099;
            font-weight: 800;
        }


        /* .navbar .nav-center a{
            margin-left: 20px;
            text-decoration: none;
            color: #fff;
            font-size: 20px;
            font-weight: 500;
            transition: .2s;
        } */

        /* .navbar .nav-center a:hover{
            color: #185099;
            font-weight: 800;
        } */

        .navbar .nav-center .activehome{
            color: #185099;
            font-weight: 800;
            border-bottom: 2px solid #113f7c;
        }

        .navbar .nav-center .activehome:hover{
            color: #2b6cc2;
            font-weight: 800;
            border-bottom: 2px solid #113f7c;
        }




        /* machtes cards */

        .all-matches {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .match-card {
            background-color: #000000;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px;
            width: 1080px;
        }

        .match-card img {
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .match-details {
            padding: 60px;
            /* display: flex;
            justify-content: space-between; */
            
        }

        .match-details h2 {
            margin-top: 0;
            font-size: 18px;
            color: #ffffff;
        }

        .match-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #ffffff;
        }
        .teams{
            display: flex;
            justify-content: space-around;
            align-items: center;


            background: #121212;
            padding: 20px;
            border-radius: 10px;
        }
        .activetab{
            color: #185099;
            font-weight: 800;
        }
    </style>
</head>
<body>
    <!-- Loading -->


    <!-- Section 1 -->
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
                <a href="Theater_Page.php">المسرح</a>
                <a href="Matches.php" class="activehome">المباريات</a>
                <a href="Events.php">الحفلات</a>
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
            <h2>المباريات</h2>
        </div>
        <br>
        <!-- بطولات ، دوري مصري ، كأس افريقيا -->
        <div class="link-container">
            <a href="Matches_3.php">كأس الكونفدرالية الافريقية</a>
            <a href="Matches_2.php">الدوري المصري</a>
            <a href="Matches.php" style="color: #185099; font-weight: 800; background: #fff;">البطولات</a>
        </div>
        
        <br>

        <div class="all-matches" dir="rtl">
            <!-- Card Match -->
            <?php
    $con = new mysqli("localhost","root","","ticket");
                  if($con->connect_error){
                      die("failed to connect:".$con->connect_error);}
                      else{
                        $q= "SELECT * FROM event WHERE event_title = ('البطولات')";
                        $result = $con->query($q);
                      } 
                      
                while($row = mysqli_fetch_array($result))
                        {echo "
            <div class='match-card'>
                <div class='match-details'>
                    <div class='teams'>
                        <div class='team2'>
                            <div class='img-holder1' style='width: 50px;'>
                            <img src='data:image;base64,".base64_encode($row['image'])." ' alt='image'>
                            </div>

                            <h2>{$row['character1']}</h2>
                        </div>
                        <br>
                        <h2>VS</h2>
                        <br>
                        <div class='team2'>
                            <div class='img-holder2'>
                            <img src='data:image;base64,".base64_encode($row['image2'])." ' alt='image' style='width: 50px;'>
                            </div>
                            <h2>{$row['character2']}</h2>
                        </div>
                    </div>
                    <div class='time-place' style=' display: flex; justify-content: space-evenly; margin: 25px;'>
                        <p><span><img src='photos/location.png' alt='' style='width: 18px; padding-left: 5px;'></span> الملعب: استاد الأسكندرية , الاسكندرية</p>
                        <p><span><img src='photos/date.png' alt='' style='width: 18px; padding-left: 5px;'></span> التاريخ: {$row['event_date']}</p>
                        <p> {$row['event_time']} </p>
                    </div>
                    <div class='seemore_Book' style='direction: ltr;'>
                        <a href='Theater-info.php'><button class='book' style='padding-right: 40px; 
                                                                                max-width: 100%;
                                                                                margin: auto;
                                                                                padding: 5px 0px 5px 100px;
                                                                                width: 250px;'>احجز الان</button></a>
                    </div>
                </div>
            </div>
            ";}
            ?> 
        </div>
    </section>


    <!-- <hr class="solid"> -->

    
    <hr class="solid">


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
    <script src="JS/Ticket_Rush(AR).js"></script>
    <script src="JS/info_Page_AR.js"></script>
</body>
</html>