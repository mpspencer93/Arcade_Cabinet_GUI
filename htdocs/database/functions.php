<?php
    // Function to recursively delete directory contents.
    function Delete_Directory($dir) 
    { 
       $files = array_diff(scandir($dir), array('.','..')); 
        foreach ($files as $file) 
        { 
            (is_dir("$dir/$file")) ? Delete_Directory("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
    }
?>