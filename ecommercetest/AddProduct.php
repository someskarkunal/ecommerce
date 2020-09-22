<?php
    session_start();
    require_once('dbconn.php');
    $prid='';
    $prti='';
    $prde='';
    $prth='';
    $prpr='';
    $mode='';
    $pth='';

    //------------------------------------------------------------------------------------------

    if(isset($_FILES['thumb'])){
        $errors= array();
        $file_name = $_FILES['thumb']['name'];
        $file_size =$_FILES['thumb']['size'];
        $file_tmp =$_FILES['thumb']['tmp_name'];
        $file_type=$_FILES['thumb']['type'];
        $file_Ext_inp=explode('.',$_FILES['thumb']['name']);
        $file_ext=strtolower(end($file_Ext_inp));
        
        if($file_size > 2097152){
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"images/".$file_name);
           //echo "Success";
        }else{
           //print_r($errors);
        }
     }


    //------------------------------------------------------------------------------------------

    function inputValidation()
    {
        if(isset($_POST['prdsub']) or isset($_POST['prdsubupdt'])){
        $flag=true;
         if (empty(($_POST["prodid"]))) 
        {
            echo "Product ID is required.";
            $flag=false;
            return $flag; 
        }
        else if (is_numeric($_POST["prodid"])==false) 
        {
            echo "Product ID should be numeric.";
            $flag=false;
            return $flag; 
        }
        else if (empty($_POST["prodtitle"])) 
        {
            echo "Product Title is required."; 
            $flag=false;
            return $flag; 
        }
        else if (empty($_POST["desc"])) 
        {
            echo "Product Description is required.";
            $flag=false;
            return $flag;  
        }
        else if (($_FILES['thumb']['name'])=='')
        {
            echo "Product Thumbnail is required."; 
            $flag=false;
            return $flag;
        }
        else if (empty($_POST["price"]))
        {
            echo "Product Price is required."; 
            $flag=false;
            return $flag;
        }
        else if (is_numeric(($_POST["price"]))==false) 
        {
            echo "Product Price should be numeric.";
            $flag=false;
            return $flag; 
        }
        else
        {
            return $flag; 
        }}
    }

    if(isset($_POST['prdsub']))
    {
        if(inputValidation()==true)
        {
            $pid=$_POST["prodid"];
            $pti = $_POST['prodtitle'];
            $pde = $_POST['desc'];
            $pth = "images/".$_FILES['thumb']['name'];
            $ppr = $_POST['price'];
            $ins_sql = "Insert into products values('$pid','$pti','$pde','$pth','$ppr')";
            if(mysqli_query($con, $ins_sql)){
                echo "Records Added Successfully!!"; 
            } else{
                echo "ERROR: Could not able to execute $ins_sql.";
            }
        }
        else{
            echo " Error!!";
        }
        
    }
    if(isset($_GET['edited']))
    {
        $mode=$_GET['mode'];
        $sql1="select * from products where prodid='{$_GET['id']}'";
        $query=mysqli_query($con, $sql1);
        $row=mysqli_fetch_object($query);
        $prid=$row->prodid;
        $prti=$row->title;
        $prde=$row->description;
        $prth=$row->thumbnail;
        $prpr=$row->price;
    }
    $val=inputValidation();
    if(isset($_POST['prdsubupdt']))
    {
        if(inputValidation()==true)
        {
            $prid = $_POST['prodid'];
            $prti = $_POST['prodtitle'];
            $prde = $_POST['desc'];
            $prth = "images/".$_FILES['thumb']['name'];
            $prpr = $_POST['price'];
            $sql2 = "UPDATE `products` SET title='$prti',description='$prde',thumbnail='$prth',price='$prpr' WHERE prodid='$prid'";
            if(mysqli_query($con, $sql2))
            {
                echo "Records updated successfully.";
            } 
            else
            {
                echo "ERROR: Could not able to execute $sql2.";
            }
        }
        else
        {
            echo " Error!!";
        }
    }
    if(isset($_POST['prdcancel']))
    {
        header("location:Products.php");
    }
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/AddProduct.css"/>
</head>
<div id="preheader">
            <a href="Logout.php" id="l">Logout</a>
</div>
<div id="homelink">
    <a href="UserHome.php">Home Page</a>
</div> <br>
<div id="ap">
    <a href="Products.php">Products Page</a>
</div> <br>
<p id="ptitle">Add/Update Product</p>
<form name="addprodform" action="" method="post"  enctype="multipart/form-data">
    <?php if($mode == 1) : ?>
        <input type="hidden" class="text" name="prodid" value="<?php echo $prid; ?>" placeholder="ProductID"><br>
        <label for="prodid">Product ID:</label><input type="text" class="text" name="prodid" value="<?php echo $prid; ?>" placeholder="ProductID" disabled><br>
    <?php endif; ?>
    <?php if($mode == '') : ?>
        <label for="prodid">Product ID:</label> <input type="text" class="text" name="prodid" value="<?php echo $prid; ?>" placeholder="ProductID"><br>
    <?php endif; ?>
    <label for="prodtitle">Product Title:</label> <input type="text" class="text" name="prodtitle" value="<?php echo $prti; ?>" placeholder="Product Title"><br>
    <label for="desc">Description:</label> <input type="text" class="text" name="desc" value="<?php echo $prde; ?>" placeholder="Description"><br>
    <label for="thumb">Thumbnail:</label> <input type="file" class="text" name="thumb" title="<?php echo $prth; ?>" placeholder="Thumbnail"><?php if($prth != 'images/' or $prth !='' or $pth !='' or $pth!='images/') : ?><label for=thumb>Currently Selected File: <?php echo $prth; ?></label><?php endif; ?><br>
    <label for="price">Price:</label> <input type="text" class="text" name="price" value="<?php echo $prpr; ?>" placeholder="Price"><br>
    <?php if($mode == '') : ?>
    <input type="submit" name="prdsub" value="Submit">
    <?php endif; ?>
    <?php if($mode == 1) : ?>
    <input type="submit" name="prdsubupdt" value="Update">
    <?php endif; ?>
    <input type="submit" name="prdcancel" value="Cancel">
</form>