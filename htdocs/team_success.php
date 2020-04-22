<!DOCTYPE HTML>
<html>
<?php include("./database/connect.php"); ?>
<head>
<style>
    body
    {
        background : gray;
    }
    .box
    {
        height      : 418px;
        width       : 400px;
        border      : 5px solid black;
        margin      : 25px;
        background  : white;
        position    : fixed; 
        top         : 50%;
        left        : 50%;
        margin-top  : -204px;
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
        display  : flex;
        padding  : 3px;
    }
    .sign_out
    {
        font-size   : 10px;
        padding     : 5px;
        margin-left : -10px;
        width       : 100%;
        text-align  : right;
    }
    .team_info
    {
        width       : 100%;
        margin-left : 100px;
        text-align  : left;
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
            <a href="./sign_out.php">Sign-Out</a> &nbsp <a href="./index.php">Help</a> &nbsp
        </div>
        <div class="row">
            <div class="logo">
                <img src="./Images/logo.png" style="height:75px; width:75px;">
            </div>
            <div class="team_name">
                <h3>
                    <u><b>TEAM 11</b></u>
                </h3>
            </div>
        </div>
        <hr>
        <div class="team_info">
            <ul style="list-style-type:none;">
                <li>Year      : 2020</li>
                <li>Name      : Arcade Fire</li>
                <li>Submitted : <span style="background-color:#00ff00;">Yes</span></li>
            </ul>
        </div>
        <hr>
        <div class="login"> 
           <br>
           Game uploaded Successfully!<br>
           Click the link below to delete submission.
           <br><br>
           <a href="./index.php">Delete Game</a>
        <div>
    </div>
</body>
</html>