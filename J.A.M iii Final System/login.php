<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bh_finder";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $role = $_POST["role"];
    if ($role == "admin") {
        $sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
        $dashboard = "admin_dashboard.php";
    } elseif ($role == "owners") {
        $sql = "SELECT * FROM owners WHERE username='$user' AND password='$pass'";
    } else {
        $error = "Invalid role selected!";
        $sql = "";
    }
    if (!empty($sql)) {
        $result = $connection->query($sql);
        if ($result && $result->num_rows == 1) {
            $_SESSION['username'] = $user;
            if ($role == "owners") {
                switch (strtolower($user)) {
                    case 'calvin decina':
                        $dashboard = 'owners_dashboard1.php';
                        break;
                    case 'julieta coma':
                        $dashboard = 'owners_dashboard2.php';
                        break;
                    case 'badeth':
                        $dashboard = 'owners_dashboard3.php';
                        break;
                    default:
                        $error = "Owner not recognized.";
                        $dashboard = "";
                        break;
                }
            }
            if (!empty($dashboard)) {
                header("Location: $dashboard");
                exit();
            }
        } else {
            $error = "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            background-image: url(image/bg.jpg);
        }

        .navbar {
            padding: 5px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 18px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            text-decoration: underline;
            color: #25705a;
        }

        .main-content {
            display: flex;
            justify-content: center;
            margin-top: 50px;
            padding: 20px;
        }

        .login-section {
            width: 320px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
        }

        input, select {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-button {
            background-color: #25705a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .login-button:hover {
            background-color: gray;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 0.9em;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="map.html">Map</a></li>
            <li><a href="boarding-house.php">Boarding House</a></li>
            <li><a href="login.php">Dashboard</a></li>
        </ul>
    </nav>

    <!-- Login Form -->
    <main class="main-content">
        <div class="login-section">
            <h2>Login</h2>
            <form method="POST" action="">
                <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
                
                <label for="role">Login as:</label>
                <select name="role" id="role" required>
                    <option value="">-- Select Role --</option>
                    <option value="admin">Admin</option>
                    <option value="owners">Owners</option>
                </select>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </main>

</body>
</html>
