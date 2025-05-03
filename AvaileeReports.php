<?php
include 'db_connection.php';

$officialInfo = [];
$result = $conn->query("SELECT FullName, Signature, Position FROM tblofficialinfo WHERE Position IN ('Chairman', 'Secretary')");
while ($row = $result->fetch_assoc()) {
    $position = $row['Position'];
    $officialInfo[$position]['FullName'] = $row['FullName'];
    $officialInfo[$position]['Signature'] = base64_encode($row['Signature']);
}
$barangayName = "Default Barangay Name";
$result = $conn->query("SELECT BarangayName FROM tblsetbrgyname LIMIT 1");
if ($row = $result->fetch_assoc()) {
    $barangayName = $row['BarangayName'];
}
$availeeData = [];
$currentMonth = date('m');
$currentYear = date('Y');
$query = "SELECT Lastname, Firstname, Middlename, Age, DateOfBirth, Sex, EducationalLevel, Course, OSY FROM tblavailee WHERE MONTH(DateOfBirth) = $currentMonth AND YEAR(DateOfBirth) = $currentYear";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $fullName = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'];
    $availeeData[] = [
        'FullName' => $fullName,
        'Age' => $row['Age'],
        'DateOfBirth' => $row['DateOfBirth'],
        'Sex' => $row['Sex'],
        'EducationalLevel' => $row['EducationalLevel'],
        'Course' => $row['Course'],
        'OSY' => $row['OSY']
    ];
}
$monthYear = date("F Y");
$formattedDateNow = date("F d, Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Availee Report</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            padding-top: 50px;
        }
        .container {
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border: 2px solid #f57c00;
            color: #f57c00;
            margin-left: 50px;
            margin-right: 50px;
        }
        .header-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-section img {
            height: 80px;
            margin: 0 10px;
            vertical-align: middle;
        }
        .header-section h2 {
            margin: 10px 0;
            font-size: 1.8em;
            color: #f57c00;
        }
        .header-section p {
            margin: 5px 0;
            font-size: 1.2em;
            color: #f57c00;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .report-table th, .report-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .report-table th {
            background-color: #f57c00;
            color: white;
            font-weight: bold;
        }
        .report-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .report-table tr:hover {
            background-color: #f1f1f1;
        }
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            .header-section h2 {
                font-size: 1.5em;
            }
            .header-section p {
                font-size: 1em;
            }
            .report-table th, .report-table td {
                padding: 8px;
            }
        }
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            .header-section h2 {
                font-size: 1.2em;
            }
            .header-section p {
                font-size: 0.9em;
            }
            .report-table th, .report-table td {
                padding: 6px;
            }
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: #f57c00; /* Updated text color */
            border: 2px solid #f57c00; /* Added cell borders */
        }
    </style>
</head>
<body>
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2 style="text-align: center; color: #f57c00; margin-bottom: 20px;">
            <label style="display: inline-block; padding: 10px 20px; background: #f57c00; color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                Availee Report
            </label>
        </h2>
        <a href="exportavailee.php" class="export-button" id="exportButton" style="background-color: #f57c00; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; text-decoration: none;">
            <i class="fas fa-file-export"></i> Export
        </a>
    </div>
    <p>For the Month of <strong><?= $monthYear ?></strong></p>

    <table class="report-table">
        <thead>
            <tr>
                <th><i class="fas fa-user"></i> Full Name</th>
                <th><i class="fas fa-birthday-cake"></i> Age</th>
                <th><i class="fas fa-calendar-alt"></i> Date of Birth</th>
                <th><i class="fas fa-venus-mars"></i> Sex</th>
                <th><i class="fas fa-graduation-cap"></i> Educational Level</th>
                <th><i class="fas fa-book"></i> Course</th>
                <th><i class="fas fa-user-clock"></i> OSY</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($availeeData as $availee): ?>
                <tr>
                    <td><?= htmlspecialchars($availee['FullName']) ?></td>
                    <td><?= htmlspecialchars($availee['Age']) ?></td>
                    <td><?= htmlspecialchars($availee['DateOfBirth']) ?></td>
                    <td><?= htmlspecialchars($availee['Sex']) ?></td>
                    <td><?= htmlspecialchars($availee['EducationalLevel']) ?></td>
                    <td><?= htmlspecialchars($availee['Course']) ?></td>
                    <td><?= htmlspecialchars($availee['OSY']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        csvFile = new Blob([csv], { type: "text/csv" });

        downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";

        document.body.appendChild(downloadLink);
        downloadLink.click();
    }

    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll(".report-table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);

            csv.push(row.join(","));
        }

        downloadCSV(csv.join("\n"), filename);
    }
</script>
</body>
</html>
