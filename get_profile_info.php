<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

require_once "database.php";

$userId = $_SESSION["user_id"];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT username, email, password FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<p>Username: " . $row["username"] . "</p>";
    echo "<p>Email: " . $row["email"] . "</p>";
    echo "<p>Password: " . $row["password"] . "</p>";
} else {
    echo "Error retrieving user information.";
}

$stmt->close();
$conn->close();
?>
