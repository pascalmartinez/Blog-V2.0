<?php
    function connectBDD(){
        $servername = "localhost";
<<<<<<< HEAD

        $username = "root";

        $password = "admin";
=======
        $username = "root";
        $password = "yolo";
>>>>>>> 4047028b91540a8fe8cac67aa6a3c341198298f9
        $dbname = "myBlog";

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
