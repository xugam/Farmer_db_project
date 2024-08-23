<?php
   // $hostname = "localhost";
    // $db_username = "root";
    // $db_password = "sugam@123";
    // $db_name = "farmer_profiles";
    $hostname = "sql110.infinityfree.com";
    $db_username = "if0_37166812";
    $db_password = "MKTbguBxFc5wf";
    $db_name = "if0_37166812_farmer_profiles";

    $conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

    //for prev balance
    
    $phone_number = $_GET['phone'];
    $inflow = $_GET['inflow'];
    $expenditure = $_GET['expenditure'];



    $prev_query = "SELECT * from transactions where phone_number = '$phone_number'";
    echo $prev_query;
    $result = mysqli_query($conn,$prev_query);
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($rows as $data){
        if($data['remaining_blc'])
            $prev_blc = $data['remaining_blc'];
        else
        $prev_blc = 0;
    }

     $remaining_blc = $prev_blc + $inflow - $expenditure;

    
    

    $query = "INSERT INTO transactions(phone_number,inflow,expenditure,remaining_blc,created_at) values('$phone_number','$inflow','$expenditure','$remaining_blc',now());";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("database error");
    }
   header("Location:/index.php");
?>