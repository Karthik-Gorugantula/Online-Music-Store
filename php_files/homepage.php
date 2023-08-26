<?php
    session_start();
    if(!isset($_SESSION['username'])){
        ?>
            <script>
                swal({
                    title: "You have been logged out",
                    text: "Sorry! login in to enter",
                    icon: "info",
                    button: "Close",
                });
            </script> 
        <?php       
        header('location: login.php');
        // location.replace("homepage.php");
    }
    if(isset($_SESSION['username'])){
        ?>
            <script>
                swal({
                    title: "Logged in Successfully",
                    text: "have a nice day",
                    icon: "success",
                    button: "Close",
                });
            </script> 
            
        <?php  
        include 'connection.php';
        $cart_query = "SELECT * FROM cart";
        $cart_query = mysqli_query($con, $cart_query);
        $cart_count = mysqli_num_rows($cart_query);

        $_SESSION['count'] = $cart_count;

        if(isset($_SESSION['count']))
        {
            $_SESSION['count'] = $cart_count;
        }
        else{
            $_SESSION['count'] = 0;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'links.php'; ?>
    <title>Home page</title>

</head>

<body>
    <?php   
        if(isset($_POST['logout']))
        {
            ?>
            <script>
                swal({
                    title: "You have been logged out",
                    text: "",
                    icon: "success",
                    button: "Close",
                });
            </script> 
            <?php    
        }
    ?>   

        <nav class="navbar navbar-expand-md bg-dark navbar-dark">

            <a class="navbar-brand ps-4 m-2" style="font-size: 2rem" href="homepage.php"><i class="fas fa-music"  style="font-size: 2rem"></i>&nbsp;&nbsp;MUSIC STORE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto pe-5">
                    <li class="nav-item">
                        <a class="nav-link active" href="homepage.php"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i>(<?php echo $_SESSION['count'] ?>)
                        <span id="cart-item" class="badge badge-danger"></span>&nbsp;CART</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn logout_btn" type="submit" name="logout">
                                <a href="logout.php" name="logout" class="logout_btn" style="color:white"> <i class="fas fa-sign-out-alt"></i>LOGOUT</a>
                        </button>
                    </li>
                </ul>
            </div>

        </nav>

        <div> 
            <div class="text-center text-dark display-6 p-1 mt-3 mb-3">
                <i><strong>" Music delivered at the bid of your fingertips "</strong></i>
                <br>
                <h5>Browse Our Products In The Following Categories<h5> 
            </div>
            <!-- <div class="text-center h4 py-4"> </div>   -->
        </div>

        <!-- Displaying Products Start -->
        <div class="container">
            <div id="message"></div>
            <div class="row mt-2 pb-3">

                <?php
                        include 'connection.php';
                        $data = $con->prepare('SELECT * FROM category');
                        $data->execute();
                        $result = $data->get_result();
                        while ($row = $result->fetch_assoc()):
                ?>

                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-2 ms-5 me-5">
                    <div class="card-deck">
                        <div class="card p-2 border-secondary mb-4" style="border: 2px solid black; box-shadow: 2px 2px 5px solid black">
                            <img src="<?= $row['image'] ?>" class="card-img-top" height="220">
                            <div class="card-body p-1">
                                <h4 class="card-title text-center"><?= $row['catname'] ?></h4>
                            </div>    
                            <div class="card-footer text-center">
                                <a href="<?= $row['filename'] ?>" class="btn btn-success btn-block align-center addItemBtn">&nbsp;Explore&nbsp;</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

</body>
</html>