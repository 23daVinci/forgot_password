<?php  
ob_start();
session_start();
$db['db_host']="localhost";
$db['db_user']="root";
$db['db_pass']="";
$db['db_name']="aws";
 
foreach($db as $key => $value){
	define(strtoupper($key),$value);
	
}


$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);



/*include("../includes/db.php");*/

include("function.php");
if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];
    

    

$username = string_check($username);
$password = string_check($password);



$query = "SELECT * FROM teacher where email= '$username'";
	
$select_admin_query = mysqli_query($conn,$query);


if(!$select_admin_query ){
	die("Error ocurred ".mysqli_error($conn));
}

        while($row = mysqli_fetch_array($select_admin_query)){
        $user_name=$row['email'];
        $user_password = $row['password'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $user_image = $row['image'];
        $dept = $row['branch'];
        $pre = $row['prefix'];
            
    }
    
  
    $password = crypt($password,$user_password);
	$password = substr($password,0,50);
/*	echo $password;
	echo "<br>";
	echo $user_password;*/
	
	
	if($password !== $user_password && $username !== $user_name){
        header("Location:alogin.php");
        echo "Invalid username or password";
    }
    

	
	else	if($password == $user_password && $username == $user_name){
            
        
            $_SESSION['userId'] = "x";
			$_SESSION['firstname'] = $fname;
            $_SESSION['lastname'] = $lname;
        
            $_SESSION['user_email'] = $user_name;
            $_SESSION['uimage'] = $user_image;
            $_SESSION['br'] = $dept;
            $_SESSION['pre'] = $pre;
            
            
            
           
            
            
		
			header("Location: ../admin/index.php");
			echo "pass";
		}
    
		else{
			echo"<br>invalid password";
        }
    
}

	
	

?>


