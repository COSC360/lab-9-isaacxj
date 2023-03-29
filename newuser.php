<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $host = "localhost";
    $database = "lab9";
    $user = "webuser";
    $password_db = "P@ssw0rd";

    $connection = mysqli_connect($host, $user, $password_db, $database);


    $error = mysqli_connect_error();
    if($error != null)
    {
        $output = "<p>Unable to connect to lab9 db</p>";
        exit($output);
    }

    //Checking for user 
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $results = mysqli_query($connection, $sql);

    if (mysqli_num_rows($results) > 0) {
        echo nl2br("User already exists with this name and/or email.\n");
        echo "<a href='javascript:history.go(-1)'>Return to user entry</a>";
        mysqli_close($connection);
        exit;
    }

    //Insert user into db
    $sql = "INSERT INTO users (firstName, lastName, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";

    if (mysqli_query($connection, $sql)) {
        echo "An account for user $username has been created.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
    } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo "Invalid request.";
        exit;
    } else {
        echo "Invalid request.";
        mysqli_close($connection);
        exit;
    }
?>