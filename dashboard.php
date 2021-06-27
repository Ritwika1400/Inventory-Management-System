<?php
include_once("./database/constants.php");
if(!isset($_SESSION["userid"])){
    header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventory Management System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script type="text/javascript" src="./js/main_script.js"></script>
</head>
<body>
<!-- Navbar -->
<?php include_once("./templates/header.php"); ?>
<!-- Navbar -->
<br><br>

<!-- Dashboard -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mx-auto">
                <img src="./images/user.png" class="card-img-top mx-auto" style="width: 60%;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Profile Info</h5>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i>
                    <?php
                        include_once("./includes/user.php");
                        echo $_SESSION["username"];
                    ?>
                    </p>
                    <p class="card-text"><i class="fa fa-lock">&nbsp;</i>
                    <?php 
                    echo $_SESSION["usertype"];
                    ?>
                    </p>
                    <p class="card-text"><i class="fa fa-clock">&nbsp;</i>Last Login:
                    <?php
                        echo $_SESSION["last_login"];
                    ?>
                    </p>
                    <a href="#" data-toggle="modal" data-target="#form_user" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
                <div class="jumbotron" style="width:100%;height:100%;">
                    <h1>Welcome <?php echo $_SESSION["username"]?>,</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe src="https://free.timeanddate.com/clock/i7rvwkh3/n1596/szw160/szh160/hoc222/hbw6/cf100/hgr0/hcw2/hcd88/fan2/fas20/fdi70/mqc000/mqs3/mql13/mqw4/mqd94/mhc000/mhs3/mhl13/mhw4/mhd94/mmc000/mml5/mmw1/mmd94/hwm2/hhs2/hhb18/hms2/hml80/hmb18/hmr7/hscf09/hss1/hsl90/hsr5" frameborder="0" width="160" height="160"></iframe>


                        </div>
                        <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Orders</h5>
                                <p class="card-text">Place new order and make invoice.</p>
                                <a href="new_order.php" class="btn btn-primary"><i class="fa fa-truck">&nbsp;</i>New Orders</a>
                                <p></p>
                                <a href="manage_order.php" class="btn btn-primary"><i class="fa fa-truck">&nbsp;</i>Manage Orders</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Dashboard -->
<p></p>
<p></p>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">Here you can manage, add new parent and sub categories</p>
                    <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add</a>
                    <a href="manage_categories.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Brands</h5>
                    <p class="card-text">Here you can manage brands and add new brands</p>
                    <a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add</a>
                    <a href="manage_brand.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Manage</a>
                </div>
            </div>
        
        </div>
        <div class="col-md-4">
        <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">Here you can manage products and add new products</p>
                    <a href="#" data-toggle="modal" data-target="#form_products" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add</a>
                    <a href="manage_product.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Manage</a>
                </div>
            </div>
        
        </div>
    </div>
</div>

<?php
//Edit Profile
include_once("./templates/edit_profile.php");
?>
<?php
//Category Form
include_once("./templates/category.php");
?>

<?php
//Brand Form
include_once("./templates/brand.php");
?>

<?php
//Products Form
include_once("./templates/products.php");
?>


</body>
</html>
