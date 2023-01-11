<?php
$email_from = "chrigisteffen@gmail.com";
$sendermail_antwort = true;
$name_von_emailfeld = "email";

$empfaenger = "christian_steffen@outlook.com";
$mail_cc = "";
$betreff = "Neue Kontaktanfrage";

$url_ok = "C:\Program Files\atom-1631windows\Projekte\kontaktformular\pages\danke.html";
$url_fehler = "C:\Program Files\atom-1631windows\Projekte\kontaktformular\pages\fehler.html";


//$ignore_fields = array('submit');



$name_tag = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
$num_tag = date("w");
$tag = $name_tag[$num_tag];
$jahr = date("Y");
$n = date("d");
$monat = date("m");
$time = date("H:i");


$msg = ":: Gesendet am $tag, den $n.$monat.$jahr - $time Uhr ::\n\n";


foreach($_POST as $name => $value) {
   if (in_array($name, $ignore_fields)) {
        continue;
   }
   $msg .= "::: $name :::\n$value\n\n";
}



if ($sendermail_antwort and isset($_POST[$name_von_emailfeld]) and filter_var($_POST[$name_von_emailfeld], FILTER_VALIDATE_EMAIL)) {
   $email_from = $_POST[$name_von_emailfeld];
}

$header="From: $email_from";

if (!empty($mail_cc)) {
   $header .= "\n";
   $header .= "Cc: $mail_cc";
}


$header .= "\nContent-type: text/plain; charset=utf-8";

$mail_senden = mail($empfaenger,$betreff,$msg,$header);


if($mail_senden){
  header("Location: ".$url_ok);
  exit();
} else{
  header("Location: ".$url_fehler);
  exit();
}
