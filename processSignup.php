<?php 
    require __DIR__ . "/dbConnection.php";
    
    // Gather the user data from the form
    $userName = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // validate the user credentials on the server

    // validate username
    if(empty($_POST['username'])) {
        die("Name is requried");
    }

    // validate email
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Valid email is requried");
    }

    // validate password
    if(strlen($_POST['password']) < 8) {
        die("password must be at least 8 character long");
    }

    // check if password match
    if($_POST['password'] !== $_POST['confirmPassword']) {
        die("Passowrd must match");
    }

    // Hash user password for security
    $hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $hashConfirmPassword = password_hash($_POST["confirmPassword"], PASSWORD_DEFAULT);


    // Insert the new user into the table
    $sql = "INSERT INTO usertable(username, email, user_password, confirm_userpassword) VALUES('$userName', '$email', '$hashPassword', '$hashConfirmPassword')";

    if(mysqli_query($conn, $sql)) {
        header("Location: page-1.php");
        exit;
       
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

?>
    <!-- http://localhost/MAC272FINALPROJECT/mac272Project/users/signUp.php -->