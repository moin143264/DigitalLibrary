<?php 
include "conn.php";
$name=$_POST["name"];
$email=$_POST["email"];
$uname=$_POST["uname"];
$pass=$_POST["pass"];
$token=null;
$check="select * from last where email='$email';";
$check_u="select * from last where username='$uname';";

$hash = password_hash($pass, PASSWORD_BCRYPT);
$result=mysqli_query($conn,$check);
$result_u=mysqli_query($conn,$check_u);
if(mysqli_num_rows($result)>0){
    echo "Email Already Exist<br><br><a href='registerr.php' style='text-decoration:none;color:green'>Try With Different Email</a>";
}
elseif(mysqli_num_rows($result_u)>0){
    echo "Username Already Exist<br><br><a href='registerr.php' style='text-decoration:none;color:green'> Create Different Username!!!! click here</a>";
}

else{
    
$sql="insert into last values(null,'$name','$email','$uname','$hash','$token');";
if (mysqli_query($conn,$sql)) {
    header("location:Main.php");
} else {
    echo mysqli_connect_error($conn);
}

}


?>