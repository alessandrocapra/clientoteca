<?php
/**
 * Created by PhpStorm.
 * User: ale
 * Date: 30/06/16
 * Time: 22:40
 */

//$servername = "localhost";
//$username = "clientoteca";
//$password = "clientoteca";
//$dbname = "clientoteca";

$servername = "89.31.72.141";
$username = "loilvu84_cliento";
$password = "UfAPWHns";
$dbname = "clientoteca_com_categorie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}