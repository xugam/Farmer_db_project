<?php require 'connection.php';

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