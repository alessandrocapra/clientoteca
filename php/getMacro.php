<?php

include('dbconnection.php');

if (isset($_POST['id'])) {

    $id=$_POST['id'];

    $sql = "SELECT id,nome FROM Macro WHERE mega_id = $id and id NOT IN (11,13,16,45,77,92,96,189,201,211,227)";
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
}


