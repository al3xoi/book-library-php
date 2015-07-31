<?php
$dir = "uploads/";

//open dir
if ($opendir = opendir($dir)) {

    //read dir
    while (($file = readdir($opendir)) !== FALSE) {
        if ($file != "." && $file != "..")
            echo "<img src='$dir/$file'><br><br>";
    }
}

?> 