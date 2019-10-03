<?php

class HotelController extends Controller {

    public function hotelsList()
    {
        $sql = "SELECT * FROM hotels";
        
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Отель</th><th>Категория</th><th>Город</th><th>Описание</th><th>&nbsp;</th><th>&nbsp;</th></tr>";

        foreach ($this->db->query($sql) as $hotel) {
                
            $sql = "SELECT * FROM cities WHERE id='{$hotel['city_id']}'";
            $city = $this->db->query($sql)->fetch();
            
           // var_dump
            echo "<tr>";
            echo "<td>{$hotel["id"]}</td>";
            echo "<td>{$hotel['category']}</td>";
            echo "<td>{$city['title']}</td>";
            echo "<td>{$hotel['description']}</td>";
            echo "<td><a href='?section=hotels&action=editform&id={$hotel['id']}'>EDIT</a></td>";
            echo "<td><a href='?section=hotels&action=delete&id={$hotel['id']}'>DELETE</a></td>";

            echo "</tr>";

        }
        echo "</table>";
    }

    public function editform($id)
    {
        $hotelId = $id;
        if($hotelId) {
            $sql = "SELECT * FROM hotels WHERE id = '{$hotelId}'";
            $hotel = $this->db->query($sql)->fetch();
       
            if($hotel) {
                include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/hotel/editform.php"; 
            }
        }else{
            echo "Отель не найден.";
        }
    }

    public function store($id, $title, $description, $city, $category)
    {
        $sql = "UPDATE hotels SET
                city_id = '$city',	
                title = '$title',
                category = '$category',
                description = '$description'
                WHERE id = $id"; 
        
        //echo($sql)
        
        $this->db->query($sql);
        $this->hotelsList();
    }
    
    public function delete($id) 
    {
        $sql = "DELETE FROM `hotels` WHERE id = '$id'";
        
        $this->db->query($sql);
        $this->hotelsList();
    }
    
    public function storeAdd($id, $title, $cityid, $category, $description)
    {
        $sql = "INSERT INTO `hotels`(`id`, `title`, `city_id`, `category`, `description`) 
        VALUES ('$id','$title','$cityid','$category','$description')";

        //echo $sql;
        $this->db->query($sql);

        $this->hotelsList();
    }
    
    public function addHotel() 
    {
        include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/hotel/add.php";
    }

}
?>