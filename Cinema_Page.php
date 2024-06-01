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
    <title>Ticket Rush | Cinema</title>
    <style>
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
<!-- Section 1 -->
   <section class="content">
    <!-- First Bar Contain left,right,center -->
    <main class="navbar">
        <!-- left Contain: Logo(Cinema Time Logo) -->
        <div class="nav-left">
            <a href="Log_in_Page.html">
                <Button>تسجيل خروج</Button>
            </a>    
            <!-- <a href="Index_EN.html" class="change-lang">EN</a> -->
            <div class="search-container">
                <span src="photos/search.png" onclick="toggleSearch()">
                    search
                </span>
                <input type="text" class="search-input" id="searchInput" placeholder="Search...">
            </div>

            <!-- <div class="search-container">
                <img src="photos/search.png" alt="Search" class="search-icon" onclick="toggleSearch()">
                <input type="text" class="search-input" id="searchInput" placeholder="Search...">
            </div> -->
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

    <section class="main-movies">
        <div class="title-right">
            <h2>يعرض الان</h2>
        </div>
        <br>

     <!-- Movies Cards -->

        <?php
    $con = new mysqli("localhost","root","","ticket");
                  if($con->connect_error){
                      die("failed to connect:".$con->connect_error);}
                      else{
                        $q= "SELECT * FROM event WHERE event_type = ('Cinema')";
                        $result = $con->query($q);
                      } 
                      
                while($row = mysqli_fetch_array($result))
                        {echo "
        
        <div class='card'>
            <div class='poster'>
            
                <img src='data:image;base64,".base64_encode($row['image'])." ' alt='image'>
            </div> 
            <div class='datalist'>
                <h1>{$row['event_title']}</h1>
                <p>{$row['info']}</p>
                <div class='age-rate'>
                    <p>{$row['age_rating']}</p>
                </div>
                <div class='seemore_Book'>
                    <a href='./Info_Page_AR.php?id={$row['event_id']}'><button>تفاصيل</button></a>
                    <a href='./Info_Page_AR.php?id={$row['event_id']}'><button class='book'>احجز الان</button></a>
                </div>
            </div>
        </div>
        ";}
        ?>
        
    </section>

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