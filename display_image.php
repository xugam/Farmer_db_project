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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "SELECT document, document_name FROM profile WHERE id = 2";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageData = $row['document'];
        $imageName = $row['document_name'];
        
        // Determine the MIME type based on the image's extension
        $mimeType = mime_content_type($imageName);
        
        // Send the correct headers
        header("Content-Type: $mimeType");
        
        // Output the image
        echo $imageData;
    } else {
        echo "Image not found.";
    }
} else {
    echo "No image ID specified.";
}

$conn->close();
?>
