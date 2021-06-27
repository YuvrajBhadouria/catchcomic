<?php
$error = NULL;
if(isset($_POST['name'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $passwords = $_POST['passwords'];
  $password2=$_POST['password2'];
  $mysqli = NEW MySQli('localhost','root','','test');
  $resultSet = $mysqli-> query("SELECT * FROM users WHERE email ='$email'");
  $row=$resultSet->fetch_assoc(); 
  if(strlen($name)<5){
      $error ="Your username must be atleast 5 characters";
     }
     elseif( $resultSet-> num_rows !=0){
      if($email==$row['email']){

      
         echo "<div class='alert2'>
            <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
            <strong>WARNING!</strong> This Email is already registerd.
    </div>";
      }
    }
    elseif($passwords != $password2){
      echo "<div class='alert2'>
      <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
      <strong>WARNING!</strong> Your passwords didn't match.
    </div>";
      }
    else{
          //connecting to database
        $mysqli= NEW Mysqli('localhost','root','','test');
      
          //sanitize form data
        $name=$mysqli->real_escape_string($name);
        $email=$mysqli->real_escape_string($email);
        $passwords=$mysqli->real_escape_string($passwords);
        $password2=$mysqli->real_escape_string($password2);
      
      //generating verfication key 
        $vkey = md5(time().$name);

        //inserting data into database
        $passwords=md5($passwords);
        $insert=$mysqli->query("INSERT INTO users(name,email,passwords,vkey) 
        VALUES('$name','$email','$passwords','$vkey')");
        if($insert){
          //sending mail
          $to = $email;
          $subject="Email Verification";
          $message="<a href='http://localhost/yuvraj/verify.php?vkey=$vkey'>Register Account</a>";
          $headers= "From: catchcomic@yahoo.com \r\n";
          $headers .="MIME-Version: 1.0" . "\r\n";
          $headers .="Content-type:text/html ; charset=UTF-8". "\r\n"; 
          mail($to,$subject,$message,$headers);
          echo "<div class='alert'>
          <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
          <strong>SUCCESS!</strong> A verification link has been sent to you email.
        </div>";
        }
        else{
         echo $mysqli-> error;
        }

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
  <a href="" class="active">CatchComic</a>
  <a href="signup.php">Signup</a>
  <a href="login.php">Login</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<div class="container" >
  <form action="" method="post">
    <div class="row">
      <div class="col-25">
        <label for="name">Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name" placeholder="Your name..">
      </div>
    </div>
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
        <input type="password" id="passwords" name="passwords" placeholder="Set your password">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="password2">Confirm Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password2" name="password2" placeholder="Type your password again">
      </div>
    </div>
    
    <div class="row" >
      <input type="submit" value="Submit">
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
