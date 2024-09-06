<?php require 'connection.php';

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