<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product_db";

// Create connection to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Close the initial connection
    $conn->close();
    
    // Create a new connection to the specific database
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Create table if not exists (don't drop existing table)
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        buying_price DECIMAL(10,2) NOT NULL,
        selling_price DECIMAL(10,2) NOT NULL,
        profit DECIMAL(10,2) NOT NULL,
        display ENUM('Yes', 'No') DEFAULT 'Yes'
    )";
    
    if (!$conn->query($sql)) {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Error creating database: " . $conn->error;
}
?> 