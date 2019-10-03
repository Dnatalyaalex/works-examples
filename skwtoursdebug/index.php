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

include "./resources/components/header.php";
 if(isset($_GET["countries"]))
{
   
    include "./lib/controllers/CountryController.php";
    $c = new CountryController($db, $logger);
    ?>
    <div id='world'><p>THE WORLD IS FOR YOU</p></div>
    <div class='mainContent'>
    <?php
        $c->countriesList();
    ?>
    </div>
    
    
    <?php
}
else if(isset($_GET["describeCountry"]))
{
   
    include "./lib/controllers/CountryController.php";
    $c = new CountryController($db, $logger);
     ?>
       <div id='countryDetails'>
    <?php
        $c->showCountry($_GET['describeCountry']);
    ?>
    </div>
    <?php
    
}else if(isset($_GET["hotels"]))
{
    ?>
    <div id="hotelslist"></div>
    <?php
    
        include "./lib/controllers/HotelController.php";
        $c = new HotelController($db, $logger);
    ?>
    <div class="mainContent">
    <?php
        $c->allHotels();
    ?>
    </div>
    <?php

}   
//каждый отель
else if(isset($_GET["hotel"]))
{
    include "./lib/controllers/HotelController.php";
        $c = new HotelController($db, $logger);
    ?>
        <div class="hotelGallery">
    <?php
        $c->showHotel($_GET["hotel"]);
    ?>
        </div>
    <?php
}
//все туры
else if(isset($_GET["tours"]))
{
    //tours
    ?>
    <div id='toursHead'></div>
    <?php
    
    include "./lib/controllers/TourController.php";
    $c = new TourController($db, $logger);
    ?> 
    <div class="mainContent">
    
    <?php
    $c->toursList();
    ?>
    </div>

<?php
} else if(isset($_GET['tour'])) {
    include "./lib/controllers/TourController.php";
    ?>
    <div id='toursHead'></div>
    <?php
    $c = new TourController($db, $logger);
    ?>
    <div class='toursDescription'>
    <?php
    $c->describeTour($_GET['tour']);
    ?>
    </div>
    <?php
} else if(isset($_GET['contacts'])) {
    include "./lib/controllers/ContactsController.php";
    ?>
    <div id='contactUs'></div>
    <?php
    $c = new ContactsController($db, $logger);
    $c->ContactInformation();
    
} else if(isset($_GET['aboutus'])) {
    include "./lib/controllers/Aboutus.php";
    ?>
    <div id='contactUs'></div>
    <?php
    $c = new AboutController($db, $logger);
    ?>
    <div class="aboutCompany">
    <?php
    $c->about();
    ?>
    </div>
    <?php
    
}

//поиск тура
else if(isset($_GET["tour_search"])){
    
    include "./lib/controllers/HomeController.php";
    ?>
    <div id="headSearchContent"></div>
    <div id="searchContent">
        <p>Результаты поиска</p>
    <?php
        $c = new HomeController($db, $logger);

        $c->render();
    ?>
    </div>
    <div id="mainContent">
    <?php
    $c->tourSearch($_POST['country'], $_POST['start-date'], $_POST['finish-date']);
    ?>
    </div>
    <?php
    }else if(isset($_GET["orderTour"])){
    
        include "./lib/controllers/TourController.php";
       
        $c = new TourController($db, $logger);
        echo "<div>";
        $c->form($_GET["orderTour"]);
        echo "</div>";
        
    } else if(isset($_GET["store"])) {
    
     include "./lib/controllers/TourController.php";
       
        $c = new TourController($db, $logger);

        $c->store('0', $_POST['name'], $_POST['phone'], $_POST['link']);
    }else{
    ?>
    <div id="content">
    
    <?php
//home page
    include "./lib/controllers/HomeController.php";
    $c = new HomeController($db, $logger);
    
        ?>
        <div id="travel">
            <p class="travel">Via Travel</p>
        </div>
        
        <?php
    $c->render();
    ?>
    </div>
    <div class="mainContent ">
    <?php
    echo "<p class='ourTours'>Наши туры</p>";
    
    $c->tourSearch($_POST['country'], $_POST['start-date'], $_POST['finish-date']);
    ?>
    </div>
    
    <?php
    }

       


include "./resources/components/footer.php";
?>
