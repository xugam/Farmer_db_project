<?php
    $hostname = "localhost";
    $db_username = "root";
    $db_password = "sugam@123";
    $db_name = "farmer_profiles";

    $conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['select']) && !empty($_POST['select'])) {
            $selected_values = $_POST['select']; 
            foreach ($selected_values as $value) {
                $query = "DELETE FROM contact_info WHERE id = ".$value;
                $query1 = "DELETE FROM profile WHERE id = ".$value;
                echo $query;
                echo $query1;
                mysqli_query($conn,$query);
                mysqli_query($conn,$query1);
            }
        } else {
            echo "No checkboxes were selected.";
        }
    }
    // echo $arr;
    
?>