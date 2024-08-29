<?php
$hostname = "localhost";
$db_username = "root";
$db_password = "aayush";
$db_name = "farmer_profiles";
// $hostname = "sql110.infinityfree.com";
// $db_username = "if0_37166812";
// $db_password = "MKTbguBxFc5wf";
// $db_name = "if0_37166812_farmer_profiles";

$conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

$name = $_POST['name'];

$phone_number = $_POST['phone'];
$email = $_POST['email'];
$state = $_POST['state'];
$district = $_POST['district'];
$city = $_POST['city'];


//start
$target_dir = "uploads/";  // Directory where you want to save the images
$file_name = basename($_FILES["document"]["name"]);
$target_file = $target_dir.$file_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a real image or fake image
$check = getimagesize($_FILES["document"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size (5MB limit)
if ($_FILES["document"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // If everything is ok, try to upload the file
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
      $query1 = "INSERT INTO profile(name,document_name,document_path) values('$name','$file_name','$target_file');";
      $query = "INSERT INTO contact_info(phone_number,email,state,district,city) values('$phone_number','$email','$state','$district','$city');";
      $result = mysqli_query($conn,$query1);
      $result1 = mysqli_query($conn,$query);
    
    }
}
//end


if(!$result){
    die("database error");
}
if(!$result1){
    die("database error");
}
header("Location:./index.php");
