 <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!--    gallery-->
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.8.2/css/all.css' integrity='sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay' rel='stylesheet'/>
    
    <link rel="stylesheet" href="/admin/css/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
    <title>Welcome!</title>
</head>
<body>

<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
    <p class="navbar-brand">Via Travel</p>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
<?php
    $links = [
            "Туры" => "/admin/?section=tours&action=index",
            "Страны" => "/admin/?section=countries&action=index",
            "Отели" => "/admin/?section=hotels&action=index",
            "Города" => "/admin/?section=cities&action=index",
            "Выход" => "?logout"
    ];
            
    //var_dump($_SERVER);
    foreach ($links as $k=>$v){
        //
        $class = "";
        if($_SERVER["REQUEST_URI"] == $v){
            $class = "active";
        }
        echo <<<"EOT"
            <li class="nav-item $class">
                <a class="nav-link" href="{$v}">{$k}</a>
            </li>
           
EOT;
  
    }
?>

           </ul>
           
           <a id="cart" href="?cart"><img class='cart' src="/admin/css/img/cart.png" width="35px" alt=""></a>

    </div>
    
</nav>

<div class="container-fluid">