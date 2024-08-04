<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "portfolio";

// Connect to db
$con = mysqli_connect($host, $username, $password, $database);

// Check if connected
if ($con === null) {
    die("Connection object is null.");
}

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data
    $name = $con->real_escape_string($_POST['name']);
    $email = $con->real_escape_string($_POST['email']);
    $message = $con->real_escape_string($_POST['message']);

    if (empty($name)) {
        echo "Username is required";
        exit;
    }
    if (empty($email)) {
        echo "Email is required";
        exit;
    }
    if (empty($message)) {
        echo "Message is required";
        exit;
    }

    // Insert to db
    $sql = "INSERT INTO contacts_data (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($con->query($sql) === TRUE) {
        echo "Form submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
} else {
    echo "Invalid request method.";
}

$con->close();
?>
