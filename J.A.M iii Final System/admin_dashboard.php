<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $housename = htmlspecialchars(strip_tags(trim($_POST['housename'])));
    $owner = htmlspecialchars(strip_tags(trim($_POST['owner'])));
    $contact = htmlspecialchars(strip_tags(trim($_POST['contact'])));
    $rooms = filter_var($_POST['rooms'], FILTER_VALIDATE_INT);
    $boarders = filter_var($_POST['boarders'], FILTER_VALIDATE_INT);
    $rent = filter_var($_POST['rent'], FILTER_VALIDATE_INT);
    $vacancy = htmlspecialchars(strip_tags(trim($_POST['vacancy'])));

    $stmt = $connection->prepare("INSERT INTO bh_profile (housename, owner, contact, rooms, boarders, rent, vacancy) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiis", $housename, $owner, $contact, $rooms, $boarders, $rent, $vacancy);
    $stmt->execute();
    $stmt->close();
}

// Handle Edit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $housename = htmlspecialchars(strip_tags(trim($_POST['housename'])));
    $owner = htmlspecialchars(strip_tags(trim($_POST['owner'])));
    $contact = htmlspecialchars(strip_tags(trim($_POST['contact'])));
    $rooms = filter_var($_POST['rooms'], FILTER_VALIDATE_INT);
    $boarders = filter_var($_POST['boarders'], FILTER_VALIDATE_INT);
    $rent = filter_var($_POST['rent'], FILTER_VALIDATE_INT);
    $vacancy = htmlspecialchars(strip_tags(trim($_POST['vacancy'])));

    $stmt = $connection->prepare("UPDATE bh_profile SET housename=?, owner=?, contact=?, rooms=?, boarders=?, rent=?, vacancy=? WHERE id=?");
    $stmt->bind_param("sssiiisi", $housename, $owner, $contact, $rooms, $boarders, $rent, $vacancy, $id);
    $stmt->execute();
    $stmt->close();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM bh_profile WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch Data
$result = $connection->query("SELECT * FROM bh_profile");
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $connection->query("SELECT * FROM bh_profile WHERE id = $id");
    $editData = $editResult->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-image: url(image/bg.jpg);
    margin: 0;
    padding: 0;
}

/* Navbar */
.navbar {
        background: color 0%;;
        padding: 15px;
        display: flex;
        justify-content: flex-end;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

}
.nav-links {
    list-style: none;
    margin: 0;
    padding: 0;
}
.nav-links li {
    display: inline;
    margin-right: 15px;
}
.nav-links a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}
.logout-btn {
        text-decoration: none;
        color: white;
        background-color: #25705a;
        padding: 10px 15px;
        border-radius: 5px;
        transition:  0.3s ease;
}
        .logout-btn:hover {
        background-color: gray;
}


/* Table */
.table-container {
    width: 90%;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.table-container h3 {
    text-align: center;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
th {
    background-color: #25705a;
    color: white;
}
td a {
    color: #d9534f;
    text-decoration: none;
}
td a:hover {
    text-decoration: underline;
}

/* Forms */
.dashboard-section {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin: 20px;
}
.container {
    width: 45%;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}
.container h3 {
    text-align: center;
}
.form-container {
    display: flex;
    flex-direction: column;
}
.form-container input {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.form-container button {
    background-color: #25705a;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.form-container button:hover {
    background-color: gray;
}

    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </nav>
    <section class="table-container">
    <h3>Boarding House List</h3>
    <table>
        <tr>
            <th>House Name</th>
            <th>Owner</th>
            <th>Contact</th>
            <th>Rooms</th>
            <th>Boarders</th>
            <th>Rent</th>
            <th>Vacancy</th>
            <th>Action</th>
        </tr>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>  
                <td><?php echo $row['housename']; ?></td>
                <td><?php echo $row['owner']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['rooms']; ?></td>
                <td><?php echo $row['boarders']; ?></td>
                <td><?php echo $row['rent']; ?></td>
                <td><?php echo $row['vacancy']; ?></td>
                <td>
                    <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<section class="dashboard-section">
    <div class="container">
        <h3>Add Boarding House</h3>
        <div class="form-container">
            <form method="POST">
                <input type="text" name="housename" placeholder="Boarding House Name" required>
                <input type="text" name="owner" placeholder="Owner Name" required>
                <input type="text" name="contact" placeholder="Contact" required>
                <input type="number" name="rooms" placeholder="Total Rooms" required>
                <input type="number" name="boarders" placeholder="Number of Boarders" required>
                <input type="number" name="rent" placeholder="Rent Amount" required>
                <input type="text" name="vacancy" placeholder="Vacancy Status" required>
                <button type="submit" name="add">Add Boarding House</button>
            </form>
        </div>
    </div>
    
    <div class="container">
        <h3>Update Boarding House</h3>
        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
                <input type="text" name="housename" placeholder="Boarding House Name" required value="<?php echo $editData['housename'] ?? ''; ?>">
                <input type="text" name="owner" placeholder="Owner Name" required value="<?php echo $editData['owner'] ?? ''; ?>">
                <input type="text" name="contact" placeholder="Contact" required value="<?php echo $editData['contact'] ?? ''; ?>">
                <input type="number" name="rooms" placeholder="Total Rooms" required value="<?php echo $editData['rooms'] ?? ''; ?>">
                <input type="number" name="boarders" placeholder="Number of Boarders" required value="<?php echo $editData['boarders'] ?? ''; ?>">
                <input type="number" name="rent" placeholder="Rent Amount" required value="<?php echo $editData['rent'] ?? ''; ?>">
                <input type="text" name="vacancy" placeholder="Vacancy Status" required value="<?php echo $editData['vacancy'] ?? ''; ?>">
                <button type="submit" name="update">Update Boarding House</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>
