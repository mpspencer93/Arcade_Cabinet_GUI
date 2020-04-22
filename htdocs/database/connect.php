<?php
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "husky_arcade";

    // Create connection.
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection.
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // Start Session to access global session variables.
    session_start();
    
    // Initialize Global Session Variables
    if (empty($_SESSION["error_msg"]))
    {
        $_SESSION["error_msg"] = FALSE;
    }        
    if (empty($_SESSION["validate"]))
    {
        $_SESSION["validate"] = FALSE;
    }
    
    // Function takes form input data and strips it of unwanted characters.
    // Used to make sure malicious code isn't run on the database.
    function strip_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>