<?php 
include "conn.php";

$id=$_GET["id"];

$sql="delete from feedback where id='$id'
;";

if(
    mysqli_query($conn,$sql)){
    echo header("location:feedback_mana.php");

}
 else {
    echo "Something Went Wrong".mysqli_error($conn);
    
}

mysqli_close($conn);
?>