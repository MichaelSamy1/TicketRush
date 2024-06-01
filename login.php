<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
  $conn = new mysqli("localhost","root","","ticket");
  if($conn->connect_error){
      die("failed to connect:".$conn->connect_error);
  }

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("select * from admin where username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt_res = $stmt->get_result();
        if ($stmt_res->num_rows > 0){
            $data = $stmt_res->fetch_assoc();
            if($data['password'] === $password){
                $_SESSION["name"]=$data['name'];
                header('location: users.php');
                exit;
            }
            else{
                echo "incorrect username or password";
            }
        }
        else {
            echo "incorrect username or password";
        }        
}
?>