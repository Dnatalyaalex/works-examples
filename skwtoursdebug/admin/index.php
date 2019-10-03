<?php
/*
 * /
 * ?cities
 * ?city=id
 * ?hotels
 * ?hotel=id
 * ?tour=id
 * ?country=id
 *
 *
 * */
session_start();
include "./config/db.php";
include "./config/log.php";

include "./lib/controllers/Controller.php";


if(isset($_POST["login"], $_POST["password"])){
    include "lib/controllers/UserController.php";
    $userController = new UserController($db, $logger);
    if($userController->auth($_POST["login"], $_POST["password"])){
        $_SESSION["user"] = true;
    }
}


if(isset($_GET["logout"])){
    // Удаляем все переменные сессии.
    $_SESSION = array();

    // Если требуется уничтожить сессию, также необходимо удалить сессионные cookie.
    // Замечание: Это уничтожит сессию, а не только данные сессии!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Наконец, уничтожаем сессию.
    session_destroy();
}




if(isset($_SESSION["user"])){
    include "./resources/components/header.php";
    // авторизирован
    if(isset($_GET["section"], $_GET["action"])) {
        switch ($_GET["section"]) {
            case "tours":{
                include "./lib/controllers/TourController.php";
                $c = new TourController($db, $logger);

                switch($_GET["action"]){
                    case "index":{
                        echo "<div class=\"mainContent\">";
                        echo " <a id='addNew' href='?section=tours&action=add'>Добавить тур</a>";
                        $c->toursList();
                        echo "</div>";
                    }break;
                    case "add":{
                        echo "<div class=\"mainContent\">";
                        $c->addTour();
                        echo "</div>"; 
                    }break;
                    case "editform":{
                        echo "<div class=\"mainContent\">";

                        if(isset($_GET["id"])) {
                            $c->editform($_GET["id"]);
                        }else{
                            echo "Тур не найден";
                        }
                        echo "</div>";
                    }break;
                    case "store":{
                        echo "<div class=\"mainContent\">";
                        $c->store($_POST["id"], $_POST["title"], $_POST["description"],
                            $_POST["price"], $_POST["country_id"],  $_POST["city_id"], $_POST["hotel_id"], $_POST["checkin_date"], $_POST["checkout_date"]);
                        echo "</div>";
                    }break;  
                    case "storeAdd":{
                    echo "<div class=\"mainContent\">";
                    $c->storeAdd('0', $_POST["title"], $_POST["description"], $_POST["price"], $_POST["country_id"], $_POST["city_id"], $_POST["hotel_id"], $_POST["checkin_date"], $_POST["checkout_date"]);
                    echo "</div>";
                    }break;
                    case "delete":{
                        echo "<div class=\"mainContent\">";
                        $c->delete($_GET['id']);
                        echo "</div>";
                    }break;
                }
            }break;
                
            //=================================
            
            case "countries":{
                include "./lib/controllers/CountryController.php";
                $c = new CountryController($db, $logger);

                switch($_GET["action"]){
                    case "index":{
                        echo "<div class=\"mainContent\">";
                        echo " <a id='addNew' href='?section=countries&action=add'>Добавить страну</a>";
                        $c->countriesList();
                        echo "</div>";
                    }break;
                    case "add":{
                        echo "<div class=\"mainContent\">";
                        $c->addCountry();
                        echo "</div>";
                    }break;
                    case "editform":{
                        echo "<div class=\"mainContent\">";

                        if(isset($_GET["id"])) {
                            $c->editform($_GET["id"]);
                        }else{
                            echo "Страна не найдена";
                        }
                        echo "</div>";
                    }break;
                    case "store":{
                        echo "<div class=\"mainContent\">";
                        $c->store($_POST["id"], $_POST["title"], $_POST["description"]);
                        echo "</div>";
                    }break;
                    case "delete":{
                        echo "<div class=\"mainContent\">";
                        $c->delete($_GET['id']);
                        echo "</div>";
                    }break;
                    case "storeAdd":{
                        echo "<div class=\"mainContent\">";
                        $c->storeAdd('0', $_POST["title"], $_POST["description"]);
                        echo "</div>";
                    }break;
                }
            }break;
               //=================================================== 
            case "hotels":{
                include "./lib/controllers/HotelController.php";
                $c = new HotelController($db, $logger);

                switch($_GET["action"]){
                    case "index":{
                        echo "<div class=\"mainContent\">";
                        echo " <a id='addNew' href='?section=hotels&action=add'>Добавить отель</a>";
                        $c->hotelsList();
                        echo "</div>";
                    }break;
                    case "add":{
                        echo "<div class=\"mainContent\">";
                        $c->addHotel();
                        echo "</div>";
                    }break;
                    case "editform":{
                        echo "<div class=\"mainContent\">";

                        if(isset($_GET["id"])) {
                            $c->editform($_GET["id"]);
                        }else{
                            echo "Отель не найден";
                        }
                        echo "</div>";
                    }break;
                    case "store":{
                        echo "<div class=\"mainContent\">";
                        $c->store($_POST["id"], $_POST["title"], $_POST["description"], $_POST["city"], $_POST["category"]);
                        echo "</div>";
                    }break;
                    case "storeAdd":{
                        echo "<div class=\"mainContent\">";
                        $c->storeAdd('0', $_POST["title"], $_POST["city"], $_POST["category"], $_POST["description"]);
                        echo "</div>";
                    }break;
                    case "delete":{
                        echo "<div class=\"mainContent\">";
                        $c->delete($_GET["id"]);
                        echo "</div>";
                    }break;
                }
            }break;
                
                  //=================================================== 
            case "cities":{
                include "./lib/controllers/CityController.php";
                $c = new CityController($db, $logger);

                switch($_GET["action"]){
                    case "index":{
                        echo "<div class=\"mainContent\">";
                        echo " <a id='addNew' href='?section=cities&action=add'>Добавить город</a>";
                        $c->citiesList();
                        echo "</div>";
                    }break;
                    case "add":{
                        echo "<div class=\"mainContent\">";
                        $c->addCity();
                        echo "</div>";
                    }break;
                    case "editform":{
                        echo "<div class=\"mainContent\">";

                        if(isset($_GET["id"])) {
                            $c->editform($_GET["id"]);
                        }else{
                            echo "Город не найден";
                        }
                        echo "</div>";
                    }break;
                    case "store":{
                        echo "<div class=\"mainContent\">";
                        $c->store($_POST["id"], $_POST["title"], $_POST["country"]);
                        echo "</div>";
                    }break;
                     case "storeAdd":{
                        echo "<div class=\"mainContent\">";
                        $c->storeAdd('0', $_POST["title"], $_POST["country"]);
                        echo "</div>";
                    }break;
                    case "delete":{
                        echo "<div class=\"mainContent\">";
                        $c->delete($_GET["id"]);
                        echo "</div>";
                    }break;
                }
            }break;
        //========================================================
            case "cart":{
            include "./lib/controllers/CartController.php";
            $c = new CartController($db, $logger);

                switch($_GET["action"]){
                    case "delete":{
                        $c->delete($_GET['id']);
                    }break;
                }
    
            } break;
        //=======================  =============================
        } 
    } else if (isset($_GET["cart"])) {
    
    include "./lib/controllers/CartController.php";
   
    $c = new CartController($db, $logger);
    ?>
    <div class="mainContent">
    <?php
        $c->showCart();
    ?>
    
    </div>
    <?php
}
    include "./resources/components/footer.php";
} else{
    // не авторизирован

 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.8.2/css/all.css' integrity='sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay' rel='stylesheet'/>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="admin">
    
    <?php
    
    include "./resources/components/auth_form.php";
    ?>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        
</html>
<?php
}
?>
