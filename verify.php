<?php
    if(isset($_GET['vkey'])){   
        $vkey=$_GET['vkey'];

        $mysqli = NEW mysqli('localhost','root','','test');

        $resultSet= $mysqli->query("SELECT verified,vkey FROM users WHERE verified= '0' AND vkey= '$vkey' LIMIT 1");
            if($resultSet->num_rows == 1){
                 $update = $mysqli->query("UPDATE users SET verified = 1 WHERE vkey='$vkey' LIMIT 1");
                if($update){
                    echo"Your account is verified now";  
                    }
                else{
                    $mysqli->error;
                }
            }
            else{
                echo "This account is invalid or already verified";
            }
    }
    else{
        die("Something went wrong");
    }
    
?>
