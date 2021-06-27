<?php
session_start();
$mysqli = NEW MySQli('localhost','root','','test');
$email=$_SESSION['email'];

$result= $mysqli->query("SELECT subscribed,email FROM users WHERE subscribed='1' AND email='$email' ");
        $row=$result->fetch_assoc();
        $subscribed=$row['subscribed'];
?>
<script>
var myVar;
 function function(){
   alert("
 <?php
        $to = $email;
        $subject="Email Verification";
        $message="<p>hello</P>";
        $headers= "From: catchcomic@yahoo.com \r\n";
        $headers .="MIME-Version: 1.0" . "\r\n";
        $headers .="Content-type:text/html ; charset=UTF-8". "\r\n"; 
        mail($to,$subject,$message,$headers);
        ?>");
 }
 function myFunction(){
  myVar= setInterval(function,3000);
 }
</script>