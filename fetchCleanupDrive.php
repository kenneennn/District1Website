<?php
require_once 'db_connection.php';

try {
    $queryCleanupDrive = "SELECT * FROM tblcleanupdrive";
    $stmtCleanupDrive = $pdo->query($queryCleanupDrive);
    $cleanupDrives = $stmtCleanupDrive->fetchAll(PDO::FETCH_ASSOC) ?? [];
} catch (PDOException $e) {
    $cleanupDrives = [];
    error_log("Query error: " . $e->getMessage());
}

if (isset($_GET['CleanupDriveID'])) {
    try {
        $cleanupDriveID = $_GET['CleanupDriveID'];
        $query = "SELECT * FROM tblcleanupdrive WHERE CleanupDriveID = :cleanupDriveID";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['cleanupDriveID' => $cleanupDriveID]);
        $drive = $stmt->fetch(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($drive);
    } catch (PDOException $e) {
        error_log("Query error: " . $e->getMessage());
        echo json_encode(['error' => 'Failed to fetch data.']);
    }
}
?>
