<?php
// Start the session
session_start();
// Database connection
$host = "localhost";
$username = "root"; // Change this if your DB user is different
$password = "";     // Change this if your DB password is not empty
$database = "house_db";
// Create connection
$conn = new mysqli($host, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_username = $_POST['username'];
    $owner_password = $_POST['password'];
    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT * FROM owner WHERE owner_username = ? AND owner_password = ?");
    $stmt->bind_param("ss", $owner_username, $owner_password);
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if match found
    if ($result->num_rows == 1) {
        $_SESSION['owner_username'] = $owner_username;
        echo "Login successful. Redirecting...";
        header("Location: owner_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
    $stmt->close();
}
$conn->close();
?>
<!-- Simple HTML login form -->
<!DOCTYPE html>
<html>
<head>
    <title>Owner Login</title>
</head>
<body>
    <h2>Owner Login</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
