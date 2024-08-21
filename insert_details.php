<?php
    $hostname = "localhost";
    $db_username = "root";
    $db_password = "sugam@123";
    $db_name = "farmer_profiles";

    $conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

    $name=$_GET['name'];
    //  $document=$_GET['document'];
    // $document_name = $_FILES['document']['name'];
    $document_name = $_GET['document'];
    //  $document = addslashes(file_get_contents($_FILES['document']['tmp_name']));

    $phone_number=$_GET['phone'];
    $email=$_GET['email'];
    $state=$_GET['state'];
    $district=$_GET['district'];
    $city = $_GET['city'];

    $query1 = "INSERT INTO profile(name,document_name) values('$name','$document_name');";
    $query = "INSERT INTO contact_info(phone_number,email,state,district,city) values('$phone_number','$email','$state','$district','$city');";
    $result = mysqli_query($conn,$query1);
    $result1 = mysqli_query($conn,$query);
    if(!$result){
        die("database error");
    }
    if(!$result1){
        die("database error");

    }
    header("Location:./index.php");

?>