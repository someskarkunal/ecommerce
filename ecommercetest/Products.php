<?php
    session_start();
    require_once('dbconn.php');
    $role=$_SESSION['userrole'];
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Products.css"/>
</head>
<body>
<div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
</div>
<div id="homelink">
    <a href="UserHome.php">Home Page</a>
</div> <br>
<div id="addprods">
    <a href="AddProduct.php" id="ap">Add Products</a>
</div>
<p id="ptitle">Products</p>
<?php
        $sql="select * from products";
        $query=mysqli_query($con,$sql);
        if(mysqli_num_rows($query)>0)
        {
            $i=1;
            while($row=mysqli_fetch_object($query))
            {
        
    ?>
<div id="products">
<table id="tblprod">
    <tr id="rowoutline">
        <tr>
            <td rowspan="4" colspan="1"><img src="<?php echo $row->thumbnail; ?>" id="tblthumb" width=300px height=350px alt="thumb"/></td>
            <td>#<?php echo $row->prodid; ?> - <?php echo $row->title; ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $row->description; ?></td>
        </tr>
        <tr>
            <td><?php echo $row->price; ?></td>
        </tr>
        <tr>
            <td>
                <a href="AddProduct.php?edited=1&id=<?php echo $row->prodid; ?>&mode=<?php echo 1; ?>" id="ap">Edit</a>
                <?php if($role == 'admin') : ?>
                <a href="DeleteProducts.php?deleted=1&id=<?php echo $row->prodid; ?>" id="d">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    </tr>
</table>
</div>
<?php
        }
    }
?>
</body>
</html>