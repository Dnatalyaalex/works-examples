<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.05.2019
 * Time: 19:20
 */

class HomeController extends Controller
{
    private $toursList = [];
    
    public function render()
    {
        //dates
        $start_date = isset($_POST["start-date"]) ? $_POST["start-date"] : "";
        $finish_date = isset($_POST["finish-date"]) ? $_POST["finish-date"] : "";

        //countries
        $sql = "SELECT * FROM countries";
        $countriesList = $this->db->query($sql);

//        echo "<pre>";
//        var_dump($countriesList);
//        echo "</pre>";

    ?>
    <div class="row justify-content-center">
        <div class="col-10">
            <form class='form' action="?tour_search" method="post">
                <div class="form-row">
                    <div class="form-group col-md-3 offset-md-1">
                        <label for="country">Выберите страну</label>
                        <select id="country" name="country" class="form-control">
                            <option value="0">Страна</option>
                            <?php
                                foreach ($countriesList as $row){
                                    $selected = isset($_POST["country"]) &&
                                                 $_POST["country"] == $row['id'] ? "selected" : "";
                                    echo "<option $selected value='{$row['id']}'>{$row['title']}</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="form-group col-md-3">
                        <label for="start-date">Дата вылета</label>
                        <input id="start-date"
                               name="start-date"
                               type="text"
                               class="form-control"
                               placeholder="From"
                               value="<?=$start_date?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="finish-date">Дата прилета</label>
                        <input id="finish-date"
                               name="finish-date"
                               type="text"
                               class="form-control"
                               placeholder="To"
                                value="<?=$finish_date?>">
                    </div>
                    <div class="form-group col-md-1 align-bottom d-flex">
                        <button id='searchTours' type="submit" class="btn btn-primary align-bottom">Найти</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        
    }

    public function tourSearch($countryid, $startDate, $finishDate)
    {    
        if($countryid && ($startDate) && ($finishDate)){
            $this->log->write("condition 1"); 
            $sql = "SELECT * FROM tours WHERE country_id='{$countryid}' && checkin_date>='{$startDate}' && checkout_date<='{$finishDate}'";
            $this->toursList = $this->db->query($sql)->fetchAll();
            $this->log->write( $startDate."::::".$finishDate);    
        }else if($countryid){ 
            $this->log->write("condition 2($countryid)");    
            $sql = "SELECT * FROM tours WHERE country_id='{$countryid}'";
            $this->toursList = $this->db->query($sql)->fetchAll();
        }else if($startDate && $finishDate){ 
            $this->log->write("condition 3");    
            $sql = "SELECT * FROM tours WHERE checkin_date>='{$startDate}' && checkout_date<='{$finishDate}'";
            $this->toursList = $this->db->query($sql)->fetchAll();
        }else{
            $this->log->write("condition 4");    
            $sql = "SELECT * FROM tours";
            
            $this->toursList = $this->db->query($sql)->fetchAll();
        }
        
        //вывод туров
         if( count($this->toursList) ){
                          
            foreach ($this->toursList as $tour){
                $sql2 = "SELECT * FROM hotels WHERE id='{$tour["hotel_id"]}'";
                $result = $this->db->query($sql2)->fetch();
                
                $sql3 = "SELECT * FROM cities WHERE id='{$tour["city_id"]}'";
                $city = $this->db->query($sql3)->fetch();
                
                echo "<div class='mainContentComponents' style='background: url(../../css/img/{$tour['title']}.jpg); background-size: cover; background-position: center center'><div class='background'>";
                    echo "<h4>".$tour["title"]."</h4>";
                    echo "<h4><strong>".$city["title"]."</strong></h4>";
                    echo "<h5>{$tour['checkin_date']} - {$tour['checkout_date']}</h5>";
                    echo "<h4><strong>{$result['title']}</strong></h4>";
                    echo "<h5><strong>Цена {$tour['price']}$</strong></h5>";
                    echo "<a class='btn btn-primary' href=?tour={$tour['id']}>Подробно</a>";
                echo "</div></div>";
            }
        }else{
            echo "<div class='noTours'><p>Туры не найдены</p></div><br>";
        }
    }
}

?>