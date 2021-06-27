<?php
session_start();
if(!$_SESSION){
    echo "<script> location.href='login.php'; </script>";
                  exit;
  }
  $mysqli = NEW MySQli('localhost','root','','test'); 
  $email=$_SESSION['email'];
  if(isset($_POST['Submit'])){
     
    
    $resultSet= $mysqli->query("SELECT subscribed FROM users WHERE subscribed= '0' AND email= '$email' LIMIT 1");
            if($resultSet->num_rows == 1){
                 $update = $mysqli->query("UPDATE users SET subscribed = 1  LIMIT 1");
                if($update){
                    echo"You have Subscribed to the comic ";  
                    }
                }
              else{
                    echo"You are already subscribed";
                }
            }
    /* $result= $mysqli->query("SELECT subscribed,email FROM users WHERE subscribed='1' AND email='$email' ");
        $row=$result->fetch_assoc();
        $subscribed=$row['subscribed'];
       do{
        $echo_time = time();
        $interval = 1*60;
        while(true){
          if ($echo_time + $interval >= time()){
            echo "$interval". "seconds have passed...";
            $echo_time = time(); // set up timestamp for next interval
          }
          // other uninterrupted code goes here.
        }
         

       }while($subscribed = 1)
        */    
     
    




?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">

<body>

<div class="topnav" id="myTopnav">
  <a href="" class="active">ComiCon</a>
  
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<div class="container">
<h1>HI <?php echo $_SESSION['name']; ?>

<a href='logout.php'>log out</a>
<div>
<form acion="" method="POST">
<input type="submit" value="subs" id="Submit" name="Submit" onclick="myFunction()" >

  </div>

</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
function myFunction() {
  setInterval(function(){ console.log("Hello"); },3000);
}
</script>

</script>
</body>
</html>
