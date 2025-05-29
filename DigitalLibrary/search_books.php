<?php
include('conn.php'); // Include your database connection

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Sanitize the input to prevent SQL injection
    $query = mysqli_real_escape_string($conn, $query);

    // Perform the search
    $sql = "SELECT * FROM card WHERE LOWER(name) LIKE LOWER('%$query%')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            
            echo "</div>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
}
?>
