<?php 
    require '.\connection.php';
    $new_password = $_POST['new-password'];
    $old_password = $_POST['old-password'];
    $query = "update users set password = '$new_password' where password = '$old_password'";

    $result = mysqli_query($conn,$query);
    if($result){
        echo "Wrong password";
    }
    header("Location:./index.php");

?>