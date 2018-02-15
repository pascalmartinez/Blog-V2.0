<?php
    function connectBDD(){
        $servername = "localhost";
        $username = "username";
        $password = "root";
        $dbname = "yolo";

        try {
            $connect = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8", $username, $password);
            // set the PDO error mode to exception
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect;
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
    }
?>
