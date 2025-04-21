<?php
include 'db_connection.php';

// SQL query to fetch the distinct months for the current year
$query = "SELECT DISTINCT MONTH(DateofClearingOperation) AS Month 
          FROM tblbarco 
          WHERE YEAR(DateofClearingOperation) = YEAR(CURDATE())";

// Execute the query and store the result
$result = $conn->query($query);

// Check if there are any results
if ($result->num_rows > 0) {
    $months = [];
    while ($row = $result->fetch_assoc()) {
        $months[] = $row['Month'];
    }
} else {
    $months = [];
}

// SQL query to fetch all records for the current year
$queryRecords = "SELECT ConductedRCo, MONTH(DateofClearingOperation) AS Month, Location, RoadLength, 
                 DateofClearingOperation, ActionTaken, Remarks, TotalSKOfficial, NoofBO, TotalPersonel, 
                 Image1, Image2, Image3 
                 FROM tblbarco 
                 WHERE YEAR(DateofClearingOperation) = YEAR(CURDATE())";

// Execute the query and store the result
$resultRecords = $conn->query($queryRecords);

// Check if there are any results
if ($resultRecords->num_rows > 0) {
    $records = [];
    while ($row = $resultRecords->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    $records = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Monthly Barco Report</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <style>
        /* General Reset */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Century Gothic', sans-serif;
            background-color: #FFFFFF;
            color: #333;
            margin: 0;
            padding-top: 50px; /* Adjusted padding for consistency */
        }

        /* Container */
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

        /* Header */
        h1 {
            text-align: center;
            font-size: 2.2rem;
            color: #1E2A38;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        /* Table Styling */
        table {
            width: auto;
            min-width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
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

        /* Button Styling */
        button {
            padding: 10px 20px;
            background-color: #f57c00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(1px);
        }

        /* No Data Message */
        .no-records {
            text-align: center;
            font-style: italic;
            color: #fff;
            padding: 20px;
        }

        /* Modal Overlay */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Modal Content */
        .modal-content {
            background: #ffffff;
            width: 90%; /* Adjusted width for consistency */
            max-width: 800px; /* Aligned with other files */
            border-radius: 10px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            animation: slideDown 0.4s ease-in-out;
            position: relative;
            padding: 20px;
            overflow: hidden;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: #2F4F66;
        }

        .close-btn {
            background: none;
            border: none;
            color: #333;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .close-btn:hover {
            color: #ff6b6b;
        }

        #modalContent {
            max-height: 400px;
            overflow-y: auto;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.8rem;
            }

            table th, table td {
                font-size: 0.9rem;
                padding: 10px;
            }

            .modal-content {
                width: 95%;
            }
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
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; color: #f57c00; margin-bottom: 20px;">
            <label style="display: inline-block; padding: 10px 20px; background: #f57c00; color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                Monthly Road Clearing Operation Report
            </label>
        </h1>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Location</th>
                    <th>Road Length</th>
                    <th>Date of Clearing Operation</th>
                    <th>ActionTaken</th>
                    <th>Remarks</th>
                    <th>Total SK Official</th>
                    <th>No of Barangay Official</th>
                    <th>Total Personel</th>
                    <th>Image1</th>
                    <th>Image2</th>
                    <th>Image3</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)) {
                    foreach ($records as $record) {
                        echo "<tr>";
                        echo "<td>" . date("F", mktime(0, 0, 0, $record['Month'], 10)) . "</td>";
                        echo "<td>{$record['Location']}</td>";
                        echo "<td>{$record['RoadLength']}</td>";
                        echo "<td>{$record['DateofClearingOperation']}</td>";
                        echo "<td>{$record['ActionTaken']}</td>";
                        echo "<td>{$record['Remarks']}</td>";
                        echo "<td>{$record['TotalSKOfficial']}</td>";
                        echo "<td>{$record['NoofBO']}</td>";
                        echo "<td>{$record['TotalPersonel']}</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($record['Image1']) . "' alt='Image1' style='width:50px;height:50px;'></td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($record['Image2']) . "' alt='Image2' style='width:50px;height:50px;'></td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($record['Image3']) . "' alt='Image3' style='width:50px;height:50px;'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' class='no-records'>No records found.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('table');
            const headers = table.querySelectorAll('th');
            const rows = Array.from(table.querySelectorAll('tbody tr'));

            headers.forEach((header, index) => {
                header.addEventListener('click', () => {
                    const isAscending = header.classList.contains('asc');
                    const direction = isAscending ? -1 : 1;

                    rows.sort((rowA, rowB) => {
                        const cellA = rowA.children[index].textContent.trim();
                        const cellB = rowB.children[index].textContent.trim();

                        if (!isNaN(cellA) && !isNaN(cellB)) {
                            return direction * (parseFloat(cellA) - parseFloat(cellB));
                        }

                        return direction * cellA.localeCompare(cellB);
                    });

                    rows.forEach(row => table.querySelector('tbody').appendChild(row));

                    headers.forEach(h => h.classList.remove('asc', 'desc'));
                    header.classList.toggle('asc', !isAscending);
                    header.classList.toggle('desc', isAscending);
                });
            });
        });
    </script>
</body>
</html>
