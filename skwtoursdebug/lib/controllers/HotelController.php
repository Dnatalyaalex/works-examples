<?php

class HotelController extends Controller {
    
    public function showHotel($hotel_id)
    {
        $sql = "SELECT * FROM hotels WHERE id='{$hotel_id}'";
        $result = $this->db->query($sql)->fetch();
        
        $sql3 = "SELECT * FROM hotels WHERE id='{$hotel_id}'";
        $description = $this->db->query($sql3)->fetch();
       
        echo "<h4><strong>{$result['title']}</strong></h4>";
        echo "<div class='container'>
              <br>
              <div id='myCarousel' class='carousel slide' data-ride='carousel'>
                <!-- Indicators -->
                <ol class='carousel-indicators'>
                  <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                  <li data-target='#myCarousel' data-slide-to='1'></li>
                  <li data-target='#myCarousel' data-slide-to='2'></li>
                  <li data-target='#myCarousel' data-slide-to='3'></li>
                  <li data-target='#myCarousel' data-slide-to='4'></li>
                  <li data-target='#myCarousel' data-slide-to='5'></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class='carousel-inner' role='listbox'>

                  <div class='item active'>
                    <img src='./css/img/1-1.jpg' alt='Chania' width='460' height='345'>
                  </div>

                  <div class='item'>
                    <img src='./css/img/1-2.jpg' alt='Chania' width='460' height='345'>
                  </div>

                  <div class='item'>
                    <img src='./css/img/3.jpg' alt='Flower' width='460' height='345'>
                  </div>

                  <div class='item'>
                    <img src='./css/img/4.jpg' alt='Flower' width='460' height='345'>
                  </div>
                  
                  <div class='item'>
                    <img src='./css/img/5.jpg' alt='Flower' width='460' height='345'>
                  </div>
                  
                  <div class='item'>
                    <img src='./css/img/6.jpg' alt='Flower' width='460' height='345'>
                  </div>

                </div>

                <!-- Left and right controls -->
                <a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
                  <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
                  <span class='sr-only'>Previous</span>
                </a>
                <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
                  <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
                  <span class='sr-only'>Next</span>
                </a>
              </div>
            </div><br><br>";
                echo $description['description'];
    }
    
    public function allHotels() {
        $sql = "SELECT * FROM hotels";
        
        foreach ($this->db->query($sql) as $row) {
            $photos = "SELECT * FROM photos_table WHERE id='{$row["hotel_id"]}'";
            $photo = $this->db->query($photos)->fetch();
            
            $tourSql = "SELECT * FROM tours WHERE hotel_id='{$row['id']}'";
            $tour = $this->db->query($tourSql)->fetch();

            echo "<div style='background: url(./css/img/hotelsbg.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat' class='mainContentComponents'><a href='?hotel={$row['id']}'><h4 class='countryName'>".$row['title'] . "</h4></a></div>";
        }
    }
}