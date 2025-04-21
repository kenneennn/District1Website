<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "dbibim";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Barangay Name
$stmtBarangayName = $conn->prepare("SELECT BarangayName FROM tblsetbrgyname LIMIT 1");
$stmtBarangayName->execute();
$result = $stmtBarangayName->get_result();
$barangayName = $result->fetch_assoc()['BarangayName'] ?? 'Undefined Barangay Name';
$stmtBarangayName->close();

// Fetch Images
$stmtImages = $conn->prepare("SELECT Image1, Image2 FROM tblimage LIMIT 1");
$stmtImages->execute();
$result = $stmtImages->get_result();
$images = $result->fetch_assoc() ?? ['Image1' => '', 'Image2' => ''];
$stmtImages->close();

// Fetch Kasambahay Data
$queryKasambahay = "SELECT * FROM tblkasambahay";
$kasambahayResult = $conn->query($queryKasambahay);
$kasambahayData = $kasambahayResult->fetch_all(MYSQLI_ASSOC);

// Fetch Purok Data
$puroks = ['Purok Pag-Asa', 'Purok Libis', 'Purok Mabuhay', 'Purok Maligaya', 'Sitio Mananao', 'Purok Mabini', 'Purok Liwanag'];
$purokData = [];

foreach ($puroks as $purok) {
    $stmt = $conn->prepare("SELECT * FROM tblkasambahay WHERE Purok = ?");
    $stmt->bind_param("s", $purok);
    $stmt->execute();
    $result = $stmt->get_result();
    $purokData[$purok] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Fetch Chairman
$stmtChairman = $conn->prepare("SELECT FullName, Signature FROM tblofficialinfo WHERE Position = 'Chairman'");
$stmtChairman->execute();
$result = $stmtChairman->get_result();
$chairmanData = $result->fetch_assoc() ?? ['FullName' => 'Undefined', 'Signature' => ''];
$stmtChairman->close();

// Fetch Secretary
$stmtSecretary = $conn->prepare("SELECT FullName, Signature FROM tblofficialinfo WHERE Position = 'Secretary'");
$stmtSecretary->execute();
$result = $stmtSecretary->get_result();
$secretaryData = $result->fetch_assoc() ?? ['FullName' => 'Undefined', 'Signature' => ''];
$stmtSecretary->close();

$monthYearNow = date("F Y");
$remarks = "Remarks: The Kasambahay records are available for this month.";

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Kasambahay Monthly Report</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .main-container {
            background: #FFFFFF;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            margin: 20px auto;
            width: 1200px;
            border: 1px solid #f57c00;
        }
        .export-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 12px 25px;
            border: none;
            background-color: #f57c00;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .export-button:hover {
            background-color: #e66a00;
            color: #fff;
        }
        h2 {
            text-align: center;
            color: #f57c00;
            margin-bottom: 20px;
            font-size: 30px;
        }
        h3 {
            font-size: 22px;
            color: #f57c00;
            margin-top: 30px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #f57c00;
        }
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
            th, td {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            table {
                font-size: 12px;
            }
            th, td {
                padding: 8px;
            }
        }

        .remarks-section {
            margin-top: 30px;
            font-size: 16px;
            background-color: #fefefe;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #f57c00;
        }
    </style>
</head>
<body>
    <script>
        document.getElementById('exportButton').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = 'export.php';
        });
    </script>
    <div class="main-container">
    <a href="exportkasambahay.php" class="export-button" id="exportButton">
        <i class="fas fa-file-export"></i> Export
    </a>
        <!-- Report Title Section -->
        <h2 style="text-align: center; color: #f57c00; margin-top: 20px;">
            <label style="display: inline-block; padding: 10px 20px; background: #f57c00; color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                Monthly Barangay Consolidated Kasambahay Report
            </label>
        </h2>
        <p>For the Month of <strong><?php echo htmlspecialchars($monthYearNow); ?></strong></p>

        <!-- Report Details -->
        <p>Total Kasambahay: <strong><?php echo count($kasambahayData); ?></strong></p>

        <!-- Purok Data Sections -->
        <?php foreach ($purokData as $purok => $kasambahayList): ?>
            <div>
                <h3><?php echo htmlspecialchars($purok); ?></h3>
                <?php if (!empty($kasambahayList)): ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Civil Status</th>
                                    <th>Purok</th>
                                    <th>Educational Attainment</th>
                                    <th>Employment Status</th>
                                    <th>Nature of Work</th>
                                    <th>Monthly Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kasambahayList as $kasambahay): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($kasambahay['KasambahayName']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['Sex']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['Age']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['CivilStatus']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['Purok']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['EducationalAttainment']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['Status']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['NatureOfWork']); ?></td>
                                        <td><?php echo htmlspecialchars($kasambahay['Salary']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No data available for this Purok.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Remarks Section -->
        <div class="remarks-section">
            <p><?php echo $remarks; ?></p>
        </div>
    </div>
</body>
</html>
