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
        height      : 538px;
        width       : 400px;
        border      : 5px solid black;
        margin      : 25px;
        background  : white;
        position    : fixed; 
        top         : 50%;
        left        : 50%;
        margin-top  : -264px;
        margin-left : -200px;
        overflow-y  : scroll;
        overflow-x  : hidden;
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
        display : flex;
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
            <a href="./sign_out.php ">Sign-Out</a> &nbsp <a href="./help.php ">Help</a> &nbsp
        </div>
        <div class="row">
            <div class="logo">
                <img src="./Images/logo.png" style="height:75px; width:75px;">
            </div>
            <div class="team_name">
                <h3>
                    <u><b>Team <?php echo $_SESSION["team_number"]; ?></b></u>
                </h3>
            </div>
        </div>
        <hr>
        <div class="team_info">
            <ul style="list-style-type:none;">
                <li>Year      : <?php echo $_SESSION["team_year"]."</li>"; ?>
                <li>Name      : <?php echo $_SESSION["team_name"]."</li>"; ?>
                <li>Submitted : <?php 
                                    // Set the submitted variable.
                                    if($_SESSION["submitted"])
                                      {
                                          echo '<span style="background-color:#00ff00;">Yes</span></li>';
                                      }
                                      else
                                      {
                                          echo '<span style="background-color:red;">No</span></li>';
                                      }
                                ?>
            </ul>
        </div>
        <hr>
        <div class="login">
            <?php if (!($_SESSION["submitted"])):?>
               
                <form action="/team_page.php" method="post" enctype="multipart/form-data" class="game_form" id="team_form">
                    <input type="hidden" name="MAX_FILE_SIZE" value="8000000000" />
                    <div class="form_row" style="padding:7px;">
                        <div style="width:26%;">Game Name</div><div>:</div>&nbsp<input type="text" minlength="1" maxlength="33" name="gameName" style="text-align:left; right:4px; width:230px" required><br>
                    </div>
                    <div class="form_row">
                        <div style="width:50%;">Game Zip Folder</div><div>:</div>&nbsp<input type="file" accept=".zip" name="gameExe" style="text-align:right; right:4px; padding: 5px; height: 20px" required><br>
                    </div>
                    <div class="form_row">
                        <div style="width:50%;">Game Logo</div><div>:</div>&nbsp <input type="file" name="gameLogo" style="text-align:right; right:4px; padding: 5px; height: 20px" required><br>
                    </div>
                    <div class="form_row">
                        <div style="width:50%;">Controls</div><div>:</div>&nbsp <input type="file" name="gameControls" style="text-align:right; right:4px; padding: 5px; height: 20px" required><br>
                    </div>
                    <div class="form_row">
                        <div style="width:36%;">Game Description</div><div>:</div>&nbsp <textarea rows="5" cols="43" maxlenth="500" name="gameDesc" form="team_form" style="white-space: nowrap;" required></textarea><br>
                    </div>
                    <div class="form_row">
                        <div style="width:36%;">Credits</div><div>:</div>&nbsp <textarea rows="5" cols="43" maxlenth="500" name="gameCredits" form="team_form" style="white-space: nowrap;" required></textarea><br>
                    </div>
                    <br>
                    <div class="button">
                        <input type="submit" value="Upload Game" style="border: 1px solid gray;">
                    </div>
                    <br><br>
                </form>     
            <?php            
                // Upload form information to cabinet.
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    // Make a new directory for uploaded game.
                    $gameDir  = "./games/".$_POST["gameName"];
                    $check    = mkdir($gameDir, 0777);
                    if ($check != TRUE)
                    {
                        echo "FAILED TO CREATE DIRECTORY!";
                        exit();
                    }
                    
                    // Create Game Description txt file
                    $gameDesc = $gameDir."/GameDescription.txt";
                    $newFile  = fopen($gameDesc, "w") or die("UNABLE TO CREATE GAME DESC FILE!");
                    fwrite($newFile, $_POST["gameDesc"]);
                    fclose($newFile);
                    
                    // Create Game Credits txt file
                    $gameCred = $gameDir."/GameCredits.txt";
                    $newFile  = fopen($gameCred, "w") or die("UNABLE TO CREATE GAME CREDITS FILE!");
                    fwrite($newFile, $_POST["gameCredits"]);
                    fclose($newFile);
                    
                    // Upload game logo png
                    $gameLogo = $gameDir."/GameLogo.png";
                    $check    = move_uploaded_file($_FILES["gameLogo"]["tmp_name"], $gameLogo);
                    if ($check != TRUE)
                    {
                        echo "FAILED TO UPLOAD GAME LOGO!";
                        exit();
                    }
                    
                    // Upload game controls png
                    $gameCont = $gameDir."/GameControls.png";
                    $check    = move_uploaded_file($_FILES["gameControls"]["tmp_name"], $gameCont);
                    if ($check != TRUE)
                    {
                        echo "FAILED TO UPLOAD GAME CONTROLS!";
                        exit();
                    }
                    
                    // Upload game exec zip folder
                    $nameZip = str_replace(" ", "", $_POST["gameName"]);
                    $gameZip = $gameDir."/".$nameZip.".zip";
                    $check    = move_uploaded_file($_FILES["gameExe"]["tmp_name"], $gameZip);
                    if ($check != TRUE)
                    {
                        echo "FAILED TO UPLOAD GAME EXE ZIP!";
                        exit();
                    }
                    
                    // Extract the Zip files on the server side
                    $zip = new ZipArchive;  
                    if ($zip->open($gameZip) === TRUE) {
                        $zip->extractTo($gameDir."/");
                        $zip->close();
                    } 
                    else 
                    {
                        echo "FAILED TO UNZIP GAME EXE ZIP FOLDER!";
                        exit();
                    }
                    
                    // Update team game path info in database.
                    $sql    = "UPDATE teams SET file_path = '".$gameDir."' WHERE team_name = '".$_SESSION["team_name"]."';";
                    if (!($conn->query($sql) === TRUE)) 
                    {
                        echo "FAILED TO UPDATE FILE PATH IN DATABASE!";
                        exit();
                    }
                    
                    // Update team game name path info in database.
                    $sql    = "UPDATE teams SET game_name = '".$_POST["gameName"]."' WHERE team_name = '".$_SESSION["team_name"]."';";
                    if (!($conn->query($sql) === TRUE)) 
                    {
                        echo "FAILED TO UPDATE GAME NAME IN DATABASE!";
                        exit();
                    }
                    
                    // Update team submission info in database.
                    $sql    = "UPDATE teams SET submitted = '1' WHERE team_name = '".$_SESSION["team_name"]."';";
                    if (!($conn->query($sql) === TRUE)) 
                    {
                        echo "FAILED TO UPDATE SUBMISSION INFO IN DATABASE!";
                        exit();
                    }
                    else
                    {
                        $_SESSION["submitted"] = 1;
                        echo '<script>window.location.href="team_page.php";</script>';
                        exit();
                    }
                    
                }
            endif;?>                   
            <?php if (($_SESSION["submitted"])):?>
                <form action="/team_page.php " method="post" enctype="multipart/form-data" class="game_form" id="team_form">
                    <div>
                        <div style="width:100%;">Game Successfully Submitted!</div>
                    </div>
                    <br>
                    <div class="button">
                        <input type="submit" value="Delete Game" style="border: 1px solid gray;">
                    </div>
                    <br>
            
                </form> 
            <?php  
                // Delete game from Cabinet and update team information.
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    // Delete Game.
                    $sql    = "SELECT * FROM teams WHERE team_name = '".$_SESSION["team_name"]."';";
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
                        echo "UNABLE ACCESS DATABASE!";
                        exit();
                    }

                    // Update team game path info in database.
                    $sql    = "UPDATE teams SET file_path = ' ' WHERE team_name = '".$_SESSION["team_name"]."';";
                    $result = $conn->query($sql);
                    if (!($conn->query($sql) === TRUE)) 
                    {
                        echo "FAILED TO UPDATE FILE PATH IN DATABASE!";
                        exit();
                    }
                    
                    // Update team submission info in database.
                    $sql    = "UPDATE teams SET submitted = '0' WHERE team_name = '".$_SESSION["team_name"]."';";
                    $result = $conn->query($sql);
                    if (!($conn->query($sql) === TRUE)) 
                    {
                        echo "FAILED TO UPDATE DATABASE!";
                        exit();
                    }
                    else
                    {
                        $_SESSION["submitted"] = 0;
                        echo '<script>window.location.href="team_page.php";</script>';
                        exit();
                    }
                    
                }
            endif;?>        
        <div>
    </div>
</body>
</html>