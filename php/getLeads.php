<?php
$servername = "localhost";
$username = "clientoteca";
$password = "clientoteca";
$dbname = "clientoteca";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $regione = $_POST['regione'];

    // Retrieve data
    $sql = "select sum(numero_totale) from RegioneMicroJunction where regione_id = $regione and micro_id in (select id from Micro where macro_id in (select customer_id from MacroJunction where macro_id = $id));
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //							echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
            echo $row["sum(numero_totale)"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

$conn->close();