<!-- Assignment 4 -->

<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hardcoded username & password
    $valid_user = "admin";
    $valid_pass = "12345";

    if ($username === $valid_user && $password === $valid_pass) {
        $message = "<p style='color:green;'>Login Successful</p>";
    } else {
        $message = "<p style='color:red;'>Try Again</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <h2>Login</h2>

    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>

    <?php echo $message; ?>
</body>
</html>
