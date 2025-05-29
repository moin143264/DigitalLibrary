<?php 
session_start(); // Start the session at the beginning

include "conn.php";

$id = $_GET["id"];

// Check if the session is active and if the ID exists in the session (or is relevant to the session)


    $sql = "DELETE FROM last WHERE id='$id';";

    if (mysqli_query($conn, $sql)) {
        session_destroy();  // Destroy the session after deleting the record
        header("location:../index.php");
        exit();  // Stop further execution
    } else {
        echo "Something went wrong: " . mysqli_error($conn);
    }



mysqli_close($conn);
?>
