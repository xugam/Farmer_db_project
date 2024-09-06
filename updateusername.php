<?php 
    require '.\connection.php';
    $new_username = $_POST['new-username'];
    $old_username = $_POST['old-username'];
    $query = "update users set username = '$new_username' where username = '$old_username'";

    $result = mysqli_query($conn,$query);

    header("Location:./index.php");

?>