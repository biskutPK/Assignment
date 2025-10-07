<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validation
    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        echo "<h3>✅ Form Submitted Successfully!</h3>";
        echo "<p><b>Name:</b> $name</p>";
        echo "<p><b>Email:</b> $email</p>";
        echo "<p><b>Message:</b> $message</p>";
    } else {
        echo "<h3>❌ Please fill all fields correctly.</h3>";
    }
}
?>

<!-- Contact Form -->
<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Message:</label><br>
    <textarea name="message" required></textarea><br><br>

    <input type="submit" value="Send">
</form>
