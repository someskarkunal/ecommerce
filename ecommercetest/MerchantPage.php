<?php
    session_start();
    require_once('dbconn.php');
    $role=$_SESSION['userrole'];
    $unam=$_SESSION['login'];
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/MerchantPage.css"/>
</head>
<div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
</div>
<div id="homelink">
    <a href="UserHome.php">Home Page</a>
</div>
<div id="addmerch">
    <a href="AddMerchant.php">Add Merchant</a>
</div>
<p id="ptitle">Merchants</p>
<table cellpadding=5 cellspacing=0 border=1>
    <tr>
        <th>User ID</th>
        <th>UserName</th>
        <th>Passowrd</th>
        <th>User Role</th>
        <th>Actions</th>
    </tr>
    <?php
        $sql="select * from users";
        $query=mysqli_query($con,$sql);
        if(mysqli_num_rows($query)>0)
        {
            $i=1;
            while($row=mysqli_fetch_object($query))
            {
        
    ?>
    <tr>
        <td> <?php echo $row->userid; ?> </td>
        <td><?php echo $row->username; ?></td>
        <td><?php echo $row->password; ?></td>
        <td><?php echo $row->userrole; ?></td>
        <td>
            <a href="AddMerchant.php?edited=1&id=<?php echo $row->userid; ?>&mode=<?php echo 1; ?>">Edit</a>
            <?php if($role == 'admin') : ?>
            <a href="DeleteMerchant.php?deleted=1&id=<?php echo $row->userid; ?>&role=<?php echo $row->userrole; ?>">Delete</a>
            <?php endif; ?>
        </td>
    </tr>
<?php
        }
    }
?>
</table>