<?php
    
    if(isset($_POST['email'])){
    //connectig to database
    session_start();
    $mysqli = NEW MySQli('localhost','root','','test'); 
    
    //getting the form data
    $email = $mysqli->real_escape_string($_POST['email']);
    $passwords = $mysqli->real_escape_string($_POST['passwords']);
    $passwords = md5($passwords);

    //query the database
    $resultSet = $mysqli-> query("SELECT * FROM users WHERE email ='$email'AND passwords='$passwords' ");
      $name = $mysqli->query("SELECT name FROM users WHERE email='$email' ");
      
        if($resultSet-> num_rows !=0 ){
            $row=$resultSet->fetch_assoc();
            $verified=$row['verified'];
            $email=$row['email'];
            $name=$row['name'];
                if( $verified== 1){
                  $_SESSION['email'] =$email;
                  $_SESSION['name'] =$name;
                  echo "<script> location.href='welcome.php'; </script>";
                  exit;
                  
                 }
                else{
               echo"<div class='alert2'>
                <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
                <strong>WARNING!</strong> This Email is not yet verified.PLease verify it from the link we sent on your $email.
                </div>";
                }

    }else{
        echo "<div class='alert2'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
        <strong>WARNING!</strong> Envalid Credentials.
        </div>";

    }
    
    }
    
      
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">

<body>
<div class="topnav" id="myTopnav">
  <a href="" class="active">ComiCon</a>
  <a href="signup.php">Signup</a>
  <a href="login.php">Login</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<div class="container">
  <form action="" method="post">
    
    <div class="row">
      <div class="col-25">
        <label for="email" >Email</label>
      </div>
      <div class="col-75">
        <input type="email" id="email" name="email" placeholder="Your email..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="passwords" name="passwords" placeholder="Enter your password">
      </div>
    </div>
    <div class="row" >
      <input type="submit" value="submit">
    </div>
  </form>
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

</script>
</body>
</html>
