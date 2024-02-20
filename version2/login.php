<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform basic input validation
    if (empty($username) || empty($password)) {
        echo "Both username and password are required.";
        exit();
    }

    // Check if the username and password match the admin credentials
    if ($username === "admin" && $password === "admin123") {
        echo "Welcome, This is Admin!";
    } else {
        echo "Invalid Username or Password";
    }
} else {
    // If the request method is not POST, redirect back to the login form
    header("Location: index.html");
    exit();
}
?>
