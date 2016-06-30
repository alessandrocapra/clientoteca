<?php

include('dbconnection.php');

$sql = "SELECT id,nome FROM Regione";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value=\" " . $row['id'] . " \">" . $row['nome'] . "</option>";
    }
} else {
    echo "0 results";
}

$conn->close();
