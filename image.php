<?php
// $hostname = "localhost";
    // $db_username = "root";
    // $db_password = "sugam@123";
    // $db_name = "farmer_profiles";
    $hostname = "sql110.infinityfree.com";
    $db_username = "if0_37166812";
    $db_password = "MKTbguBxFc5wf";
    $db_name = "if0_37166812_farmer_profiles";

// Create connection
$conn = new mysqli($hostname, $username, $db_password, $db_name);

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
