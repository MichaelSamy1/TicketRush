<?php
$email=$_GET['email'];
$conn = new mysqli("localhost","root","","ticket");
if($conn->connect_error){
    die("failed to connect:".$conn->connect_error);
}
    else{
        if(isset($_POST['submit'])){
            $password = $_POST['password'];

            $update="UPDATE user
        SET password=? WHERE email=? ";
	   $st = $conn->prepare($update);
	   $st->bind_param("ss",$password ,$email);
	   $st->execute();
	   header('location: Index.html');
	   $st->close();
       $conn->close();
	} 
}  
?>
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
    <link rel="stylesheet" href="CSS/Forgot_Pass.css">
    <title>Ticket Rush | LogIn Page</title>
</head>
<body>
    <section class="content">
        <!-- First Bar Contain left,right,center -->
        <main class="navbar">
            <!-- left Contain: Logo(Cinema Time Logo) -->
            
            <!-- Center Bar Contain: Main,movies,cinemas -->
            <div class="nav-center">
                <a href="Index.html">Ticket Rush</a>
            </div>
            <!-- Right Bar Contain: Search,Log In -->
        </main>
    </section>



    <form action="" method="post" class="main_login">
        <h2>ادخال كلمة مرور جديدة</h2>
        <div class="email_pass">
        <br>
            <input type="password" class="pass" placeholder="كلمة مرور جديده" name="password" required>
            

        </div>
        <button name="submit" value="submit" type="submit"> استمر</button>
    </form>
    
</body>
</html>