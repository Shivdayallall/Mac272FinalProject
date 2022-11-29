<?php 
    require __DIR__ . "/dbConnection.php";

    // Gather the user data from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Gather the user from the db
    $sql = "SELECT id, email, user_password FROM usertable WHERE email='$email' and user_password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        // session_start();

        // $_SESSION["user_name"] = $result["username"];

     header("Location: page-1.html");
        
    } else {

    }

    mysqli_close($conn);
?>
    <!-- http://localhost/Mac272Project/ -->