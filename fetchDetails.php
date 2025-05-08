<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['month'])) {
    $month = intval($_POST['month']); 
    $query = "SELECT * FROM tblbarco WHERE MONTH(DateofClearingOperation) = ? AND YEAR(DateofClearingOperation) = YEAR(CURDATE())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $month);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table style='width: 100%;'>";
        echo "<tr>
                <th>Conducted RCo</th>
                <th>Month</th>
                <th>Location</th>
                <th>Road Length</th>
                <th>Date of Clearing</th>
                <th>Action Taken</th>
                <th>Remarks</th>
                <th>Total SK Official</th>
                <th>No. of BO</th>
                <th>Total Personnel</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ConductedRCo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Month']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
            echo "<td>" . htmlspecialchars($row['RoadLength']) . "</td>";
            echo "<td>" . htmlspecialchars($row['DateofClearingOperation']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ActionTaken']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Remarks']) . "</td>";
            echo "<td>" . htmlspecialchars($row['TotalSKOfficial']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NoofBO']) . "</td>";
            echo "<td>" . htmlspecialchars($row['TotalPersonel']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found for this month.</p>";
    }
}
$conn->close();
?>
