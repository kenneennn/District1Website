<?php
header('Content-Type: application/json');
include 'db_connection.php';

function decryptPassword($encryptedPassword, $shift) {
    $decrypted = '';
    $shift = 26 - $shift; // Reverse the shift
    for ($i = 0; $i < strlen($encryptedPassword); $i++) {
        $char = $encryptedPassword[$i];
        if (ctype_alpha($char)) {
            $base = ctype_upper($char) ? 'A' : 'a';
            $decrypted .= chr((ord($char) - ord($base) + $shift) % 26 + ord($base));
        } else {
            $decrypted .= $char; // Keep non-alphabet characters as they are
        }
    }
    return $decrypted;
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON input']);
    exit;
}

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$response = [];

if (!empty($username) && !empty($password)) {
    $query = "SELECT password, AccountType FROM tbluser WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($encryptedPassword, $accountType);
        $stmt->fetch();

        $decryptedPassword = decryptPassword($encryptedPassword, 5); // Decrypt the stored password

        if ($decryptedPassword === $password) {
            $response['success'] = true;
            $response['accountType'] = $accountType;
        } else {
            $response['success'] = false;
        }
    } else {
        $response['success'] = false; // No user found
    }
    $stmt->close();
} else {
    $response['success'] = false; // Missing inputs
}

echo json_encode($response);
$conn->close();
