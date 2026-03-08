<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: boarding-house.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "house_db";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $user;
        header("Location: boarding-house.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
