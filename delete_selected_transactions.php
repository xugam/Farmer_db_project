<?php require 'connection.php';

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