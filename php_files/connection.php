<?php
//  include 'links.php';
/*
This file contains database connection where we are running mysql using user - "root" and password - ""
*/

$server = "localhost";
$username = "root";
$password  = "";
$db = "store";

// Connection to the Database
    $con = mysqli_connect($server,$username,$password,$db);

//Checking the connection
if($con){
    ?>
        <!-- <script>
            swal({
                title: "",
                text: "Connected to Database",
                icon: "success",
                button: "done",
            });
        </script> -->
    <?php
    // header(location : 'register.php');
}else{
    ?>
        <script>
            swal({
                title: "",
                text: "Connection Failed",
                icon: "error",
                button: "close",
            });
        </script> 
        <!-- <script>
            alert("Connection Not Successful");
        </script>  -->
    <?php
}
    

?>