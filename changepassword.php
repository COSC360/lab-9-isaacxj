<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['username']) || !isset($_POST['oldpassword']) || !isset($_POST['newpassword']) || !isset($_POST['newpassword_check'])) {
        echo "Error: All fields are required.";
        exit;
    }
    
    $newpassword = $_POST['newpassword'];
    $newpassword_check = $_POST['newpassword_check'];
    
    if ($newpassword != $newpassword_check) {
        echo "new passwords don't match.";
        exit;
    }

    $username = $_POST['username'];
    $oldpassword = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['newpassword']);

    $host = "localhost";
    $database = "lab9";
    $user = "webuser";
    $password_db = "P@ssw0rd";

    $connection = mysqli_connect($host, $user, $password_db, $database);

    $error = mysqli_connect_error();
    if($error != null)
    {
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    }

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$oldpassword'";
    $results = mysqli_query($connection, $sql);

    if (mysqli_num_rows($results) > 0) {
        $sql = "UPDATE users SET password = '$newpassword' WHERE username = '$username'";

        if (mysqli_query($connection, $sql)) {
        echo "The user's password has been updated.";
        } else {
        echo $sql . "<br>" . mysqli_error($connection);
        }
    } else {
        echo "The username and/or password are invalid.";
    }
    mysqli_close($connection);
} else {
    echo "Invalid request.";
    exit;
}

?>
