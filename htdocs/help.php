<!DOCTYPE HTML>
<html>
<?php include("./database/connect.php");   ?>
<?php include("./database/functions.php"); ?>
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
        overflow-y  : scroll;
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
        text-align : left;
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
                    <u><b>HELP</b></u>
                </h3>
            </div>
        </div>
        <hr>
        <div class="tabs">
            <a href="./team_page.php">Go Back</a> 
        </div>
        <hr>
        <div class="login">
                <div class="form_row" style="padding:7px;">
                    <div> 1. </div>&nbsp <div>Input the name of your game. This text field will be used as your game's display name on the cabinet. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 2. </div>&nbsp <div>Go to where your game execuatable resides on your computer. Zip up the .exe and all surrounding necessary files/folders to run your game. NOTE: The name of your .zip file is not important. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 3. </div>&nbsp <div>Next, select your game logo. It must be, at max, a 255x255 .png file to show up correctly on the cabinet. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 4. </div>&nbsp <div>Select the modified controlls .png file for your game. This control layout is provided for you on Canvas. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 5. </div>&nbsp <div>Fill in each corresponding text box with a short description of your game and credits. The formatting is kept when displaying on the cabinet, and the max character length for each is 500. NOTE: You may want to type these in a seperate text editor to copy/paste if an error occurs. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 6. </div>&nbsp <div>Press the "Upload Game" button and wait for the confirmation screen. Do not close out of the browser. NOTE: The larger the game is, the longer this will take. The max size of the zip file is set at 4 Gigs. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 7. </div>&nbsp <div>The "uploaded" text field below your name should now be green, and a "delete game" button will appear where the form used to be. You must delete your game before re-uploading again. Logging in again will now take you here. </div><br>
                </div>
                <div class="form_row" style="padding:7px;">
                    <div> 8. </div>&nbsp <div>Make sure you restart the arcade cabinet and check if everything was uploaded properly. </div><br>
                </div>
                <br>
            </form>
           
        </div>
    </div>    
</body>
</html> 