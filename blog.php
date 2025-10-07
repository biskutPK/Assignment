<!-- Assignment 6 -->

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "blog_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST["title"]);
    $content = $conn->real_escape_string($_POST["content"]);

    if ($title && $content) {
        $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
        if ($conn->query($sql)) {
            $msg = "<p style='color:green;'>Post added successfully!</p>";
        } else {
            $msg = "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        $msg = "<p style='color:red;'>Both fields are required.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Add Post</title>
</head>
<body>
    <h2>Add New Blog Post</h2>
    <?php echo $msg; ?>
    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title"><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="5"></textarea><br><br>

        <button type="submit">Add Post</button>
    </form>

    <p><a href="view_blog.php">View Blog</a></p>
</body>
</html>
