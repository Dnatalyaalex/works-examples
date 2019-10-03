<?php

class CityController extends Controller {

    public function citiesList()
    {
        $sql = "SELECT * FROM cities";
        
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Город</th><th>Страна</th><th>&nbsp;</th><th>&nbsp;</th></tr>";

        foreach ($this->db->query($sql) as $cities) {
          
            $sql = "SELECT * FROM countries WHERE id = '{$cities['country_id']}'";
            $country = $this->db->query($sql)->fetch();

           // var_dump($tour);
            echo "<tr>";
            echo "<td>{$cities["id"]}</td>";
            echo "<td>{$cities["title"]}</td>";
            echo "<td>{$country["title"]}</td>";
            echo "<td><a href='?section=cities&action=editform&id={$cities['id']}'>EDIT</a></td>";
            echo "<td><a href='?section=cities&action=delete&id={$cities['id']}'>DELETE</a></td>";

            echo "</tr>";

        }
        echo "</table>";
    }

    public function editform($id)
    {
        $cityId = $id;
        if($cityId) {
            $sql = "SELECT * FROM cities WHERE id = {$cityId}";
            $city = $this->db->query($sql)->fetch();
            if($city) {
                include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/city/editform.php";
            }
        }else{
            echo "Город не найден.";
        }
    }

    public function store($id, $title, $countryid)
    {
        $sql = "UPDATE cities SET
                country_id = '$countryid',	
                title = '$title'
                WHERE id = $id";

        //echo $sql;
        $this->db->query($sql);

        $this->citiesList();
    }
    
    public function delete($id) 
    {
        $sql = "DELETE FROM `cities` WHERE id = '$id'";
        
        $this->db->query($sql);
        $this->citiesList();
    }
    
    public function storeAdd($id, $title, $countryid)
    {
        $sql = "INSERT INTO `cities`(`id`, `title`, `country_id`) 
        VALUES ('$id','$title','$countryid')";

        //echo $sql;
        $this->db->query($sql);

        $this->citiesList();
    }
    
    public function addCity() 
    {
        include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/city/add.php";
    }

}
?>