<?php
session_start();
include("../includes/db.php");
if(isset($_POST['forgotPass'])){
	

	
	  $email = mysqli_real_escape_string($conn,$_POST['email']);
	
	
	$query = "SELECT * FROM `teacher` WHERE `email` = '$email' ";
	$select_query = mysqli_query($conn,$query);
	
	if(!$select_query){
		
		die( mysqli_error($conn));
	}
	
	
	 $count = mysqli_num_rows($select_query);
	
	if($count > 0  ){
		$str = "0123456789qwerty#$*";
		$str = str_shuffle($str);
		 $str = substr($str,0,5);
		
		$url = "https://gynecoid-tables.000webhostapp.com/login/reset_pass.php?token=$str&email=$email";
		
		
		

	require "phpmailer/PHPMailerAutoload.php";
	$mail = new PHPMailer;
/*	$mail->isSMTP();*/
	$mail->Host = "smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPAuth=true;
	$mail->SMTPSecure = 'tls';
		
	$mail->Username="jainpurvesh19@gmail.com";
	$mail->Password="RockstarDaga$$55";
	
	$mail->setfrom("jainpurvesh19@gmail.com","Purvesh");
	$mail->addAddress($email);
	
	$mail->isHTML(true);
		
	$mail->Subject="YOUR NEW PASSWORD";
	$mail->Body    = 'Click on the click to set a new password 
						'.$url;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
    echo 'Message could not be sent.<br>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
		
		
		
		
		
		
		
		$query = "update `teacher` set `token` = '$str' where `email`  = '$email'" ;
		$update_query = mysqli_query($conn,$query);
		
		if(!$update_query){
			die(mysqli_error($conn));
		}
		
	}else{
		echo "Enter a proper email id";
	}
	
	
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php include "../includes/link.php"; ?>
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <h1 style="text-align: center">QBank password recovery portal</h1>
        </div>
    </div><br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <p> </p>
        </div>
        <div class="col-sm-4 jumbotron">
            <form action="" method="post">
                <p>enter your email id</p>
                <input type="email" class="form-control" name="email" id="email"><br>
                <button type="submit" style="position: relative; left: 200px" class="btn btn-success" name="forgotPass">Submit</button>

            </form>
        </div>
        <div class="col-sm-4">
            <p> </p>
        </div>
    </div>


</body>

</html>
