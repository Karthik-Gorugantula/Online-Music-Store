<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'links.php' ?>
    <title>Register</title>

    <style>

        body{
            /* background: linear-gradient(to bottom left, #00ffff 0%, #006699 100%); */
            background-image: url("https://i.postimg.cc/RFqdSkX9/Musicstore7.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                height: 100vh;
        }
        input[type="text"], input[type="password"],
        input[type="number"], input[type="date"],
        input[type="email"],
        select,textarea{
            width:100%;
            margin-bottom: 20px;
            font-size: 1.3rem;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        form{
            width: 520px;
            margin: auto;
            display:block;
            padding: 50px;
            font-size: 1.2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        input:focus{
            color:black;
            background-color:whitesmoke;
        }
        .first{

            padding: 10px 25px;
            color:white;
            font-weight: bold;
            border-style: none;
            border-radius: 10px;
            display: block;
            margin-top : 10px;
            margin: auto;
        }
        fieldset{
            margin-top: 0px;
            margin-bottom: 15px;
            box-shadow: 1px 1px 5px black;
            color: black;
            padding: 30px;
            text-decoration: 2px solid; 
            background-color: white;
            border-bottom-left-radius: 20px;
            border-top-right-radius: 20px;
        }
    </style>    

</head>

<body>
    
    <?php
        include 'connection.php';
        
        if(isset($_POST['submit']))
        {
            $username   = mysqli_real_escape_string($con, $_POST['username']);
            $email      = mysqli_real_escape_string($con, $_POST['email']);
            $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
            $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);

            $pass1 = password_hash($password_1, PASSWORD_BCRYPT);
            $pass2 = password_hash($password_2, PASSWORD_BCRYPT);

            $email_query = " SELECT * FROM userdata WHERE email = '$email' ";

            $query1 = mysqli_query($con, $email_query);

            $emailcount = mysqli_num_rows($query1);
            if($emailcount>0){
                ?>
                    <script>
                        swal({
                            title: "Email already exists",
                            text: "please enter again",
                            icon: "warning",
                            button: "close",
                        });
                    </script>
                <?php
            }
            else{
                if($password_1 === $password_2){

                    $insertquery = "INSERT INTO userdata(`username`, `email`, `password`) VALUES ('$username','$email','$pass1')";
                    
                    $iquery = mysqli_query($con,$insertquery);

                    if($iquery){
                        ?>
                            <script>
                                // alert("Account Created Successfully");
                                swal({
                                    title: "Account Created Successfully",
                                    text: "have a nice day",
                                    icon: "success",
                                    button: "done",
                                });
                            </script> 
                            <script>
                                location.replace("login.php");
                            </script>
                        <?php
                        // header('location: homepage.php');
                    }else{
                        ?>
                            <script>
                                swal({
                                    title: "Sorry there was a problem",
                                    text: "unable to create an acc. at the moment",
                                    icon: "error",
                                    button: "close",
                                });
                            </script> 
                        <?php
                    }
                }
                else{
                    ?>
                    <script>
                        swal({
                            title: "Passwords are not matching",
                            text: "please enter again",
                            icon: "warning",
                            button: "close",
                        });
                    </script> 
                    <?php
                }
            }
        }

    ?>

    <h1 class="mt-5 mb-1 text-center text-white" style = "font-size: 3.5rem"> MUSIC STORE </h1>   

    <!-- SIGN UP FORM -->
    <form class= "mt-0 " action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <!-- <h2> Register </h2> -->
       <fieldset>
       <h2> SIGN UP </h2>
          <!-- <legend>Register</legend> -->
            <!-- <h2>Registration Form</h2> -->
            <!-- USER NAME -->
           <div>  
                <label for="username">Username</label>
                <input type="text" name="username" autocomplete="off" placeholder="enter username" required>
            </div>
            <!-- EMAIL -->
            <div>
                <label for="email">Email Address</label><br>
                <input type="email" name="email" autocomplete="off" placeholder="enter email" required>
            </div>
            <!-- PASSWORDS -->
            <div>
                <label for="password">Password</label>
                <input type="password" name="password_1" autocomplete="off" placeholder="enter password" required>
            </div>
            <div>
                <label for="password">Confirm password</label>
                <input type="password" name="password_2" autocomplete="off"  placeholder="confirm Password" required>
            </div>
            <!-- <br> -->
            <div class="form-group child">
                <button type="submit" class="btn btn-primary btn-block first" name = "submit"> Create Account </button>
            </div>
            <!-- <br> -->
            <p class="text-center">Have an account? <a href="login.php">Log In</a></p>

        </fieldset>
   </form> 

</body>

</html> 
