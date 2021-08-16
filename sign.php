<?php
session_start();
$HOST = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "login";
$con = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
if( mysqli_connect_errno()){
echo "Connection Error:"  . mysqli_connect_error();
}

if(isset($_POST['sign'])){
    $user_name=$_POST['user_name'];
    $e_mail=$_POST['e_mail'];
    $pass=$_POST['pass'];
    $sql = "select Email from login where Email = '$e_mail'";
    $query = mysqli_query($con, $sql);

   if(mysqli_fetch_array($query)){

        header("Location: welcome.php?error=existed");
    }

    elseif(empty($user_name) || empty($e_mail) || empty($pass)){

        header("Location: sign.php?error=empty");
    }

    elseif(!filter_var($e_mail,FILTER_VALIDATE_EMAIL)){

        header("Location: sign.php?error=validmail");
    }
    
    else{
        
        header("Location: welcome.php?error=existed");
        
    $sql = "INSERT INTO login (username, email, password) VALUES ('$user_name', '$e_mail','$pass')";    
    $result=mysqli_query($con, $sql);
    $_SESSION['username'] = $user_name;
       
    }
}
if(isset($_GET['error'])){

    if($_GET['error'] == "existed"){
		echo "<em> Email already used <br> </em>";
	}
	elseif($_GET['error'] == "empty"){
		echo "<em> fill in the empty fileds <br></em>";
		}
	elseif($_GET['error'] == "validmail"){
	echo "<em> the email you have used is in invalid format<br></em>";
        }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign Up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css.css">
    </head>
    <body>
    <div class="box1">
            <form method="post">
                    <label for="user_name">Username</label><input type="text" name="user_name" id="user_name" ></br>
                    <label for="e_mail">Email</label></br><input type="email" name="e_mail" id="e_mail"></br>
                    <label for="pass">Password</label><input type="password" name="pass" id="pass"></br>
                   <input type="submit" name="sign" value ="Sign Up"> </br>
                    <p style="font-size:0.8rem; margin-top:0.5em;">already have account?<a href="login.php">Log_in</a></p>
            </form>
    </div>
    </body>
    </html>