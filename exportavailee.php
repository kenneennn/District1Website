<?php
include 'db_connection.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=availee_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

$queryAvailee = "SELECT Lastname, Firstname, Middlename, Age, DateOfBirth, Sex, EducationalLevel, Course, OSY FROM tblavailee";
$availeeResult = $conn->query($queryAvailee);

echo "Full Name\tAge\tDate of Birth\tSex\tEducational Level\tCourse\tOSY\n";

while ($row = $availeeResult->fetch_assoc()) {
    $fullName = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'];
    echo $fullName . "\t" . $row['Age'] . "\t" . $row['DateOfBirth'] . "\t" . $row['Sex'] . "\t" . $row['EducationalLevel'] . "\t" . $row['Course'] . "\t" . $row['OSY'] . "\n";
}

$conn->close();
?>
