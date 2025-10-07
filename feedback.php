<!-- Assignment 5 -->


<?php
// Database connection (edit values as per your setup)
$servername = "localhost";
$username = "root";    // default XAMPP/WAMP user
$password = "";        // default empty in local
$dbname = "feedback_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $feedback = $conn->real_escape_string($_POST["message"]);

    if ($name && $email && $feedback) {
        $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$feedback')";
        if ($conn->query($sql)) {
            $message = "<p style='color:green;'>Thank you for your feedback!</p>";
        } else {
            $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>All fields are required.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback System</title>
</head>
<body>
    <h2>Submit Feedback</h2>

    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Feedback:</label><br>
        <textarea name="message"></textarea><br><br>

        <button type="submit">Submit</button>
    </form>

    <?php echo $message; ?>

    <hr>
    <h2>All Feedback</h2>
    <?php
    $result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($row['name']) . "</strong> (" . htmlspecialchars($row['email']) . ")<br>";
            echo htmlspecialchars($row['message']) . "<br><em>" . $row['submitted_at'] . "</em></p><hr>";
        }
    } else {
        echo "<p>No feedback yet.</p>";
    }
    ?>
</body>
</html>
