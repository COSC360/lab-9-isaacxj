<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        echo "All fields are required.";
        exit;
    }
    $username = $_POST['username'];
    $password = md5($_POST['password']);

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

    //Check username/password combo
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $results = mysqli_query($connection, $sql);

    if (mysqli_num_rows($results) > 0) {
        echo "The user has a valid account.";
    } else {
        echo "The username/password are invalid.";
    }

    mysqli_close($connection);
}
?>
