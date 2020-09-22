<?php

session_start();
require_once('dbconn.php');
$flag=0;
if(isset($_POST['login']))
{
$password=$_POST['password'];
$dec_password=$password;
$uname=$_POST['uname'];
$ret= mysqli_query($con,"SELECT * FROM users WHERE username='$uname' and password='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$role=$num['userrole'];
$extra="welcome.php";
$_SESSION['login']=$_POST['uname'];
$_SESSION['userrole']=$role;
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://localhost:8080/ecommercetest/UserHome.php");
exit();
}
else
{
$flag=1;
//echo "Invalid username or password";
//header("location:http://localhost:8080/ecommercetest/Login.php");
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//exit();
}
}
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/Login.css"/>
    </head>
    <body id="loginbody">
        <p id="ptitle">Login</p>
        <form name="loginform" action="" method="post">
            <label for="uname">Username: </label>
            <input type="text" class="text" name="uname" value="" placeholder="Username"><br>
            <label for="password">Password: </label>
            <input type="password" value="" name="password" placeholder="Password"><br>   
            <?php if($flag == 1) : ?>
            <p id="loginerror">Invalid username or password</p>
            <?php endif; ?>     
            <input type="submit" name="login" value="Submit">
		</form>
    </body>
</html>