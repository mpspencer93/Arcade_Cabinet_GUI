<!DOCTYPE HTML>
<html>
<?php include("./database/connect.php");?>
<head>
<style>
    body
    {
        background : gray;
    }
    .box
    {
        height      : 408px;
        width       : 300px;
        border      : 5px solid black;
        margin      : 25px;
        background  : white;
        position    : fixed; 
        top         : 50%;
        left        : 50%;
        margin-top  : -189px;
        margin-left : -150px;
    }
    .logo
    {
        padding    : 15px;
        text-align : center;
    }
    .login
    {
        text-align : center
    }
    input[type=submit]
    {
        background-color    : yellow;
        border              : 1px black;
        transition-duration : 0.2s;
        width               : 25%;
        padding             : 5px;
        cursor              : pointer;
    }
    input[type=submit]:hover
    {
        background-color : green;
        color            : white;
        cursor           : pointer;
    }
</style>
</head>
<?php
    // Initialize variables.
    $_SESSION["team_name"] = "";     // Store the team name for future use.
    $_SESSION["vaildate"]  = FALSE;  // Boolean used to validate user on subsequent pages.    
    $password              = "";     // Only store password temporarily.

    // Check to see if username and password are valid.
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Get user's credentials from the form.
        $_SESSION["team_name"] = strip_input($_POST["teamName"]);
        $password              = strip_input($_POST["password"]);
        // Check the database.
        $sql    = "SELECT * FROM teams WHERE team_name = '".$_SESSION["team_name"]."' AND password = '".$password."';";
        $result = $conn->query($sql);
        $row    = $result->fetch_assoc();
        if (($result->num_rows) > 0)
        {
            // Set global variables for redirect or refresh.
            $_SESSION["validate"]  = TRUE;
            $_SESSION["error_msg"] = FALSE;
            
            // Decide where to redirect depending if admin.
            if ($_SESSION["team_name"] == "admin")
            {
                header("Location: ./admin_page.php");
            }
            else
            {
                $_SESSION["team_year"]   = $row["year"];
                $_SESSION["team_number"] = $row["team_number"];
                $_SESSION["submitted"]   = $row["submitted"]; 
                header("Location: ./team_page.php");
            }
        }
        else
        {
            $_SESSION["validate"]  = FALSE;
            $_SESSION["error_msg"] = TRUE; 
            header("Location: ./index.php");
        }
    }
?>
<body>
    <div class="box">
        <div class="logo">
            <img src="./Images/logo.png">
            <h2>
                <u><b>HUSKY ARCADE</b></u>
            </h2>
        </div>
        <div class="login">
            <form action="/index.php" method="post"">
                Team Name:&nbsp <input type="text" name="teamName" style="right:4px;" minlength="1"><br>
                Password:&nbsp&nbsp&nbsp &nbsp <input type="password" name="password" style="right:4px;" minlength="1"><br>
                <br>
                <div class="button">
                    <input type="submit" value="Submit" style="border: 1px solid gray;">
                </div>
                <?php 
                    // Check to see if user's creditials were rejected, if true throw error msg.
                    if ($_SESSION["error_msg"] === TRUE)
                    {
                        echo "<font color='red' size='1'><b><u> Invalid Team Name or Password. </u></b></font>";
                    }
                ?>
                <br>
            </form> 
        <div>
    </div>
</body>
</html>