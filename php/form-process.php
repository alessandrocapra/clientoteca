<?php
$errorMSG = "";
// NAME
if (empty($_POST["name"])) {
    $errorMSG = "E' obbligatorio inserire il nome";
} else {
    $name = $_POST["name"];
}
// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "E' obbligatorio inserire un indirizzo email.";
} else {
    $email = $_POST["email"];
}
// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Messaggio obbligatorio.";
} else {
    $message = $_POST["message"];
}
$EmailTo = "alessandro.cpr@gmail.com";
$Subject = "Nuovo messaggio da sito Clientoteca";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// CSV
$Content = "Name, Email, Message\n";
$Content .= "$name, $email, $message\n";
$FileName = "datiform-".date("d-m-y-h:i").".csv";
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $FileName . '"');
echo $Content;
exit();

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
