<?php
$errorMSG = "";
$email = "";
$id = "";
$regione = "";

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "E' obbligatorio inserire un indirizzo email.";
} else {
    $email = $_POST["email"];
}

// RETRIEVE LEADS FROM DB
include('dbconnection.php');

if (isset($_POST['id']) and isset($_POST['regione'])) {

    $id = $_POST['id'];
    $regione = $_POST['regione'];

    // Retrieve data
    $sql = "select sum(numero_totale) from RegioneMicroJunction where regione_id = $regione and micro_id in (select id from Micro where macro_id in (select customer_id from MacroJunction where macro_id = $id));
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            SendEmail($errorMSG, $email, $row["sum(numero_totale)"]);
        }
    } else {
        echo "0 results";
    }
}

$conn->close();

function SendEmail($errorMSG, $email, $numero_totale){

    $EmailTo = $email;
    $Subject = "Riepilogo dati - Clientoteca";

// prepare email body text
    $Body = "";
    $Body .= "Buongiorno,<br>secondo i dati da Lei inseriti sul sito www.clientoteca.com queste sono le possibili connessioni sul territorio:";
    $Body .= "\n";
    $Body .= "\n";
    $Body .= "Numero leads: ";
    $Body .= $numero_totale;
    $Body .= "\n";
    $Body .= "Contatti email possibili: ";
    $Body .= $numero_totale;
    $Body .= "\n";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers .= "From: contatto@clientoteca.com \r\n";
    $headers .= "Bcc: contatto@clientoteca.com\r\n";
    //$headers .= "Reply-To: condomini@abacond.com \r\n";
    //$headers .= "Return-Path: clientoteca.com\r\n";
    $headers .= "X-Mailer: PHP \r\n";

    // send email
    $success = mail($EmailTo, $Subject, $Body, $headers);
    // redirect to success page
    if ($success && $errorMSG == ""){
        echo "success";
    }else{
        if($errorMSG == ""){
            echo "Qualcosa è andato storto :(";
        } else {
            echo $errorMSG;
        }
    }


}

// SEND EMAL

