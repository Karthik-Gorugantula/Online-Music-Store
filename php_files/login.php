<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'links.php' ?>
    <title>Login</title>

    <style>

        .bk{
            /* background: linear-gradient(to bottom left, #00ffff 0%, #006699 100%); */
                background-image: url("https://i.postimg.cc/RFqdSkX9/Musicstore7.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                height: 100vh;
                position: relative;
            
        }
        .bk::before{
                content: "";
                background-image: url("https://i.postimg.cc/RFqdSkX9/Musicstore7.jpg");
                background-size: cover;
                position: absolute;
                top: 0px;
                bottom: 0px;
                left: 0px;
                right: 0px;
                opacity: 0.1;
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
            position: relative;
            width: 520px;
            margin: auto;
            display:block;
            padding: 50px;
            font-size: 1.2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            /* z-index: -2; */
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
            margin-top: 20px;
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

<body class="bk">
    
    <?php
        include 'connection.php';

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password_1'];

            $email_search = "SELECT * FROM userdata WHERE email='$email'";
            
            $query = mysqli_query($con, $email_search);

            $email_count = mysqli_num_rows($query);

            if($email_count){
                // Variable (password the user has entered) //
                $email_pass = mysqli_fetch_assoc($query);

                // Variable (name and password in database) //
                $db_pass = $email_pass['password'];
                // with the help of SESSION (global access)
                $_SESSION['username'] = $email_pass['username'];
                
                // Checking both passwords //
                $pass_decode = password_verify($password,$db_pass);

                if($pass_decode){
                    ?>
                        <script>
                            swal({
                                title: "Logged In Successfully",
                                text: "have a nice day",
                                icon: "success",
                                button: "done",
                            });
                        </script>
                        <script>
                            location.replace("homepage.php");
                        </script> 
                    <?php
                    
                }
                else{
                    ?>
                        <script>
                            swal({
                                title: "Incorrect Password",
                                text: "please enter again",
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
                            title: "Invalid Email",
                            text: "please enter again",
                            icon: "error",
                            button: "close",
                        });
                    </script> 
                <?php         
            }
        }


    ?>  

    <div class="container"> 
        <div class="mt-5"> 
            <h1 class=" mb-1 mt-4 text-center" style = "margin-top:2rem; position:relative; color:white;font-size: 4.5rem"> MUSIC STORE </h1>   

            <form  class= "mt-0" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                <fieldset style="">
                    <h2> LOG IN </h2>

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
                    
                    <!-- <br> -->
                    <div class="form-group child first">
                        <button type="submit" class="btn btn-primary btn-block first" name = "submit"> Log in </button>
                    </div>
                    <!-- <br> -->
                    <p class="text-center">Don't have an account? <a href="register.php">Sign-Up here.</a></p>

                </fieldset>
            </form> 
            
        </div>
        
    </div>
    


</body>

</html> 