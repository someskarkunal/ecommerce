<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/DeleteMerchant.css"/>
    </head>
    <body>
    <div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
</div>
<p id="ptitle">
<?php
    session_start();
    require_once('dbconn.php');
    $role=$_SESSION['userrole'];
    $delrole=$_GET['role'];
if($delrole!='admin')
{
    if(isset($_GET['deleted']))
    {
        $sql1="delete from users where userid='{$_GET['id']}'";
        if(mysqli_query($con, $sql1)){
            echo "Records deleted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql1. ";
        }
    }
}
else
{
    echo "You cannot delete an Administrator user.";
}
if(isset($_POST['mchback']))
    {
        header("location:MerchantPage.php");
    }
    if(isset($_POST['homeback']))
    {
        header("location:UserHome.php");
    }
?></p><br>
<form name="delmchform" action="" method="post"  enctype="multipart/form-data">
<input type="submit" id="mchback" name="mchback" value="Merchant Page">
<input type="submit" id="homeback" name="homeback" value="Home Page">
</form>
</body>
</html>