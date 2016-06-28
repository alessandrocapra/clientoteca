<?php
/**
 * Created by PhpStorm.
 * User: ale
 * Date: 12/01/16
 * Time: 16:35
 */

$servername = "192.168.56.101";
$username = "clientoteca";
$password = "clientoteca";

try {
    $conn = new PDO("mysql:host=$servername;dbname=clientoteca", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>