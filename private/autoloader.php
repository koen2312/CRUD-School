<?php
    require_once "../static/database.php";

    session_start();

    if(!isset($_SESSION["userid"])){
        header("location: index.php");
    }

    function my_autoloader($class) {
        $file = "../private/managers/$class.php";
        
        if (file_exists($file)){
            require_once "$file";
        }
    }
    
    spl_autoload_register('my_autoloader');
?>