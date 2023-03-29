<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username'])) {
        echo "All fields are required.";
        exit;
    }
    $username = $_POST['username'];

    $host = "localhost";
    $database = "lab9";
    $user = "webuser";
    $password_db = "P@ssw0rd";

    $connection = mysqli_connect($host, $user, $password_db, $database);

    $error = mysqli_connect_error();
    if($error != null)
    {
        $output = "<p>Unable to connect to database</p>";
        exit($output);
    }

    $sql = "SELECT firstName, lastName, email FROM users WHERE username = '$username'";
    $results = mysqli_query($connection, $sql);

    if (mysqli_num_rows($results) > 0) {
        $row = $results->fetch_assoc();
        echo "<fieldset>";
        echo "<legend>User: ".$username."</legend>";
        echo "<table>";
        echo "<tr><td>First Name:</td><td>". $row['firstName']."</td></tr>";
        echo "<tr><td>Last Name:</td><td>". $row['lastName']."</td></tr>";
        echo "<tr><td>Email:</td><td>". $row['email']."</td></tr>";
        echo "</table>";
        echo "</fieldset>";
    } else {
        echo "User not found.";
    }

    mysqli_free_result($results);
    mysqli_close($connection);
    } else {
    echo "Invalid request.";
    exit;
    }

?>
