<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
  $conn = new mysqli("localhost","root","","ticket");
  if($conn->connect_error){
      die("failed to connect:".$conn->connect_error);
  }
    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        
      $sql = "INSERT INTO user (firstname, lastname, email, date, gender, phone, password)
      VALUES ('$firstname', '$lastname', '$email', '$date', '$gender', '$phone', '$password')";

if ($conn->query($sql) === TRUE) {
  header('location: Log_in_Page.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

?> 