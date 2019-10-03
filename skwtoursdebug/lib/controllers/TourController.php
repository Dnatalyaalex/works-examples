<?php

class TourController extends Controller {

    public function toursList()
    {
        $sql = 'SELECT * FROM tours ORDER BY title';
        
        foreach ($this->db->query($sql) as $tour) {
            
            $sql2 = "SELECT * FROM hotels WHERE id='{$tour["hotel_id"]}'";
            $sql3 = "SELECT * FROM cities WHERE id='{$tour["city_id"]}'";
            $hotel = $sql2 = "SELECT * FROM hotels WHERE id='{$tour["id"]}'";
           
            $hotelResult = $this->db->query($sql2)->fetch();
            $cityResult = $this->db->query($sql3)->fetch();
            
            echo "<div class='mainContentComponents' style='background: url(../../css/img/{$tour['title']}.jpg); background-size: cover; background-position: center center'>
                <div class='background'>";
                echo "<h4>".$tour["title"]."</h4>";
                echo "<h4><strong>{$cityResult['title']}</strong></h4>";
                echo "<h5>{$tour['checkin_date']} - {$tour['checkout_date']}</h5>";
                echo "<h4><strong>{$hotelResult['title']}</strong><h4>";
                echo "<h5><b>Цена {$tour['price']}$</b></h5>";
                echo "<a class='btn btn-primary' href=?tour={$tour['id']}>Подробно</a>";
            echo "</div></div>";
                        
        }
    }
    
    public function describeTour($tour_id) {
        $sql = "SELECT * FROM tours WHERE id = '{$tour_id}'";
        $tour = $this->db->query($sql)->fetch();
        
        $sql2 = "SELECT * FROM cities WHERE id = '{$tour['id']}'";
        $city = $this->db->query($sql2)->fetch();
        
        foreach ($this->db->query($sql) as $row) {
            echo "<p class='details'><b>".$row['title']."</b></p>";
            echo "<p class='details'><b>{$city['title']}</b></p>";
            echo "<p class='dateDetails'><b>{$row['checkin_date']} - {$row['checkout_date']}</b></p>";
            echo "<p class='dateDetails but'><a class='btn btn-primary' href=?orderTour={$tour['id']}>Заказать тур</a></p>";
            echo "<p>Из всех люксов и номеров отеля Mykonos Star можно любоваться впечатляющим Эгейским морем и бухтой Панормос. Интерьеры красиво оформлены и обставлены комфортабельной мебелью.

            В баре-ресторане Star Lounge подают свежевыжатые соки, напитки и средиземноморские блюда. В ресторане у бассейна и у моря представлены избранные греческие деликатесы, приготовленные из свежих продуктов местного производства. Гости по достоинству оценят марочные греческие вина в меню.

            Пляж поселка Агиос-Состис пролегает в 300 метрах от отеля Mykonos Star, а пляж Панормос — в 800 метрах. Город Миконос начинается в 7,5 км. Расстояние до аэропорта и порта острова Миконос составляет всего 7 км. Ближайший супермаркет работает в 3,5 км.</p>";
            echo "<div class='container'>
              <br>
              <div id='myCarousel' class='carousel slide' data-ride='carousel'>
                <!-- Indicators -->
                <ol class='carousel-indicators'>
                  <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                  <li data-target='#myCarousel' data-slide-to='1'></li>
                  <li data-target='#myCarousel' data-slide-to='2'></li>
                  <li data-target='#myCarousel' data-slide-to='3'></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class='carousel-inner' role='listbox'>

                  <div class='item active'>
                    <img src='../../css/img/21.jpg' alt='Chania' width='460' height='345'>
                  </div>

                  <div class='item'>
                    <img src='../../css/img/22.jpg' alt='Chania' width='460' height='345'>
                  </div>

                  <div class='item'>
                    <img src='../../css/img/23.jpg' alt='Flower' width='460' height='345'>
                  </div>

                  <div class='item'>
                    <img src='../../css/img/24.jpg' alt='Flower' width='460' height='345'>
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
    echo "{$row['description']}";
        }
    }

    public function form($id)
    {
        $tourId = $id;
      
            $sql = "SELECT * FROM tours WHERE id = '{$tourId}'";
            $tour = $this->db->query($sql)->fetch();

              include_once $_SERVER["DOCUMENT_ROOT"] . "/userform/form.php"; 
        
    }

    public function store($id, $name, $phone, $link) 
    {
      $sql="INSERT INTO `cart`(`id`, `name`, `phone`, `link`) 
      VALUES (
      '$id',
      '$name',
      '$phone',
      '$link')";
        
        $this->db->query($sql);
        $this->toursList();
    }
}
?>