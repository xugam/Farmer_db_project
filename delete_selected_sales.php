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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['select'])) {
            $selected_values = $_POST['select']; 
            foreach ($selected_values as $value) {
                $query = "DELETE FROM sales WHERE id = $value";
                mysqli_query($conn,$query);
            }
        } else {
            echo "No checkboxes were selected.";
        }
    }
    header("Location:./index.php");
    
?>