<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <?php include 'links.php'; ?>
        <title>Piano Page</title>

</head>

<body>


   
    <?php
        include 'connection.php';
        if(isset($_POST['submit-cart']))
        {
            $p_id     =  mysqli_real_escape_string($con, $_POST['pid']);
            $p_name   =  mysqli_real_escape_string($con, $_POST['pname']);
            $p_price  =  mysqli_real_escape_string($con, $_POST['pprice']);
            $p_image  =  mysqli_real_escape_string($con, $_POST['pimage']);
            $p_code   =  mysqli_real_escape_string($con, $_POST['pcode']);
            $p_qty    =  mysqli_real_escape_string($con, $_POST['pqty']);

            // echo $p_qty;

            // var_dump($p_price);
            // $p_price += 0.00;
            // $total_price = 100;

            $id_query = "SELECT product_code FROM cart WHERE product_code like '$p_code'; ";
            $query1 = mysqli_query($con, $id_query);
            $idcount = mysqli_num_rows($query1);

            // To get variables

            if($idcount>0){
                // // Variable (password the user has entered) //
                // $value_rows = mysqli_fetch_assoc($query1);
                // // Variable (name and password in database) //
                // $old_qty = $value_rows['quantity'];

                // $new_qty = $p_qty + $old_qty ;
                // echo $new_qty;
                ?>
                    <script>
                        swal({
                            title: "Added again to cart",
                            text: "",
                            icon: "warning",
                            button: "close",
                        });
                    </script>
                <?php

            }
            else{
                if($p_qty==0)
                {
                    $p_qty=1;
                }
                $total_price =  $p_price * $p_qty;

                $insertquery = "INSERT INTO cart (product_name,product_price,product_image,quantity,total_price,product_code) VALUES
                                    ('$p_name','$p_price','$p_image','$p_qty','$total_price','$p_code')";
                $iquery = mysqli_query($con,$insertquery);

                if($iquery){
                    ?>
                        <script>
                            swal({
                                title: "Item added to cart",
                                text: "",
                                icon: "success",
                                button: "done",
                            });
                        </script>
                    <?php
                    ?>
                        <!-- <script>
                            location.replace("guitars.php");
                        </script> -->
                    <?php
                    // header('location: homepage.php');
                }else{
                    ?>
                        <script>
                            swal({
                                title: "Sorry there was a problem",
                                text: "unable to add an item at the moment",
                                icon: "error",
                                button: "close",
                            });
                        </script> 
                    <?php
                }
            }
        }


    ?>

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
                        <a class="nav-link" href="homepage.php"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> (<?php echo $_SESSION['count'] ?>)
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
        

        <!-- DISPLAY OF PRODUCTS -->
        <div class="container mt-2">
            <div id="message"></div>
            <img src="https://i.postimg.cc/SxJMssBZ/Image-01-eb894ef9737c0db554ad2eafbaae6659.webp" class="mt-3">
            <div class="row mt-2 pb-3">
                <?php
                    include 'connection.php';
                    $data_g = $con->prepare('SELECT * FROM products WHERE catid=3');
                    $data_g->execute();
                    $result = $data_g->get_result();
                    while ($row = $result->fetch_assoc()):
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2 ms-5 me-5 mt-4">
                    <div class="card-deck">
                        <div class="card p-2 pb-2 border-secondary mb-3" style="border: 2px solid black; box-shadow: 2px 2px 5px solid black">
                            <img src="<?= $row['pimage'] ?>" class="card-img-top" height="240" width="200">
                            
                            <div class="card-body p-2">
                                
                                <h5 class="card-title"><?= $row['pname'] ?></h5>
                                <h5 class="card-text text-center text-danger"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['pprice'],2); ?>/-</h5>

                            </div>

                            <div class="card-footer p-3 m-1 text-center">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" name='submit-cart' method="POST" class="form-submit">
                                    <div class="row p-2">
                                    <div class="col-md-6 py-1 pl-4">
                                        <b>Quantity : </b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control pqty" name= "pqty" value="<?= $row['pqty'] ?>">
                                    </div>
                                    </div>
                                    <input type="hidden" class="pid"    name="pid"    value="<?= $row['pid'] ?>">
                                    <input type="hidden" class="pname"  name="pname"  value="<?= $row['pname'] ?>">
                                    <input type="hidden" class="pprice" name="pprice"  value="<?= $row['pprice'] ?>">
                                    <input type="hidden" class="pimage" name="pimage"  value="<?= $row['pimage'] ?>">
                                    <input type="hidden" class="pcode"  name="pcode"  value="<?= $row['pcode'] ?>">    

                                    <button class="btn btn-success btn-block addItemBtn" name="submit-cart"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                                    cart</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
  <!-- Displaying Products End -->
        <!-- ABOUT US -->
        <div class="container mt-2">
                
            <div class=" mb-3 p-2 bg-white border border-dark border-2" style="border-radius: 7px;">
                <h2 class="text-center">About Us</h2>
                <p class="p-2 m-auto">
                    SIGMA brings to you one of the most popular and most played musical instruments around the world, with
                    the lowest price guarantee. We have an extensive range of guitars like electric guitars, acoustic
                    guitars, acoustic-electric guitars, mandolins, banjos, resonator guitars, Ukulele and more to buy from.
                    We are dedicated to make sure that we have an instrument that suits you whether you are looking for a
                    beginner’s guitar or a seasoned professional’s axe, from the best brands worldwide such as Ibanez,
                    Fender, Cort, Gibson, Epiphone, Washburn, Walden, Takamine, Cort, ESP, PRS, Jackson, BC Rich, Dean,
                    Granada, Pluto, Squier, Silvertone, Schecter, GB&A, Greg Bennett, Martin, Taylor, DJT Pro.
                    To ensure 100% customer satisfaction SIGMA offers 10-day return policy and we also pay for the return
                    shipping to help you be free of the online shopping anxiety. Our content rich page is your one stop to
                    get all the required information about the products be it the product description or the user generated
                    hands on reviews. A friendly and knowledgeable staff is there to help you out with your queries should
                    there be anything else you wish to know about the product, process, payment or after sale service. Our
                    dedicated team will help you to select from the best of the products within your range. 
                </p>
            </div>
            
        </div>

</body>

</html>