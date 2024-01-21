<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.html");
        exit();
    }

    $userId = $_SESSION["user_id"];
    $newEmail = $_POST["newEmail"];
    $newPassword = $_POST["newPassword"];

    require_once "database.php";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newEmail, $newPassword, $userId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

}
?>
