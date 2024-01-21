<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="settings.html">Settings</a></li>
            </ul>
        </div>
        <div class="content">
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
                echo "<div class='profile-container'>";
                echo "<h2>Profile</h2>";
                echo "<p><strong>Username:</strong> " . $row["username"] . "</p>";
                echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p><strong>Password:</strong> " . $row["password"] . "</p>";
                echo "</div>";
            } else {
                echo "Error retrieving user information.";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
    <script src="assets/script/script.js"></script>
</body>
</html>
