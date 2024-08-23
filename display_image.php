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
