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
            <form action="/admin_page_delete.php " method="post" enctype="multipart/form-data" class="game_form" id="team_form">
                <select id="teamName" name="gameName">
                    <option value=""> Select a Game </option>
                    <?php
                        // SQL statement.
                        $sql    = "SELECT * FROM teams;";
                        $result = $conn->query($sql);
                        
                        // Iterate through database.
                        while ($row = mysqli_fetch_array($result))
                        {
                            $gameName = $row["game_name"];
                            if ($gameName != "")
                            {
                                echo "<option value='".$gameName."'>".$gameName."</option>";
                            }
                        }
                        
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            // Delete Game.
                            $sql    = "SELECT * FROM teams WHERE game_name = '".$_POST["gameName"]."';";
                            $result = $conn->query($sql);
                            $row    = $result->fetch_assoc();
                            if (($result->num_rows) > 0)
                            {
                                $file_path = $row["file_path"];
                                if (is_dir($file_path))
                                {
                                    Delete_Directory($file_path); 
                                }
                                else
                                {
                                    echo "PATH DOES NOT EXIST!";
                                    exit();
                                }
                            }
                            else
                            {
                                echo "UNABLE TO ACCESS DATABASE!";
                                exit();
                            }

                            // Update team game path info in database.
                            $sql    = "UPDATE teams SET file_path = ' ' WHERE team_name = '".$row["team_name"]."';";
                            $result = $conn->query($sql);
                            if (!($conn->query($sql) === TRUE)) 
                            {
                                echo "FAILED TO UPDATE FILE PATH IN DATABASE!";
                                exit();
                            }
                            
                            // Update team game path info in database.
                            $sql    = "UPDATE teams SET game_name = ' ' WHERE team_name = '".$row["team_name"]."';";
                            $result = $conn->query($sql);
                            if (!($conn->query($sql) === TRUE)) 
                            {
                                echo "FAILED TO UPDATE GAME NAME IN DATABASE!";
                                exit();
                            }
                            
                            // Update team submission info in database.
                            $sql    = "UPDATE teams SET submitted = '0' WHERE team_name = '".$row["team_name"]."';";
                            $result = $conn->query($sql);
                            if (!($conn->query($sql) === TRUE)) 
                            {
                                echo "FAILED TO UPDATE DATABASE!";
                                exit();
                            }
                                
                            echo "<div style='color:green;'>Successfully deleted game!</div>";
                            //header("Location: ./admin_page_delete.php");
                        }
                    ?>
                </select>
                <br><br>
                <div class="button">
                    <input type="submit" value="Delete" style="border: 1px solid gray;">
                </div>
                <br><br>
            </form>
        <div>
    </div>
</body>
</html> 