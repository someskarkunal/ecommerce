<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/DeleteProducts.css"/>
    </head>
    <body>
    <div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
</div>
<p id="ptitle">
<?php
    session_start();
    require_once('dbconn.php');
    if(isset($_GET['deleted']))
    {
        $sql1="delete from products where prodid='{$_GET['id']}'";
        if(mysqli_query($con, $sql1)){
            echo "Records deleted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql1. ";
        }
    }
    if(isset($_POST['prdback']))
    {
        header("location:Products.php");
    }
    if(isset($_POST['homeback']))
    {
        header("location:UserHome.php");
    }
?></p><br>
        <form name="delprodform" action="" method="post"  enctype="multipart/form-data">
        <input type="submit" id="prdback" name="prdback" value="Products Page">
        <input type="submit" id="homeback" name="homeback" value="Home Page">
    </form>
    </body>
</html>