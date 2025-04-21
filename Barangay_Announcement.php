<?php
include 'db_connection.php';
$sql = "SELECT * FROM tblAnnouncement ORDER BY DatePosted DESC";
$result = mysqli_query($conn, $sql);
$announcements = $result && mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

function displayImage($imageData) {
    if (!empty($imageData)) {
        $encodedImage = base64_encode($imageData);
        return "<img src='data:image/jpeg;base64,$encodedImage' alt='Announcement Image'>";
    } else {
        return "<div class='default-image'><span class='material-icons'>campaign</span></div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Announcements</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #2C3E50, #bdc3c7);
            background-attachment: fixed;
            height: 100vh;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #0D47A1;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
        }

        .back-button-container {
            padding: 20px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #1976D2;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #1565C0;
            transform: scale(1.05);
        }

        .back-button .material-icons {
            font-size: 20px;
        }

        .announcement-panel {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .announcement-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .announcement-item {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .announcement-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .announcement-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .default-image {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #E3F2FD;
            color: #1976D2;
            font-size: 2rem;
            font-weight: 500;
            border-bottom: 1px solid #ddd;
        }

        .announcement-content {
            padding: 20px;
        }

        .announcement-content h4 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0D47A1;
            margin-bottom: 10px;
        }

        .announcement-content p {
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .testimonials {
            margin: 50px 0;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .testimonials h3 {
            text-align: center;
            color: #0D47A1;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .testimonial-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            text-align: center;
        }

        .testimonial-item p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .testimonial-item .author {
            font-weight: bold;
            color: #0D47A1;
        }

        .testimonial-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.8rem;
            }

            .back-button {
                font-size: 14px;
                padding: 8px 12px;
            }

            .announcement-item img {
                height: 160px;
            }
        }

        .social-icons a {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
            color: #555;
        }

        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #f8f9fa;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
        }

        footer div {
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            footer {
                padding: 10px;
            }
            .social-icons {
                flex-wrap: wrap;
                gap: 10px;
            }
            .social-icons a {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            footer {
                padding: 8px;
            }
            .social-icons a {
                font-size: 16px;
            }
            footer div {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="back-button-container">
    <a href="index.php" class="back-button">
        <span class="material-icons">arrow_back</span>Home
    </a>
</div>

<div class="container">
    <div class="announcement-panel">
        <h2>Barangay Announcements</h2>
        <ul class="announcement-list">
            <?php if (empty($announcements)): ?>
                <p style="text-align: center; font-size: 1.2rem; color: #555;">No announcements available at the moment. Please check back later.</p>
            <?php else: ?>
                <?php foreach ($announcements as $row): ?>
                    <li class="announcement-item">
                        <?= displayImage($row['Image']) ?>
                        <div class="announcement-content">
                            <h4><?= htmlspecialchars($row['Title']) ?></h4>
                            <p><strong>Date:</strong> <?= htmlspecialchars($row['DatePosted']) ?></p>
                            <p><?= nl2br(htmlspecialchars($row['Content'])) ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<footer style="position: fixed; bottom: 0; left: 0; width: 100%; height: auto; background-color: #f8f9fa; padding: 10px 0; box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; align-items: center;">
        <div class="social-icons" style="text-align: center; margin-top: 10px; display: flex; justify-content: center; gap: 15px;">
            <a href="https://facebook.com" target="_blank" style="color: #3b5998; font-size: 20px;"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank" style="color: #1da1f2; font-size: 20px;"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank" style="color: #e4405f; font-size: 20px;"><i class="fab fa-instagram"></i></a>
            <a href="https://linkedin.com" target="_blank" style="color: #0077b5; font-size: 20px;"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div style="text-align: center; margin-top: 5px; font-size: 14px; color: #2C3E50;">
            &copy; 2025 District 1 San Manuel, Isabela | All Rights Reserved<br>
            <span style="font-weight: bold;">IBIM-GIS Version 1.0</span>
        </div>
    </footer>

    <style>
        @media (max-width: 768px) {
            footer {
                padding: 15px 10px;
            }
            .social-icons {
                flex-wrap: wrap;
                gap: 10px;
            }
            .social-icons a {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            footer {
                padding: 10px 5px;
            }
            .social-icons a {
                font-size: 16px;
            }
            footer div {
                font-size: 12px;
            }
        }
    </style>
</body>
</html>

<?php
mysqli_close($conn);
?>