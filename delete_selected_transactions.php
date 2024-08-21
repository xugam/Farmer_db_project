<?php
    $hostname = "localhost";
    $db_username = "root";
    $db_password = "sugam@123";
    $db_name = "farmer_profiles";

    $conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['select'])) {
            $selected_values = $_POST['select']; 
            foreach ($selected_values as $value) {
                $query = "DELETE FROM transactions WHERE t_id = ".$value;
                echo $query;
                mysqli_query($conn,$query);
          
            }
        } else {
            echo "No checkboxes were selected.";
        }
    }
    header("Location:./index.php");
    
?>