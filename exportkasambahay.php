<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "dbibim";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=kasambahay_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

$queryKasambahay = "SELECT * FROM tblkasambahay";
$kasambahayResult = $conn->query($queryKasambahay);

echo "Name\tSex\tAge\tCivil Status\tPurok\tEducation\tStatus\tWork Type\tSalary\n";

while ($row = $kasambahayResult->fetch_assoc()) {
    echo $row['KasambahayName'] . "\t" . $row['Sex'] . "\t" . $row['Age'] . "\t" . $row['CivilStatus'] . "\t" . $row['Purok'] . "\t" . $row['EducationalAttainment'] . "\t" . $row['Status'] . "\t" . $row['NatureOfWork'] . "\t" . $row['Salary'] . "\n";
}

$conn->close();
?>
