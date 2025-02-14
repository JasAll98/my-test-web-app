<?php
include 'connection.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = "DELETE FROM person_table WHERE person_id=$id;";

    $query = mysqli_query($conn, $delete);
    
    if ($query){
        header('location:dashboard.php');
    } else {
        die(mysqli_error($conn));
    }
}





?>