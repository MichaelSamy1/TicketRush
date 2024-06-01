<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
  $conn = new mysqli("localhost","root","","ticket");
  if($conn->connect_error){
      die("failed to connect:".$conn->connect_error);
  }

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("select * from user where email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt_res = $stmt->get_result();
        if ($stmt_res->num_rows > 0){
            $data = $stmt_res->fetch_assoc();
            if($data['password'] === $password){
                $_SESSION["fullname"]=$data['fullname'];
                header('location: Index.php');
                exit;
            }
            else{
                echo "incorrect email or password";
            }
        }
        else {
            echo "incorrect email or password";
        }        
}
?>