<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "house_db";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$result = $connection->query("SELECT * FROM bh_profile");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding House Details</title>
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
        }

        .nav-links a {
            text-decoration: none;
            color:black;
            font-size: 18px;
            transition: color 0.3s;
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

        .more-button {
            background-color: #25705a;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .more-button:hover {
            background-color: #25705a;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .boarding-house-image {
                flex: 1 1 calc(33.33% - 10px);
                max-width: calc(33.33% - 10px);
            }
        }

        @media (max-width: 768px) {
            .boarding-house-info {
                padding: 20px;
            }

            .boarding-house-image {
                flex: 1 1 calc(50% - 10px);
                max-width: calc(50% - 10px);
                height: 150px;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .boarding-house-image {
                flex: 1 1 100%;
                max-width: 100%;
                height: 150px;
            }
        }
    </style>
    <script>
        function toggleDetails(id) {
            var details = document.getElementById(id);
            details.style.display = details.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="map.html">Map</a></li>
            <li><a href="boarding-house.php">Boarding House Information</a></li>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
        </ul>
    </nav>

    <section class="boarding-house-info">
        <h2>Maloro, Tangub City Boarding House</h2>

        <div id="boarding-house-list">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="boarding-house-item">
                <h3><?php echo $row['housename']; ?></h3>

                <?php if ($row['housename'] === 'Jomai BH'): ?>
                <div class="image-container">
                    <img src="image/jomai1.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai2.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai3.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai4.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai6.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai7.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai8.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                    <img src="image/jomai9.jpg" alt="Jomai BH Image" class="boarding-house-image" />
                </div>
                <?php endif; ?>

                <?php if ($row['housename'] === 'Decina BH'): ?>
                <div class="image-container">
                    <img src="image/decina1.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina2.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina3.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina4.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina5.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina6.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina7.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina8.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina9.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina10.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina11.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/decina12.jpg" alt="Decina BH Image" class="boarding-house-image" />
                </div>
                <?php endif; ?>

                <?php if ($row['housename'] === 'Labuguen BH'): ?>
                <div class="image-container">
                    <img src="image/labuguen1.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen2.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen3.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen4.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen5.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen8.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen9.jpg" alt="Decina BH Image" class="boarding-house-image" />
                    <img src="image/labuguen10.jpg" alt="Decina BH Image" class="boarding-house-image" />
                </div>
                <?php endif; ?>

                <button class="more-button" onclick="toggleDetails('details-<?php echo $row['id']; ?>')">More</button>
                <div id="details-<?php echo $row['id']; ?>" style="display:none;">
                    <p>Owner/Caretaker: <?php echo $row['owner']; ?></p>
                    <p>Contact: <?php echo $row['contact']; ?></p>
                    <p>Number of Rooms: <?php echo $row['rooms']; ?></p>
                    <p>Total Number of Boarders: <?php echo $row['boarders']; ?></p>
                    <p>Rent Value: ₱<?php echo $row['rent']; ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
</body>
</html>

<?php $connection->close(); ?>
