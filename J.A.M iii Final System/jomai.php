<?php
$connection = new mysqli("localhost", "root", "", "house_db");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$bh = $connection->query("SELECT * FROM bh_profile WHERE housename = 'Jomai BH'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jomai BH</title>
    <style>
        body{
            background-image: url(image/bg.jpg);
        }
        .nav-links {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        .nav-links li {
            margin: 0 15px;
            justify-content: center;
        }

        .nav-links a {
            text-decoration: none;
            color:black;
            font-size: 18px;
            transition: color 0.3s;
            justify-content: center;
        }

        .nav-links a:hover {
            text-decoration: underline;
            color: #25705a; /* Hover color */
        }

        .nav-links a:active {
            color: #ff6600; /* Color when clicked */
        }
        .boarding-house-info {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            justify-content: center;
        }

        .boarding-house-info h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 40px;
            color: #222;
   
        }

        .boarding-house-item {
            background-color: #f9f9f9;
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);

        }

        .boarding-house-item h3 {
            font-size: 26px;
            margin-bottom: 15px;
            color: #333;

        }

        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .boarding-house-image {
            flex: 1 1 calc(25% - 10px); /* 4 images per row */
            max-width: calc(25% - 10px);
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .boarding-house-item p {
            font-size: 16px;
            color: #444;
            margin: 6px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="map.html">Map</a></li>
            <li><a href="boarding-house.php">Boarding House Information</a></li>
            <li><a href="login.php">Dashboard</a></li>
        </ul>
    </nav>

    <h2>Jomai BH Details</h2>

    <div class="image-container">
        <img src="image/jomai1.jpg" class="boarding-house-image">
        <img src="image/jomai2.jpg" class="boarding-house-image">
        <img src="image/jomai3.jpg" class="boarding-house-image">
        <img src="image/jomai4.jpg" class="boarding-house-image">
        <img src="image/jomai6.jpg" class="boarding-house-image">
        <img src="image/jomai7.jpg" class="boarding-house-image">
        <img src="image/jomai8.jpg" class="boarding-house-image">
        <img src="image/jomai9.jpg" class="boarding-house-image">
    </div>

    <div class="details">
        <p>Owner/Caretaker: <?= $bh['owner'] ?></p>
        <p>Contact: <?= $bh['contact'] ?></p>
        <p>Number of Rooms: <?= $bh['rooms'] ?></p>
        <p>Total Boarders: <?= $bh['boarders'] ?></p>
        <p>Rent Value: ₱<?= $bh['rent'] ?></p>
    </div>
</body>
</html>

<?php $connection->close(); ?>
