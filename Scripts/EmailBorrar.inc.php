<?php
$destinatario= $_SESSION['email'];
$asunto="Desactivacion de cuenta";

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1\r\n';

$cabeceras .= 'To: >'. $destinatario . '>' . "\r\n";
$cabeceras .= 'From: MedicionCO2-USCO' . "\r\n";
$cabeceras .= 'Cc: co2.juandavidpolo.com/' . "\r\n";
$cabeceras .= 'Bcc: co2.juandavidpolo.com/' . "\r\n";

$message = '<html><head>';
$message .= '<meta charset="UTF-8">';
$message .= '<link href="https://fonts.googleapis.com/css?family=Muli|Open+Sans|PT+Sans&display=swap" rel="stylesheet">';
$message .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
$message .= '<link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">';
$message .= '</head>';
$message .= '<body style="background:#ffffff;margin:0px;padding:0px;width:100%;margin:0px;font-family:"Muli",sans-serif;">';
$message .= '<div style="padding:0px;margin:0px;background:#8f1b20;border-radius:5px 5px 5px 5px;">';
$message .= '<div style="color:#e4d4a4;">';
$message .= '<h1 style="padding:10px;">Medicion CO2 - USCO</h1>';
$message .= '</div>';
$message .= '<div style="padding:10px;height:100%;color:#FFF8F0;background-color:#b47464;border-radius: 0px 0px 5px 5px;">';
$message .= '<h3>Cuenta desactivada</h3>';
$message .= '<p>Tu cuenta ha sido borrada correctamente. Toda la información asociada ha sido eliminada.';
$message .= '</p>';
$message .= '</div></div>';
$message .= '</body></html>';

$cuentaDesactivada=mail($destinatario, $asunto, $message, $cabeceras);