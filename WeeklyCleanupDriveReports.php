<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "dbibim";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch Cleanup Drive data
    $queryCleanupDrive = "SELECT CleanupDriveID, WeekNo, Image1, Image2, Image3, Image4, Image5, Image6, NumberofPax, NoofBO, NoofBarangayPersonel, GarbageCollected FROM tblcleanupdrive";
    $stmtCleanupDrive = $pdo->query($queryCleanupDrive);
    $cleanupDrives = $stmtCleanupDrive->fetchAll(PDO::FETCH_ASSOC) ?? [];

    // Fetch Barangay Name data
    $queryBarangayName = "SELECT * FROM tblsetbrgyname";
    $stmtBarangayName = $pdo->query($queryBarangayName);
    $barangayNames = $stmtBarangayName->fetchAll(PDO::FETCH_ASSOC);

    // Fetch logo images
    $queryImages = "SELECT Image1, Image2 FROM tblimage LIMIT 1";
    $stmtImages = $pdo->query($queryImages);
    $images = $stmtImages->fetch(PDO::FETCH_ASSOC);

    // Fetch Chairman and Secretary info from tblofficialinfo
    $queryOfficials = "SELECT FullName, Signature, Position FROM tblofficialinfo WHERE Position IN ('Chairman', 'Secretary')";
    $stmtOfficials = $pdo->query($queryOfficials);
    $officials = $stmtOfficials->fetchAll(PDO::FETCH_ASSOC);

    $chairman = null;
    $secretary = null;

    // Assign data to variables for Chairman and Secretary
    foreach ($officials as $official) {
        if ($official['Position'] === 'Chairman') {
            $chairman = $official;
        } elseif ($official['Position'] === 'Secretary') {
            $secretary = $official;
        }
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Weekly Cleanup Drive Reports</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF;
            color: #333;
            margin: 0;
            padding-top: 50px;
        }
        .container {
            width: auto;
            max-width: 100%;
            overflow-x: auto;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3); /* Added table border */
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: #f57c00; /* Updated text color */
            border: 2px solid #f57c00; /* Added cell borders */
        }

        th {
            background-color: #f57c00;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.3);
            transition: background-color 0.3s ease;
        }

        td img {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        td img:hover {
            transform: scale(4.2);
            z-index: 10;
            position: relative;
        }
        .btn-view {
            background-color: #f57c00;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-view:hover {
            background-color: #f57c00;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f57c00;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
        }
        .back-button:hover {
            background-color: #f57c00;
        }
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        /* Modal Content Styling */
        .modal-content {
            background: #fdfdfd;
            padding: 30px;
            width: 90%;
            max-width: 800px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        /* Modal Header Styling */
        .modal-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2e4b78;
            text-align: left;
        }
        /* Close Button Styling */
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            color: #888;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .modal-close:hover {
            color: #ff5252;
        }
        /* Table Styling */
        .modal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
            color: #444;
        }
        .modal-table th, .modal-table td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        .modal-table th {
            background-color: #e7f1fc;
            color: #f57c00;
            font-weight: bold;
        }
        .modal-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        /* Image Styling */
        .thumbnail img {
            width: 100px;
            height: auto;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .thumbnail img:hover {
            transform: scale(10.1);
            border-color: #f57c00;
        }
        /* Image Popup Styling */
        .image-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .image-popup img {
            max-width: 90%;
            max-height: 90%;
            transform: scale(10);
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .image-popup-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .modal-content {
                padding: 20px;
            }
            .modal-header {
                font-size: 20px;
            }
            .modal-table th, .modal-table td {
                padding: 8px;
            }
            .btn-view {
                padding: 6px 10px;
                font-size: 12px;
            }
            .back-button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
        @media (max-width: 480px) {
            .modal-content {
                padding: 15px;
            }
            .modal-header {
                font-size: 18px;
            }
            .modal-table th, .modal-table td {
                padding: 6px;
            }
            .btn-view {
                padding: 4px 8px;
                font-size: 10px;
            }
            .back-button {
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; color: #f57c00; margin-bottom: 20px;">
            <label style="display: inline-block; padding: 10px 20px; background: #f57c00; color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                Weekly Cleanup Drive Reports
            </label>
        </h1>
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-calendar-week"></i> Week Number</th>
                    <th><i class="fas fa-users"></i> Number of Pax</th>
                    <th><i class="fas fa-user-tie"></i> Number of Barangay Officials</th>
                    <th><i class="fas fa-user-friends"></i> Number of Barangay Personnel</th>
                    <th><i class="fas fa-dumpster"></i> Garbage Collected (in kg)</th>
                    <th><i class="fas fa-camera"></i> Documentation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cleanupDrives as $drive): ?>
                    <tr>
                        <td><?= htmlspecialchars($drive['WeekNo']) ?></td>
                        <td><?= htmlspecialchars($drive['NumberofPax']) ?></td>
                        <td><?= htmlspecialchars($drive['NoofBO']) ?></td>
                        <td><?= htmlspecialchars($drive['NoofBarangayPersonel']) ?></td>
                        <td><?= htmlspecialchars($drive['GarbageCollected']) ?></td>
                        <td>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <?php if (!empty($drive['Image' . $i])): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($drive['Image' . $i]) ?>" alt="Image <?= $i ?>" style="width: 50px; height: 50px; margin-right: 5px; border-radius: 5px;">
                                <?php endif; ?>
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div class="modal-header">Cleanup Drive Details</div>
            <table class="modal-table">
                <tbody>
                    <tr>
                        <td>Week No</td>
                        <td id="weekNo"></td>
                    </tr>
                    <tr>
                        <td>Number of Pax</td>
                        <td id="numberOfPax"></td>
                    </tr>
                    <tr>
                        <td>Number of BO</td>
                        <td id="numberOfBO"></td>
                    </tr>
                    <tr>
                        <td>Number of Barangay Personnel</td>
                        <td id="numberOfBarangayPersonnel"></td>
                    </tr>
                    <tr>
                        <td>Garbage Collected</td>
                        <td id="garbageCollected"></td>
                    </tr>
                    <tr>
                        <td>Documentation</td>
                        <td class="thumbnail" id="images"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Image Popup -->
    <div class="image-popup" id="imagePopup">
        <span class="image-popup-close" onclick="closeImagePopup()">&times;</span>
        <img id="popupImage" src="" alt="Expanded Image">
    </div>

    <script>
        function openModal(data) {
            document.getElementById('weekNo').textContent = data.WeekNo || 'N/A';
            document.getElementById('numberOfPax').textContent = data.NumberofPax || 'N/A';
            document.getElementById('numberOfBO').textContent = data.NoofBO || 'N/A';
            document.getElementById('numberOfBarangayPersonnel').textContent = data.NoofBarangayPersonel || 'N/A';
            document.getElementById('garbageCollected').textContent = data.GarbageCollected || 'N/A';

            const imagesContainer = document.getElementById('images');
            imagesContainer.innerHTML = ''; // Clear previous content
            const images = [data.Image1, data.Image2, data.Image3, data.Image4, data.Image5, data.Image6];
            images.forEach((image, index) => {
                if (image) {
                    const imgElement = document.createElement('img');
                    imgElement.src = `data:image/jpeg;base64,${image}`;
                    imgElement.alt = `Image ${index + 1}`;
                    imgElement.onclick = () => openImagePopup(imgElement.src);
                    imagesContainer.appendChild(imgElement);
                }
            });

            document.getElementById('viewModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('viewModal').style.display = 'none';
        }

        function openImagePopup(src) {
            const popup = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            popupImage.src = src;
            popup.style.display = 'flex';
        }

        function closeImagePopup() {
            document.getElementById('imagePopup').style.display = 'none';
        }
    </script>
</body>
</html>
