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

    var_dump($id, $regione);

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

    $leads = round($numero_totale * 0.66);
    $target = round($numero_totale * 0.22);
    $appuntamenti = round($numero_totale * 0.06);
    $clienti = round($numero_totale * 0.03);
    $email_raccolte = round(($numero_totale * 0.66) * 0.3375);


// prepare email body text
    $Body = "";
    $Body .= "<p>Buongiorno,<br>secondo i dati da Lei inseriti sul sito www.clientoteca.com queste sono le possibili connessioni sul territorio:</p>";
    $Body .= "<table>";
    $Body .= "<tr style='padding-bottom: 20px;'>";
    $Body .= "<td><b>Numero leads</b></td>";
    $Body .= "<td style='padding-left: 20px'>";
    $Body .= $leads;
    $Body .= "</td>";
    $Body .= "</tr>";
    $Body .= "<tr style='padding-bottom: 20px;'>";
    $Body .= "<td><b>Target invio presentazione</b></td>";
    $Body .= "<td style='padding-left: 20px'>";
    $Body .= $target;
    $Body .= "</td>";
    $Body .= "</tr>";
    $Body .= "<tr style='padding-bottom: 20px;'>";
    $Body .= "<td><b>Numero di appuntamenti accettati</b></td>";
    $Body .= "<td style='padding-left: 20px'>";
    $Body .= $appuntamenti;
    $Body .= "</td>";
    $Body .= "</tr>";
    $Body .= "<tr style='padding-bottom: 20px;'>";
    $Body .= "<td><b>Numero clienti</b></td>";
    $Body .= "<td style='padding-left: 20px'>";
    $Body .= $clienti;
    $Body .= "</td>";
    $Body .= "</tr>";
    $Body .= "<tr style='padding-bottom: 20px;'>";
    $Body .= "<td><b>Numero email raccolte</b></td>";
    $Body .= "<td style='padding-left: 20px'>";
    $Body .= $email_raccolte;
    $Body .= "</td>";
    $Body .= "</tr>";
    $Body .= "</table>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//    $headers .= "From: contatto@clientoteca.com \r\n";
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

