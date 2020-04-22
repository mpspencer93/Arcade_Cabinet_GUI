<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database   = "husky_arcade";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Create database
    $sql = "CREATE DATABASE ".$database.";";
    if ($conn->query($sql) === TRUE) 
    {
        echo "Database created successfully\n";
    } 
    else 
    {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();

    // Create connection.
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection.
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    

    // sql to create table
    $sql = "CREATE TABLE teams (
    team_name   VARCHAR(1000),
    team_number VARCHAR(1000),
    year        VARCHAR(1000),
    submitted   INT(255),
    password    VARCHAR(1000),
    game_name   VARCHAR(1000),
    file_path   VARCHAR(1000)
    );";

    if ($conn->query($sql) === TRUE) 
    {
        echo "Table 'teams' created successfully\n";
    } 
    else 
    {
        echo "Error creating table: " . $conn->error;
    }
    
    $sql = "INSERT INTO teams (team_name, password)
    VALUES ('admin', 'HGDpass')";

    if ($conn->query($sql) === TRUE) 
    {
        echo "Admin created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>

