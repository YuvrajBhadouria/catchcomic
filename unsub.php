<?php
    if(isset($_GET['email'])){   
        $email=$_GET['email'];

        $mysqli = NEW mysqli('localhost','root','','test');

        $resultSet= $mysqli->query("SELECT email FROM users WHERE subscribed= '1' AND email = '$email' LIMIT 1");
            if($resultSet->num_rows == 1){
                 $update = $mysqli->query("UPDATE users SET subscribed = '0' WHERE email='$email' LIMIT 1");
                if($update){
                    echo"You have succefully unsubscribed";  
                    }
                else{
                    $mysqli->error;
                }
            }
            else{
                echo "This account is not subscribed";
            }
    }
    else{
        die("Something went wrong");
    }
    
?>
