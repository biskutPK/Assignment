<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "blog_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Blog</title>
</head>
<body>
    <h1>My Blog</h1>
    <p><a href="admin.php">Admin Panel</a></p>
    <hr>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            <em>Posted on <?php echo $row['created_at']; ?></em>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No posts yet.</p>
    <?php endif; ?>
</body>
</html>
