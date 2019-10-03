<?php
    ini_set( 'display_errors', 1 );

    error_reporting( E_ALL );

    $from = "dnatalyaalex@gmail.com";

    $to = "dnatalyaalex@gmail.com";

    $subject = "Checking PHP mail";

    $message = "PHP mail works just fine";

    $headers = "From: dnatalyaalex@gmail.com";

    mail($to,$subject,$message, $headers);

    echo "The email message was sent.";
?>