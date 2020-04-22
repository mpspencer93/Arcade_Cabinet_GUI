<!DOCTYPE HTML>
<html>
<?php include("./database/connect.php"); ?>
<?php if ($_SESSION["team_name"] != "admin") {header("Location: ./index.php");} ?> 
<head>
<style>
    body
    {
        background : gray;
    }
    .box
    {
        height      : 438px;
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
            <form action="/admin_page_edit2.php " method="post" enctype="multipart/form-data" class="game_form" id="team_form">
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">New Password</div><div>:</div>&nbsp<input type="password" minlength="1" maxlength="33" name="teamPass" style="text-align:left; right:4px; width:230px" required><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div style="width:32%;">Confirm Pass</div><div>:</div>&nbsp<input type="password" minlength="1" maxlength="33" name="confirmPass" style="text-align:left; right:4px; width:230px"required><br>
                </div>
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            // Check if all fields have been filled out.
                            if ($_POST["teamPass"] != $_POST["confirmPass"])
                            {
                                echo "Error: Passwords Do Not Match!";
                                exit();
                            }
                            
                            // Update team game name path info in database.
                            $sql    = "UPDATE teams SET password = '".$_POST["teamPass"]."' WHERE team_name = '".$_SESSION["editTeamName"]."';";
                            if (!($conn->query($sql) === TRUE)) 
                            {
                                echo "FAILED TO UPDATE TEAM IN DATABASE!";
                                exit();
                            }
                            else
                            {
                                echo "<br><div style='color:green;'>Successfully Updated Team Password!</div>";
                            }
                        }
                    ?>
                <br><br>
                <div class="button">
                    <input type="submit" value="Edit" style="border: 1px solid gray;">
                </div>
                <br><br>
            </form>
        <div>
    </div>
</body>
</html> 