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

if(isset($_GET['error'])){

    if($_GET['error'] == "noaccount"){
        echo "<em> please create account first<br></em>";
            }
}

if(isset($_POST['log'])){
    $username=$_POST['log_name'];
    $password=$_POST['log_pass'];

    $sql= "SELECT username, password FROM login WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    while ($rows = mysqli_fetch_assoc($result)){
        $name = $rows['username'];
        $pass = $rows['password'];
    }

    if(empty($username) || empty($password)){
        header("Location: login.php?error=empty");
    }
    elseif($name == $username && $pass == $password)
    {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
    }
    else{
        header("Location: login.php?error=noaccount");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Log In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css.css">
    </head>
    <body>
    <div class="box">
            <form method="post">
                    <label for="log_name">Username</label><input type="text" name="log_name" id="log_name"></br>
                    <label for="log_pass">Password</label><input type="password" name="log_pass"  name="log_pass" ></br>
                    <input type="submit" name="log" value ="Log In"> </br>
                    <p style="font-size:0.8rem; margin-top:0.5em;">create account? <a  href="sign.php">Sign_up</a></p>
            </form>
    </div>
    </body>
    </html>