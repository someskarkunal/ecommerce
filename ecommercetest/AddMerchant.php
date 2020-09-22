<?php
    session_start();
    require_once('dbconn.php');
    $prid='';
    $prti='';
    $prde='';
    $prth='';
    $prpr='';
    $mode='';
    $role='';

    // if(isset($_POST["role"]))
    // {
    //     $role=$_POST["role"];
    // }

    function inputValidation()
    {
        if(isset($_POST['mchsub']) or isset($_POST['mchsubupdt'])){
        $flag=true;
        if (empty($_POST["userid"])) 
        {
            echo "User ID is required.";
            $flag=false;
            return $flag; 
        }
        else if (is_numeric($_POST["userid"])==false) 
        {
            echo "User ID should be numeric.";
            $flag=false;
            return $flag; 
        }
        else if (empty($_POST["username"])) 
        {
            echo "Username is required."; 
            $flag=false;
            return $flag; 
        }
        else if (empty($_POST["password"])) 
        {
            echo "Password is required.";
            $flag=false;
            return $flag;  
        }
        else if (empty($_POST["role"]) or $_POST["role"]=='dbvalue')
        {
            echo "User Role is required."; 
            $flag=false;
            return $flag;
        }
        else
        {
            return $flag; 
        }}
    }

    if(isset($_POST['mchsub']))
    {
        if(inputValidation()==true)
        {
            $pid = $_POST['userid'];
            $pti = $_POST['username'];
            $pde = $_POST['password'];
            if(isset($_POST["role"]))
            {
                $pth=$_POST["role"];
            }
            $ins_sql = "Insert into users values('$pid','$pti','$pde','$pth')";
            if(mysqli_query($con, $ins_sql)){
                echo "Records added successfully.";
            } else{
                echo "ERROR: Could not able to execute $ins_sql. ";
            }
        }
        else
        {
            echo "Error!!";
        }
    }
    if(isset($_GET['edited']))
    {
        $mode=$_GET['mode'];
        $sql1="select * from users where userid='{$_GET['id']}'";
        $query=mysqli_query($con, $sql1);
        $row=mysqli_fetch_object($query);
        $prid=$row->userid;
        $prti=$row->username;
        $prde=$row->password;
        $prth=$row->userrole;
    }
    if(isset($_POST['mchsubupdt']))
    {
        if(inputValidation()==true)
        {
            $prid = $_POST['userid'];
            $prti = $_POST['username'];
            $prde = $_POST['password'];
            if(isset($_POST["role"]))
            {
                $prth=$_POST["role"];
            }
            $sql2 = "UPDATE `users` SET username='$prti',password='$prde',userrole='$prth' WHERE userid='$prid'";
            if(mysqli_query($con, $sql2)){
            echo "Records updated successfully.";
            } else{
            echo "ERROR: Could not able to execute $sql2. ";
            }
        }
        else
        {
            echo "Error!!";
        }
    }
    if(isset($_POST['mchcancel']))
    {
        header("location:MerchantPage.php");
    }
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/AddMerchant.css"/>
</head>
<div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
</div>
<div id="homelink">
    <a href="UserHome.php">Home Page</a>
</div> <br>
<div id="ap">
    <a href="MerchantPage.php">Merchant Page</a>
</div> <br>
<p id="ptitle">Add/Update Merchant</p>
<form name="addmerchform" action="" method="post">
    <?php if($mode == 1) : ?>
        <input type="hidden" class="text" name="userid" value="<?php echo $prid; ?>" placeholder="Merchant ID"><br>
        <label for="userid">User ID:</label> <input type="text" class="text" name="userid" value="<?php echo $prid; ?>" placeholder="Merchant ID" disabled><br>
    <?php endif; ?>
    <?php if($mode == '') : ?>
        <label for="userid">User ID:</label> <input type="text" class="text" name="userid" value="<?php echo $prid; ?>" placeholder="Merchant ID"><br>
    <?php endif; ?>
    <label for="username">UserName:</label> <input type="text" class="text" name="username" value="<?php echo $prti; ?>" placeholder="Username"><br>
    <label for="password">Password:</label> <input type="text" class="text" name="password" value="<?php echo $prde; ?>" placeholder="Password"><br>

    <label for="role">User Role:</label> <!--<input type="text" class="text" name="userrole" value="<?php echo $prth; ?>" placeholder="Role"><br>-->
    <select id="role" name="role">
        <option value="admin" <?php if ($role == 'admin') echo ' selected="selected"'; ?>>Admin</option>
        <option value="user" <?php if ($role == 'user') echo ' selected="selected"'; ?>>User</option>
        <option value="dbvalue" selected><?php echo $prth; ?></option>
    </select>
    
    <?php if($mode == '') : ?>
        <input type="submit" name="mchsub" value="Submit">
    <?php endif; ?>
    <?php if($mode == 1) : ?>
    <input type="submit" name="mchsubupdt" value="Update">
    <?php endif; ?>
    <input type="submit" name="mchcancel" value="Cancel">
</form>