<?php

class CountryController extends Controller {

    public function countriesList()
    {
        $sql = 'SELECT * FROM countries ORDER BY title';

        foreach ($this->db->query($sql) as $row) {

            echo "<a class='mainContentComponents' style='background: url(../../css/img/{$row['title']}.jpg); background-size: cover; background-position: center center' href='?describeCountry={$row['id']}'><h4 class='countryName'>".$row['title'] . "</h4></a>";
        }
    }
    
    public function showCountry($country_id) {
        $sql = "SELECT * FROM countries WHERE id = '{$country_id}'";
        $country = $this->db->query($sql)->fetch();
        
        echo "<p class='header'><b>{$country['title']}</b></p>";
        echo "{$country['description']}";
        
        $sql = "SELECT * FROM tours WHERE country_id = '{$country_id}'";
        
        echo "<div id='topicalTours'><h4><b>Актуальные туры</b></h4></div>";
        
        //===проверка условия наличия туров
        
        $mysqli = new mysqli("127.0.0.1", "root", "", "skw_tours");

        /* проверка соединения */
        if (mysqli_connect_errno()) {
            printf("Соединение не удалось: %s\n", mysqli_connect_error());
            exit();
        }

        $result = $mysqli->query("SELECT * FROM tours WHERE country_id = '{$country_id}'");

        /* определение числа рядов в выборке */
        $row_cnt = $result->num_rows;
                
        
        if($row_cnt != 0) {
        //==============
        
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
    } else {
            echo "<p class='noTopical'>Актуальных туров нет</p>";
        } 
        
      
    }
}
?>
