<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Process the inputs (you can add your processing logic here)

    // For demonstration purposes, let's just echo the inputs
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password;
}
?>
