<?php
          if (isset($_GET['id']) && isset($_GET['redirect'])) {
            $id = $_GET['id'];
            $redirect = $_GET['redirect'];
        
            $conn =  new mysqli("localhost","root","","ticket");
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $delete = "DELETE FROM event WHERE event_id = ?";
            $stmt = $conn->prepare($delete);
            $stmt->bind_param("i", $id);
        
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: $redirect");
                exit;
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        
            $stmt->close();
            $conn->close();
        } else {
            echo "Invalid request.";
            exit;
        }
        ?>