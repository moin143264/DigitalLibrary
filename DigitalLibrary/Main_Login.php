
<?php
session_start();
include "conn.php";

// Sanitize and validate input
$uname = mysqli_real_escape_string($conn, $_POST['uname']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

// Check for empty username or password
if (empty($uname) || empty($pass)) {
    header("Location: Main_Login.html");
    exit();
}

// Prepare SQL query
$sql = "SELECT * FROM last WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uname);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Check if the password is hashed (you can check for certain criteria like length or prefix)
    if (password_needs_rehash($row["password"], PASSWORD_DEFAULT) || password_verify($pass, $row["password"])) {
        // Password is hashed and verified
        $_SESSION["loggedin"] = true;
        $_SESSION["user_id"] = $row["id"]; // Store user ID in session
        
        header("Location: Main.php");
        exit();
    } elseif ($row["password"] === $pass) {
        // Password is plain text and matches
        $_SESSION["loggedin"] = true;
        $_SESSION["user_id"] = $row["id"]; 
        header("Location: Main.php");
        exit();
    } else {
        // Password does not match
        header("Location: invalid.php");
        exit();
    }
} else {
    // User does not exist
    header("Location: invalid.php");
    exit();
}

$stmt->close();
$conn->close();
?>