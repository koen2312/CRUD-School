<?php
    try{
        $con = new PDO("mysql:dbname=ratjetoe;host=localhost","root","");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

?>