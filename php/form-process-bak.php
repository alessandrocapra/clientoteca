<?php
$errorMSG = "";

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "E' obbligatorio inserire un indirizzo email.";
} else {
    $email = $_POST["email"];
}

$EmailTo = "contatto@clientoteca.com";
$Subject = "Nuovo messaggio da sito Clientoteca";

// prepare email body text
$Body = "";
$Body .= "Messaggio ricevuto dal form del sito Clientoteca!";
$Body .= "\n";
$Body .= "\n";
$Body .= "Nome: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "\n";
$Body .= "Messaggio: ";
$Body .= $message;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
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
