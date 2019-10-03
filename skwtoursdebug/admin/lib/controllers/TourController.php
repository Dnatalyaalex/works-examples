<?php

class TourController extends Controller {

    public function toursList()
    {
        $sql = 'SELECT tours.*, hotels.title as htitle, cities.title as ctitle FROM tours, hotels, cities WHERE tours.`city_id` = cities.id && tours.hotel_id = hotels.id';


        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Тур</th><th>Город</th><th>Дата начала/окончания</th><th>Отель</th><th>Описание</th><th>&nbsp;</th><th>&nbsp;</th></tr>";

        foreach ($this->db->query($sql) as $tour) { 

           // var_dump($tour);
            echo "<tr>";
            echo "<td>{$tour["id"]}</td>";
            echo "<td>{$tour["title"]}</td>";
            echo "<td>{$tour["ctitle"]}</td>";
            echo "<td>{$tour['checkin_date']} - {$tour['checkout_date']}</td>";
            echo "<td>{$tour["htitle"]}</td>";
             echo "<td>{$tour["description"]}</td>";
            echo "<td><a href='?section=tours&action=editform&id={$tour[id]}'>EDIT</a></td>";
            echo "<td><a href='?section=tours&action=delete&id={$tour[id]}'>DELETE</a></td>";

            echo "</tr>";

        }
        echo "</table>";
    }

    public function editform($id)
    {
        $tourid = $id;
        if($tourid) {
            $sql = "SELECT * FROM tours WHERE id = {$tourid}";
            $tour = $this->db->query($sql)->fetch();
            if($tour) {
                include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/tour/editform.php";
            }
        }else{
            echo "Тур не найден.";
        }
    }

    public function store($id, $title, $description,
                          $price, $countryid,  $cityid, $hotelid, $checkin_date, $checkout_date)
    {
        $sql = "UPDATE tours SET
                country_id = '$countryid',
                city_id = '$cityid',
                hotel_id = '$hotelid',
                checkin_date = '$checkin_date',
                checkout_date = '$checkout_date',
                price = '$price',	
                title = '$title',	
                description = '$description'
                WHERE id = $id";

        //echo $sql;
        $this->db->query($sql);

        $this->toursList();

    }
    
    public function delete($id) 
    {
        $sql = "DELETE FROM `tours` WHERE id = '$id'";
        
        $this->db->query($sql);
        $this->toursList();
    }
    
    public function addTour() 
    {
        
        include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/tour/add.php";
    
    }
    
    //---
    public function storeAdd($id, $title, $description,
                          $price, $countryid,  $cityid, $hotelid, $checkin_date, $checkout_date)
    {           
        $sql = "INSERT INTO `tours`(`id`, `country_id`, `city_id`, `hotel_id`,  `checkin_date`, `checkout_date`, `price`, `title`, `description`) VALUES ('$id', '$countryid', '$cityid', '$hotelid', '$checkin_date', '$checkout_date', '$price', '$title', '$description')";
        
        $this->db->query($sql);
        $this->toursList();
    }
  }
?>