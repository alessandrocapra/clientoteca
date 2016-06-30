<?php

include('dbconnection.php');

if (isset($_POST['id'])) {

    $id=$_POST['id'];

    $sql = "SELECT id,nome FROM Macro WHERE mega_id = $id";
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


