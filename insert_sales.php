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

    $sales_item = $_POST['sales_item'];
    $unit = $_POST['unit'];
    $rate = $_POST['rate'];
    $quantity = $_POST['quantity'];
    $amount = $rate * $quantity;
    $phone_number = $_POST['phone_number'];



    $query = "INSERT INTO sales(date, sales_item, unit, rate, quantity, amount, phone_number) 
                values(now(),'$sales_item','$unit','$rate','$quantity','$amount','$phone_number');";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("database error");
    }
    header("Location:/index.php");
?>