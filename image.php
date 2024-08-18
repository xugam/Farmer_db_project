<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = "sugam@123"; // Your database password
$dbname = "farmer_profiles"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $imageName = $_FILES['image']['name'];
    $imageData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    
    $sql = "INSERT INTO profile (name,document_name, document) VALUES ('test','$imageName', '$imageData')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded and stored successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit" name="submit">Upload</button>
       
    </form>
    <img src="display_image.php?id=1" alt="Image from database">
</body>
</html>
