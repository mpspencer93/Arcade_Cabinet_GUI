<!DOCTYPE HTML>
<html>
<?php include("./database/connect.php");   ?>
<?php include("./database/functions.php"); ?>
<?php if ($_SESSION["team_name"] != "admin") {header("Location: ./index.php");} ?> 
<head>
<style>
    body
    {
        background : gray;
    }
    .box
    {
        height      : 464px;
        width       : 400px;
        border      : 5px solid black;
        margin      : 25px;
        background  : white;
        position    : fixed; 
        top         : 50%;
        left        : 50%;
        margin-top  : -214px;
        margin-left : -200px;
    }
    .logo
    {
        padding    : 10px;
        width      : 50%;
        text-align : right;
    }
    .team_name
    {
        padding    : 10px;
        width      : 50%;
        text-align : left;
    }
    .login
    {
        text-align : center;
    }
    .row
    {
        display  : flex;
    }
    .form_row
    {
        display : flex;
        padding : 3px;
    }
    .sign_out
    {
        font-size   : 10px;
        padding     : 5px;
        margin-left : -10px;
        width       : 100%;
        text-align  : right;
    }
    .tabs
    {
        width      : 100%;
        text-align : center;
    }
    .game_form
    {
        padding : 15px;
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
<body>
    <div class="box">
        <div class="sign_out">
            <a href="./sign_out.php ">Sign-Out</a>
        </div>
        <div class="row">
            <div class="logo">
                <img src="./Images/logo.png" style="height:75px; width:75px;">
            </div>
            <div class="team_name">
                <h3>
                    <u><b>ADMIN</b></u>
                </h3>
            </div>
        </div>
        <hr>
        <div class="tabs">
            <a href="./admin_page.php">Create Team</a> &nbsp <a href="./admin_page_edit.php">Edit Team</a> &nbsp <a href="./admin_page_delete.php">Delete Game</a>
        </div>
        <hr>
        <div class="login">
            <form action="/admin_page.php " method="post" enctype="multipart/form-data" class="game_form" id="team_form">
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">Team Name</div><div>:</div>&nbsp<input type="text" minlength="1" maxlength="33" name="teamName" style="text-align:left; right:4px; width:230px" required><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">Team Number</div><div>:</div>&nbsp<input type="text" minlength="1" maxlength="4" name="teamNumber" style="text-align:left; right:4px; width:230px" required><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">Team Password</div><div>:</div>&nbsp<input type="password" minlength="1" maxlength="33" name="teamPass" style="text-align:left; right:4px; width:230px" required><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">Confirm Pass</div><div>:</div>&nbsp<input type="password" minlength="1" maxlength="33" name="confirmPass" style="text-align:left; right:4px; width:230px"required><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">Team Year</div><div>:</div>&nbsp<input type="text" minlength="1" maxlength="33" name="teamYear" style="text-align:left; right:4px; width:230px" required><br>
                </div>
                <br>
                <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        // Check if all fields have been filled out.
                        if ($_POST["teamPass"] != $_POST["confirmPass"])
                        {
                            echo "Error: Passwords Do Not Match!";
                            exit();
                        }
                    
                        // Update team game path info in database.
                        $sql    = "INSERT INTO teams (team_name, team_number, year, submitted, password, file_path, game_name)
                                   VALUES ('".$_POST["teamName"]."','".$_POST["teamNumber"]."','".$_POST["teamYear"]."','0','".$_POST["teamPass"]."','','');";
                        if (!($conn->query($sql) === TRUE)) 
                        {
                            echo "FAILED TO INSERT TEAM INTO DATABASE!";
                            exit();
                        }
                        else
                        {
                            echo "<div style='color:green;'>Team Successfully Created!</div><br>";
                        }
                    }
                ?>
                <div class="button">
                    <input type="submit" value="Create Team" style="border: 1px solid gray;">
                </div>
                <br><br>
            </form>
           
        </div>
    </div>    
</body>
</html> 