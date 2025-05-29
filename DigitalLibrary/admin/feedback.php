<?php 
include "conn.php";
$user_id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$rating=$_POST["rating"];
$ui_rating=$_POST["ui_rating"];
$functionality_rating=$_POST["functionality_rating"];
$performance_rating=$_POST["performance_rating"];
$comments=$_POST["comments"];
if (isset($_POST["feedback"])) {
$sql="insert into feedback values(null,'$user_id','$name','$email','$rating','$ui_rating','$functionality_rating','$performance_rating','$comments');";
if (empty($email) || empty($rating) || empty($ui_rating) || empty($functionality_rating) || empty($performance_rating) || empty($comments)) {
  echo "All fields are required. <a href='feedbac.php'>Give feedback here</a>";
} else {
  if (mysqli_query($conn,$sql)) {
    header('location:../Main.php');
} else {
    echo "failed to give feedback";
}
}
} else {
  echo "failed to update <a href='feedbac.php'></a>";
}



?>