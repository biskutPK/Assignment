<?php
$uploadOk = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir); // create folder if not exists
        }

        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file size (max 2MB)
        if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
            $error = "File too large. Max 2MB allowed.";
        }
        // Allow only JPG, PNG, GIF
        elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $error = "Only JPG, PNG, and GIF files are allowed.";
        }
        else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $uploadOk = true;
            } else {
                $error = "Error uploading file.";
            }
        }
    } else {
        $error = "No file selected.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
</head>
<body>
    <h2>Upload an Image</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <button type="submit">Upload</button>
    </form>

    <?php if ($uploadOk): ?>
        <h3>Uploaded Image:</h3>
        <img src="<?php echo $targetFile; ?>" width="300">
    <?php elseif ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
