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
                    text: "",
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
    <title>Cart page</title>

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
                    <a class="nav-link" href="homepage.php"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="cart.php"><i class="fas fa-shopping-cart"></i>(<?php echo $_SESSION['count'] ?>)
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


    <div class="container mb-5 mt-3">
        <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- REMOVED A DIV ELEMENT CONSISTING OF ALERTS -->
                    <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                        echo $_SESSION['showAlert'];   
                        } else {
                        echo 'none';
                        } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><?php if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        } unset($_SESSION['showAlert']); ?></strong>
                    </div>

                    
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <td colspan="7">
                                    <h3 class="text-center mt-2"> Products in your cart </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <th> ID </th>
                                    <th> IMAGE </th>
                                    <th> PRODUCT </th>
                                    <th> PRICE </th>
                                    <th> QUANTITY </th>
                                    <th> TOTAL  </th>
                                    <th>
                                        <a style="" href="action.php?clear=all" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure want to clear your cart?');">
                                            &nbsp;CLEAR
                                        </a>
                                        <!-- <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a> -->
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                require 'connection.php';
                                $stmt = $con->prepare('SELECT * FROM cart');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $grand_total = 0;
                                while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                    <input type="hidden" class="pid" name="npid" value="<?= $row['id'] ?>">
                                <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                                <td><?= $row['product_name'] ?></td>
                                <td>
                                    <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= $row['product_price']; ?>
                                </td>
                                    <input type="hidden" class="pprice"  name="nprice" value="<?= $row['product_price'] ?>">
                                <td>
                                <input type="number" class="text-center form-control itemQty" href="action.php?npid=<?= $row['id'] ?>"  name="nqty" value="<?= $row['quantity'] ?>" style="width:75px;">
                                </td>
                                <td><i class="fas fa-rupee-sign itotal"></i>&nbsp;&nbsp;<?= $row['total_price']; ?></td>
                                <td class="mt-2">
                                <a style="font-size:1rem; " href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                                <?php $grand_total += $row['total_price']; ?>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="3" class="mt-2">
                                <a href="homepage.php" class="btn btn-primary mt-2"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                                    Shopping</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                                <td>
                                <a href="homepage.php" class="btn btn-warning <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
  </div>


  <script type="text/javascript">

        var  $pprice = document.getElementByClassName('pprice');
        var  $qty = document.getElementByClassName('itemQty');
        var  $itotal = document.getElementByClassName('itotal');

        function subTotal()


        $(document).ready(function() {

            // Change the item quantity
            $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');

            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            location.reload(true);
            console.log(qty);
            $.ajax({
                url: 'action.php',
                method: 'post',
                cache: false,
                data: {
                qty: qty,
                pid: pid,
                pprice: pprice
                },
                success: function(response) {
                console.log(response);
                }
            });
            });

            // Load total no.of items added in the cart and display in the navbar
            load_cart_item_number();

            function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                cartItem: "cart-item"
                },
                success: function(response) {
                $("#cart-item").html(response);
                }
            });
            }
        });
  </script>

</body>
</html>