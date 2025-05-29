<?php 
include "conn.php";

$id=$_GET["id"];

$sql="delete from last where id='$id'
;";

if(
    mysqli_query($conn,$sql)){
    echo header("location:userm.php");

}
 else {
    echo "Something Went Wrong".mysqli_error($conn);
    
}

mysqli_close($conn);
?>