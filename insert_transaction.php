<?php
    $hostname = "localhost";
    $db_username = "root";
    $db_password = "sugam@123";
    $db_name = "farmer_profiles";

    $conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

    // $p_id = $_GET['p_id'];
    $email = $_GET['email'];
    $inflow = $_GET['inflow'];
    $expenditure = $_GET['expenditure'];
    // $remaining_blc = $prev_blc + $inflow - $expenditure;
    $remaining_blc = $_GET['balance'];

    $query = "INSERT INTO transactions(email,inflow,expenditure,remaining_blc,created_at) values('$email','$inflow','$expenditure','$remaining_blc',now());";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("database error");
    }
   header("Location:/index.php");
?>