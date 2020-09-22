
<html>
    <head>
        <title>User Home</title>
        <link rel="stylesheet" type="text/css" href="css/UserHome.css">
    </head>
    <body>
    <p id="usergreeting">
    <?php
   session_start();
   require_once('dbconn.php');
   
   if(isset($_SESSION['login']))
   { 
        echo "Welcome ".ucwords($_SESSION['login'])."!";
   }
 
   if(isset($_POST['merch']))
   {
       header("location:MerchantPage.php");
   }
   if(isset($_POST['prod']))
   {
       header("location:Products.php");
   }
   $role=$_SESSION['userrole'];

?>
  </p>
    <div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
    </div>
    <?php if($role == 'admin') : ?>
        <p id="ptitle">ADMIN CONTROLS</p>
    <?php endif; ?>
    <?php if($role != 'admin') : ?>
        <p id="ptitle">MERCHANT CONTROLS</p>
    <?php endif; ?>
    <body>
        <form id="btnform" action="" method="post">
            
            <div id="mainbody">
            
            <?php if($role == 'admin') : ?>
                <label for="merch">Access/Edit Merchant Details</label>
                <input type="submit" id="m" name="merch" value="Merchant">
            <?php endif; ?>
                <label for="prod">Access/Edit Product Details</label>
                <Input type="submit" id="p" name="prod" value="Products">
            </div>
        </form>
    </body>
</html>